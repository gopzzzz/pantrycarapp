<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Models\Customer_charts;

use App\Models\B2c_sales;

use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $meals=DB::table('meals')->get();
        return view('welcome',compact('meals'));
    }
    public function customerList($id){
        $date = Carbon::today()->toDateString();
    
        try {
            // Fetch customer charts with related customer details
            $list = Customer_charts::query()
                ->leftJoin('customers', 'customer_charts.customer_id', '=', 'customers.id')
                ->where('customer_charts.date', $date)
                ->where('customer_charts.meal_id', $id)
                ->select([
                    'customer_charts.id as chartId',
                    'customers.name',
                    'customers.contact_number',
                    'customers.home_location',
                    'customers.office_location'
                ])
                ->get();
            
            // Return the view with the fetched data
            return view('admin.customerView', compact('list'));
        } catch (\Exception $e) {
            // Handle exceptions or log the error
            // Log::error($e->getMessage()); // Uncomment for error logging
            return redirect()->back()->with('error', 'An error occurred while fetching customer data.');
        }
    }
    public function cancellation(){
        $meal_type=DB::table('meals')->get();
        $customer=DB::table('customers')->where('status',0)->get();
        return view('admin.cancellation',compact('customer','meal_type'));
    }
    public function cancelFoodMeals(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'canceltype' => 'required|integer',
            'customerid' => 'required|integer'
        ]);
    
        $cancelType = $request->canceltype;
        $customerId = $request->customerid;
       
    
        switch ($cancelType) {
            case 1:
                $this->cancelPerDayMeal($customerId, $request->date);
                break;
            case 2:
                $this->cancelMultipleDaysMeal($customerId, $request->from_date, $request->to_date);
                break;
            case 3:
                $this->cancelPerMeal($customerId, $request->meal_type , $request->date);
                break;
            default:
                return redirect()->back()->with('error', 'An error occurred while fetching customer data.');
        }
        return redirect('cancellation');
    }
    private function cancelPerDayMeal($customerId, $date)
    {
        // Check if the meal for the given day has already been canceled
        $isAlreadyCanceled = $this->checkDatealreadyCancelorNot($date, $customerId);
        
        if ($isAlreadyCanceled) {
           // return response()->json(['message' => 'Meal for this date has already been canceled.'], 400);
            return redirect('cancellation')->with('error', 'Meal for this date has already been canceled.');
        }
    
        // Proceed with canceling the meal if not already canceled
        $updateResult = Customer_charts::where('date', $date)
            ->where('customer_id', $customerId)
            ->update(['status' => 4]);
    
        if ($updateResult) {
            // Get the last customer data and sales data
            $lastCustomerRow = $this->getLastCustomerData($customerId);
            $lastSalesData = $this->getLastCustomerSalesData($customerId);
    
            if ($lastCustomerRow && $lastSalesData) {
                // Extend the subscription
                $this->extendSubscription($customerId, $lastCustomerRow, $lastSalesData);
               // return response()->json(['message' => 'Meal canceled successfully, and subscription extended.'], 200);
                return redirect('cancellation')->with('success', 'Meal canceled successfully, and subscription extended.');
            } else {
               // return response()->json(['message' => 'Failed to retrieve customer or sales data.'], 500);
                return redirect('cancellation')->with('error', 'Failed to retrieve customer or sales data.');
            }
        } else {
          //  return response()->json(['message' => 'Meal cancellation failed.'], 500);
          return redirect('cancellation')->with('error', 'Meal cancellation failed.');
        }
    }
    
    // Inside your controller



    public function cancelMultipleDaysMeal($customerId,$fromDate,$toDate)
    {
        
    
        $data = Customer_charts::select('date', DB::raw('MAX(id) as id'))
        ->whereBetween('date', [$fromDate, $toDate])
        ->where('customer_id', $customerId)
        ->groupBy('date')
        ->get();
    
   
       
       foreach($data as $keyData){
       
        $isAlreadyCanceled = $this->checkDatealreadyCancelorNot($keyData->date, $customerId);
        
        if (!$isAlreadyCanceled) {
            $updateResult =  Customer_charts::where('date', $keyData->date)
            ->where('customer_id', $customerId)
            ->update(['status' => 4]);
           
            if ($updateResult) {
                // Get the last customer data and sales data
                $lastCustomerRow = $this->getLastCustomerData($customerId);
                $lastSalesData = $this->getLastCustomerSalesData($customerId);
        
                if ($lastCustomerRow && $lastSalesData) {
                    // Extend the subscription
                    $this->extendSubscription($customerId, $lastCustomerRow, $lastSalesData);
                   // return response()->json(['message' => 'Meal canceled successfully, and subscription extended.'], 200);
                    return redirect('cancellation')->with('success', 'Meal canceled successfully, and subscription extended.');
                } else {
                   // return response()->json(['message' => 'Failed to retrieve customer or sales data.'], 500);
                    return redirect('cancellation')->with('error', 'Failed to retrieve customer or sales data.');
                }
            } else {
              //  return response()->json(['message' => 'Meal cancellation failed.'], 500);
              return redirect('cancellation')->with('error', 'Meal cancellation failed.');
            }

        }
       }
      

    }


