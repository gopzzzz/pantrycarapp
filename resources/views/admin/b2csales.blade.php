@extends('layout.mainlayout') @section('content')
<style>
    .form-group {
    margin-bottom: 0; /* Remove extra margin */
}

.btn {
    width: auto; /* Ensure the button doesn't stretch too much */
}

#category_name {
    width: 100%; /* Ensure the input field takes up the appropriate space */
}

    </style><div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">B2c Sales</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">B2c Sales</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->





            @if(session('success'))



            <h3 style="margin-left: 19px;color: green;">{{session('success')}}</h3> @else
            <h3 style="margin-left: 19px;color: red;">{{session('error')}}</h3>
            @endif



            <!-- Main content -->



            <section class="content">

                <div class="container-fluid">

                    <div class="row">

                        <div class="col-12">

                            <!-- /.card -->

                            <div class="card">

                                <div class="card-header">

                                    <h3 class="card-title"></h3>

                                    <p align="right">

                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add B2c Sales</button>



                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                            <form method="POST" id="form1" action="{{ route('b2csalesinsert') }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-dialog" role="document" style="width:80%;">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Add B2c Sales</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>

                                                            </button>

                                                        </div>
                                                        <div class="modal-body row">
                                                            <div class="form-group col-sm-6">
                                                                <label class="exampleModalLabel">Customer Name</label>
                                                                <select name="customer_name" class="form-control" required>
                                                                    <option value="" disabled selected>Select Customer Name</option>
                                                                    @foreach($customer as $key)
                                                                    <option value="{{ $key->id }}">{{ $key->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-sm-6">
                                                                <label class="exampleModalLabel">Sale Date</label>
                                                                <input type="date" class="form-control" name="sale_date" placeholder="Enter Sale Date" required>
                                                            </div>
                                                            <div class="form-group col-sm-12">
                                                                <label class="exampleModalLabel">Plan Name</label>
                                                                <select name="plan_name" class="form-control selectplan" required>
                                                                    <option value="0"  selected>Select Plan Name</option>
                                                                    @foreach($plan as $key)
                                                                    <option value="{{ $key->id }}">{{ $key->name }} ({{$key->number_of_meals}} Meals) - {{$key->total_days}} Days</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                          
                                                            <br>
                                                            <div class="form-group col-sm-12">
                                                                <label class="exampleModalLabel">Meals Type</label>
                                                                <div class="d-flex flex-wrap">
                                                                    <div class="form-check mr-3">
                                                                        <input class="form-check-input" type="checkbox" name="meals_type[]" value="1">
                                                                        <label class="form-check-label">BREAKFAST</label>
                                                                    </div>
                                                                    <div class="form-check mr-3">
                                                                        <input class="form-check-input" type="checkbox" name="meals_type[]" value="2">
                                                                        <label class="form-check-label">LUNCH</label>
                                                                    </div>
                                                                    <div class="form-check mr-3">
                                                                        <input class="form-check-input" type="checkbox" name="meals_type[]" value="3">
                                                                        <label class="form-check-label">DINNER</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br>

                                                            <div class="form-group col-sm-6">
                                                                <label class="exampleModalLabel">Number of Days</label>
                                                                <input type="hidden" id="amount" class="form-control" name="amount" >
                                                                <input type="hidden" id="nomeals" class="form-control" name="nomeals" >
                                                                <input type="number" id="numdays" class="form-control nodays" name="number_of_days" placeholder="Enter Number of Days" required >
                                                            </div>



                                                          
                                                            <div class="form-group col-sm-6">
                                                                <label class="exampleModalLabel">Total Amount</label>
                                                                <input type="number" class="form-control" name="total_amount" id="total_amount" placeholder="Enter Total Amount" required readonly>
                                                            </div>

                                                            <div class="form-group col-sm-6">
                                                               <br>
                                                                <input type="checkbox"  name="satandsun" id="satandsun" value="1"  >Include Saturday and Sunday
                                                            </div>

                                                        </div>

                                                        <div class="modal-footer">

                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                            <button type="submit" class="btn btn-primary form1-submit">Add</button>

                                                        </div>
                                                    </div>

                                                </div>

                                            </form>
                                        </div>
                                    </p>

                                </div>
                                <div class="card-body">

                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>



                                            <tr>
                                                <th>ID</th>
                                                <th>CUSTOMER NAME </th>
                                                <th>INVOICE NUMBER</th>
                                                <th>SALE DATE</th>
                                                <th>PLAN NAME</th>
                                               
                                                <th>TOTAL AMOUNT</th>
                                                <th>NUMBER OF DAYS</th>


                                            </tr>
                                        </thead>
                                        <tbody>@php $i=1; @endphp @foreach($sales as $key)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$key->customer_name}}</td>
                                                <td>{{$key->invoice_number}}</td>
                                                <td>{{$key->sale_date}}</td>
                                                <td>{{$key->master_plan_name}}</td>
                                               
                                                <td>{{$key->total_amount}}</td>
                                                <td>{{$key->number_of_days}}</td>



                                            </tr>@php $i++; @endphp @endforeach</tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>CUSTOMER NAME </th>
                                                <th>INVOICE NUMBER</th>
                                                <th>SALE DATE</th>
                                                <th>PLAN NAME</th>
                                               
                                                <th>TOTAL AMOUNT</th>
                                                <th>NUMBER OF DAYS</th>

                                            </tr>
                                        </tfoot>
                                    </table>




                                </div>



                            </div>



                        </div>



                    </div>



                    <!-- /.card-body -->



                </div>



                <!-- /.card -->



        </div>



        <!-- /.col -->



    </div>



    <!-- /.row -->



