<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\B2c_sales;
use App\Models\Customer_charts;

class B2cController extends Controller
{
   public function b2csales(){
    $plan=DB::table('plan_details')
    ->leftjoin('tbl_master_plans', 'plan_details.masterplan_id', '=', 'tbl_master_plans.id')
    ->select('plan_details.id','tbl_master_plans.name','plan_details.total_days','plan_details.number_of_meals')
    ->get();
    $customer=DB::table('customers')->get();
    $sales=DB::table('b2c_sales')
    ->leftjoin('plan_details', 'b2c_sales.plan_id', '=', 'plan_details.id')
    ->leftjoin('tbl_master_plans', 'plan_details.masterplan_id', '=', 'tbl_master_plans.id')
    ->leftjoin('customers', 'b2c_sales.customer_id', '=', 'customers.id')
    ->orderby('b2c_sales.id','desc')
    ->select('b2c_sales.*', 'tbl_master_plans.name as master_plan_name', 'customers.name as customer_name')
    ->get();
    return view('admin.b2csales',compact('sales','plan','customer'));
   }
   public function b2csalesinsert(Request $request)
   {// Get the number of meals from the request
$numMealsRequired = $request->nomeals;

// Validate incoming request
$validatedData = $request->validate([
    'plan_name'      => 'required',  // Assuming plans table exists
    'customer_name'  => 'required',  // Assuming customers table exists
    'sale_date'      => 'required|date',
    'total_amount'   => 'required|numeric',
    'number_of_days' => 'required|integer',
    'meal_types'     => [
        'array',
        function ($attribute, $value, $fail) use ($numMealsRequired) {
            if (count($value) !== $numMealsRequired) {
                $fail("You must select exactly {$numMealsRequired} meals.");
            }
        }
    ]
]);

// Generate a new invoice number
$invoiceNumber = $this->createInvoiceNumber();

if ($invoiceNumber) {
    // DB::beginTransaction(); Uncomment if you plan to use transactions
    
    try {
        // Check if the customer's plan already exists
        $checkCustomerplanIsexisted = $this->checkCustomerplanIsexisted($request->customer_name);
        
        if (!$checkCustomerplanIsexisted) {
            // Create a new sales record
            $sales = new B2c_sales;
            $sales->customer_id = $request->customer_name;
            $sales->invoice_number = $invoiceNumber;
            $sales->sale_date = $request->sale_date;
            $sales->plan_id = $request->plan_name;
            $sales->meal_types = json_encode($request->meals_type); // JSON encode meal types
            $sales->total_amount = $request->total_amount;
            $sales->include_weekends = $request->satandsun;
            $sales->number_of_days = $request->number_of_days;
            
            // Save the sales record
            if ($sales->save()) {
                // Generate customer charts based on the sales data
                $customerChartsGenerated = $this->generateCustomerCharts(
                    $sales->customer_id,
                    json_encode($request->meals_type),
                    $request->number_of_days,
                    $request->sale_date,
                    $request->plan_name
                );
                
                if ($customerChartsGenerated) {
                    // DB::commit();  Uncomment if using transactions
                    return redirect('b2csales')->with('success', 'B2C Sales added successfully.');
                } else {
                   
                    return redirect('b2csales')->with('error', 'Error generating customer charts');
                }
            } else {
               
                return redirect('b2csales')->with('error', 'Failed to save sales data.');
            }
        } else {
            return redirect('b2csales')->with('error', 'This Customer Plan is already existed.');
           
        }
    } catch (\Exception $e) {
        // DB::rollBack(); Uncomment if using transactions
        return redirect('b2csales')->with('error', 'An error occurred: ' . $e->getMessage());
       
    }
}



// Fallback if invoice generation failed
return redirect('b2csales')->with('error', 'Invoice generation failed.');
}

public function checkCustomerplanIsexisted($customerID){
    return DB::table('customer_charts')
    ->where('customer_id', $customerID)
    ->where('status',1)
    ->exists(); 
}
   
   public function createInvoiceNumber()
   {
       // Get the latest invoice ID and increment
       $lastInvoice = DB::table('b2c_sales')->orderBy('id', 'desc')->first();
       return $lastInvoice ? $lastInvoice->id + 1 : 1;
   }
   
   public function generateCustomerCharts($customerId, $mealIds , $totalDays , $saleDate , $planId)
   {
       try {
          
           $mealTypesArray = json_decode($mealIds, true);
           for($i=0;$i<=$totalDays;$i++){
                    
            $newDate = date('Y-m-d', strtotime($saleDate . ' +'.$i.' day'));
                
            foreach ($mealTypesArray as $mealId) {
                $checkDate=$this->checkmultipleEntry($customerId,$newDate,$mealId);
                if (!$this->checkmultipleEntry($customerId, $newDate, $mealId)) {
                    $chart = new Customer_charts;
                    $chart->customer_id = $customerId;
                    $chart->meal_id = $mealId;
                    $chart->date = $newDate;
                    $chart->status = 1;
                    $chart->plan_id=$planId;
                    
                    if (!$chart->save()) {
                        throw new \Exception('Failed to save customer chart for meal ID ' . $mealId);
                    }
                } 
               
            }
           }
          
          
           
           return true; // If all charts are saved successfully
       } catch (\Exception $e) {
       
           return false; // Return false if any failure occurs
       }
   }
   public function checkmultipleEntry($customerId, $newDate, $mealId)
   {
       return DB::table('customer_charts')
                ->where('customer_id', $customerId)
                ->where('date', $newDate)
                ->where('meal_id', $mealId)
                ->exists();  // Efficiently checks if a record exists
   }
   
   



}
