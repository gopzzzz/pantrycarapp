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

    </style>
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start --> 
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Customers</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Customers</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
        




            @if(session('success'))



            <h3 style="margin-left: 19px;color: green;">{{session('success')}}</h3> @endif



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

          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Customer</button>

                               

                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                        <form method="POST"  id="form1" action="{{ route('customerinsert') }}" enctype="multipart/form-data">
@csrf
<div class="modal-dialog" role="document" style="width:80%;">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>

</button>

</div>
<div class="modal-body row">
<div class="form-group col-sm-6">
<label class="exampleModalLabel">Customer Name</label>
<input class="form-control" name="customer_name" placeholder="Enter Customer Name" required>
</div>
<div class="form-group col-sm-6">
<label class="exampleModalLabel">Customer Code</label>
<input class="form-control" name="customer_code" placeholder="Enter Customer Code" required>
</div>
<div class="form-group col-sm-6">
<label class="exampleModalLabel">Contact Number</label>
<input type="tel" class="form-control" name="contact_number" id="contact_number" placeholder="Enter Contact Number" required>
<div class="invalid-feedback">
        Please enter a valid 10-digit phone number starting with 6, 7, 8, or 9.
    </div>
</div>

<div class="form-group col-sm-6">
<label class="exampleModalLabel">Home Location</label>
<textarea class="form-control" name="home_location" placeholder="Enter Home Location" required></textarea>

</div><div class="form-group col-sm-6">
<label class="exampleModalLabel">Office Location</label>
<textarea class="form-control" name="office_location" placeholder="Enter Office Location" required></textarea>

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
                                                <th>CUSTOMER CODE </th>
                                                <th>CONTACT NUMBER </th>
                                                <th>HOME LOCATION</th>
                                                <th>OFFICE LOCATION </th>
                                                <th>STATUS</th>

                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>@php $i=1; @endphp @foreach($customer as $key)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$key->name}}</td>
                                                <td>{{$key->customer_code}}</td>
                                                <td>{{$key->contact_number}}</td>
                                                <td>{{$key->home_location}}</td>
                                                <td>{{$key->office_location}}</td>
                                                <td>@if($key->status==0) ACTIVE @elseif($key->status==1) INACTIVE @endif</td>
                                               <td> <i class="fa fa-edit edit_customer" aria-hidden="true" data-toggle="modal" data-id="{{ $key->id }}"></i>

                                                </td>

                                            </tr>@php $i++; @endphp @endforeach</tbody>
                                        <tfoot>
                                            <tr>
                                            <th>ID</th>
                                                <th>CUSTOMER NAME </th>
                                                <th>CUSTOMER CODE </th>
                                                <th>CONTACT NUMBER </th>
                                                <th>HOME LOCATION</th>
                                                <th>OFFICE LOCATION </th>
                                                <th>STATUS</th>

                                                <th>ACTION</th>

                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="modal" id="editcustomer_modal" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Customer Details</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{url('customeredit')}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body row">
                                                            <input type="hidden" name="id" id="customerid">

                                                            <div class="form-group col-sm-6">
<label class="exampleModalLabel">Customer Name</label>
<input class="form-control" name="customer_name" id="customer_name" placeholder="Enter Customer Name" required>
</div>
<div class="form-group col-sm-6">
<label class="exampleModalLabel">Customer Code</label>
<input class="form-control" name="customer_code" id="customer_code" placeholder="Enter Customer Code" required>
</div>

<div class="form-group col-sm-6">
<label class="exampleModalLabel">Contact Number</label>
<input type="tel" class="form-control" name="contact" id="contact" placeholder="Enter Contact Number" required>
<div class="invalid-feedback">
        Please enter a valid 10-digit phone number starting with 6, 7, 8, or 9.
    </div>
</div>
<div class="form-group col-sm-6">
<label class="exampleModalLabel">Home Location</label>
<textarea class="form-control" name="home_location" id="home_location" placeholder="Enter Home Location" required></textarea>

</div><div class="form-group col-sm-6">
<label class="exampleModalLabel">Office Location</label>
<textarea class="form-control" name="office_location" id="office_location" placeholder="Enter Office Location" required></textarea>

</div>

                                                            <div class="form-group col-sm-6">

                                                                <label class="exampleModalLabel">Status</label>

                                                                <select name="status" id="status" class="form-control" required>

                                                                    <option value="0">Active</option>
                                                                    <option value="1">In Active</option>

                                                                </select>

                                                            </div>

                                                        </div>



                                               



                                                    <div class="modal-footer">



                                                        <button type="submit" class="btn btn-primary">Save changes</button>

                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>



                                                    </div>



                                                </form>



                                            </div>



                                        </div>



                                    </div>

                                    </form>



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
    $('.edit_customer').click(function(){
    		var id=$(this).data('id');
    	
    		if(id){
          $.ajax({
    					type: "POST",
    
    					url: "{{ route('customerfetch') }}",
    					data: {  "_token": "{{ csrf_token() }}",
    					id: id },
    					success: function (res) {
    					console.log(res);
              var obj=JSON.parse(res)
    		  $('#customerid').val(obj.id);
              $('#customer_name').val(obj.name);
              $('#customer_code').val(obj.customer_code);
              $('#contact').val(obj.contact_number);
              $('#home_location').val(obj.home_location);
              $('#office_location').val(obj.office_location);
    		  $('#status').val(obj.status);
             
    					},
    					});	 
    		}
    		$('#editcustomer_modal').modal('show');
    	});
</script>


<script>
document.getElementById('contact_number').addEventListener('input', function() {
    var phoneNumber = this.value;
    var phonePattern = /^[6-9]\d{9}$/;

    // Remove non-digit characters for validation
    var digitsOnly = phoneNumber.replace(/\D/g, '');

    // Update the input value to only digits
    this.value = digitsOnly;

    // Validate the phone number
    if (phonePattern.test(digitsOnly)) {
        this.classList.remove('is-invalid');
        this.classList.add('is-valid');
    } else {
        this.classList.remove('is-valid');
        this.classList.add('is-invalid');
    }
});

</script>

<script>
document.getElementById('contact').addEventListener('input', function() {
    var phoneNumber = this.value;
    var phonePattern = /^[6-9]\d{9}$/;

    // Remove non-digit characters for validation
    var digitsOnly = phoneNumber.replace(/\D/g, '');

    // Update the input value to only digits
    this.value = digitsOnly;

    // Validate the phone number
    if (phonePattern.test(digitsOnly)) {
        this.classList.remove('is-invalid');
        this.classList.add('is-valid');
    } else {
        this.classList.remove('is-valid');
        this.classList.add('is-invalid');
    }
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