</div>


<!-- /.container-fluid -->



</section>



<!-- /.content -->



</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $('.selectplan').on('change',function(){
        
        $('input[name="meals_type"]').prop('checked', false);
    		var id=$(this).val();
           // alert(id);
    	
    		if(id){
          $.ajax({
    					type: "POST",
    
    					url: "{{ route('plandetailsfetch') }}",
    					data: {  "_token": "{{ csrf_token() }}",
    					id: id },
    					success: function (res) {
    					console.log(res);
              var obj=JSON.parse(res)
    		  $('#numdays').val(obj.total_days);
              $('#nomeals').val(obj.number_of_meals);
              $('#amount').val(obj.amount);

              var TotalSum = Math.round(parseInt(obj.number_of_meals || 0) * parseFloat(obj.amount || 0)) * parseInt(obj.total_days || 0);


              $('#total_amount').val(TotalSum);
           
             
    					},
    					});	 
    		}
    		$('#editmasterplans_modal').modal('show');
    	});

        $('input[name="meals_type"]').on('click', function() {

// Get the number of allowed meals from the #numdays input field and convert it to an integer
var numdays = parseInt($('#numdays').val());
var nomeals = parseInt($('#nomeals').val());



if (numdays) {

   
    // Count how many checkboxes are checked
    var checkedCount = $('input[name="meals_type"]:checked').length;

    // If more than the allowed number of checkboxes are selected, uncheck the current one
    if (checkedCount > nomeals) {
        alert("You can only select a maximum of " + nomeals + " meals.");
        $(this).prop('checked', false);
    }
} else {
    // Alert the user to select a plan if #numdays is not set
    alert("Please select a plan.");
    $(this).prop('checked', false);
}
});

$('.nodays').on('keyup',function(){

    var value = $(this).val();
    var nomeals=$('#nomeals').val();
    var amount=$('#amount').val();
    var TotalSum = Math.round(parseInt(nomeals || 0) * parseFloat(amount || 0)) * parseInt(value || 0);
    $('#total_amount').val(TotalSum);

});


       

</script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@if(Session::has('success'))
<script>
    // Set the Toastr options including the position
        toastr.options = {
            "positionClass": "toast-top-center toast-margin", // Adjust position here
            "progressBar": true,
            "preventDuplicates": true,
            "timeOut": "3000"
        };

        // Display the Toastr success message
        toastr.success("{{ session()->get('success') }}", 'Success');
</script>
{{ Session::forget('success') }} @endif

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
@if ($errors->any()) @php $allErrors = ''; foreach ($errors->all() as $error) { $allErrors .= $error . '\n'; } @endphp
<script>
    document.addEventListener("DOMContentLoaded", function() {
            var errorMessages = `{!! $allErrors !!}`;
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: errorMessages,
            });
        });
</script>
@endif @endsection