private function cancelPerMeal( $customerId,  $mealType,  $date)
{
    try {
        // Update the status of the meal for the given date and customer
        $updateResult = Customer_charts::where('date', $date)
            ->where('customer_id', $customerId)
            ->where('meal_id', $mealType)
            ->update(['status' => 4]);

        if ($updateResult === false) {
            // If the update fails, throw an exception
            throw new \Exception('Failed to cancel meal.');
        }

        return true;
    } catch (\Exception $e) {
        // Handle the exception (log the error, etc.)
        \Log::error('Error canceling meal: ' . $e->getMessage());
        return false;
    }
}


    private function checkDatealreadyCancelorNot($date, $customerId)
{
    // Query the Customer_charts table to check if there's a cancellation for the given date and customer
    $canceledRecord = Customer_charts::where('date', $date)
        ->where('customer_id', $customerId)
        ->where('status', 4) // Assuming status 4 indicates cancellation
        ->first();

    // Return true if a canceled record exists, otherwise false
    return $canceledRecord ? true : false;
}

    
    private function extendSubscription($customerId, $lastCustomerRow, $lastSalesData)
    {
    // Get the last subscription date and increment it by one day
    $lastDate = $lastCustomerRow->date;
    $newDate = date('Y-m-d', strtotime($lastDate . ' +1 day'));

    // Decode meal types array from last sales data
    $mealIds = $lastSalesData->meal_types;
    $mealTypesArray = json_decode($mealIds, true);

    if (!is_array($mealTypesArray)) {
        throw new \Exception('Invalid meal types data.');
    }

    // Loop through each meal ID and extend the subscription
    foreach ($mealTypesArray as $mealId) {
        // Check if the new entry for this customer, date, and meal already exists
        if (!$this->checkmultipleEntry($customerId, $newDate, $mealId)) {
            // Create new subscription entry for the meal
            $chart = new Customer_charts([
                'customer_id' => $customerId,
                'meal_id' => $mealId,
                'date' => $newDate,
                'status' => 1,
                'plan_id' => $lastCustomerRow->plan_id
            ]);

            // Try to save and handle potential failure
            if (!$chart->save()) {
                \Log::error('Failed to save customer chart for meal ID: ' . $mealId . ' on date: ' . $newDate);
                throw new \Exception('Failed to save customer chart for meal ID ' . $mealId);
            } else {
                \Log::info('Subscription extended for customer ID ' . $customerId . ' on ' . $newDate . ' for meal ID: ' . $mealId);
            }
        }
    }

    return true;
}

    private function getLastCustomerData($customerId)
    {
        return Customer_charts::where('customer_id', $customerId)
            ->orderBy('date', 'desc')
            ->first();
    }
    private function getLastCustomerSalesData($customerId){
        return B2c_sales::where('customer_id', $customerId)
        ->orderBy('sale_date', 'desc')
        ->first();
    }
    private function checkmultipleEntry($customerId, $newDate, $mealId)
    {
        return DB::table('customer_charts')
                 ->where('customer_id', $customerId)
                 ->where('date', $newDate)
                 ->where('meal_id', $mealId)
                 ->exists();  // Efficiently checks if a record exists
    }
    
 
}
