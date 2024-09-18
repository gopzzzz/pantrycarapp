@extends('layout.mainlayout') @section('content')

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start --> 
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Delivery Agents</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Delivery Agents</a></li>
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

          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Delivery Agent</button>

                               

                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                        <form method="POST"  id="form1" action="{{ route('delivery_agentinsert') }}" enctype="multipart/form-data">
@csrf
<div class="modal-dialog" role="document" style="width:80%;">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Add Delivery Agent</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>

</button>

</div>
<div class="modal-body row">
<div class="form-group col-sm-6">
<label class="exampleModalLabel">Delivery Agent Name</label>
<input class="form-control" name="delivery_agent_name" placeholder="Enter Delivery Agent Name" required>
</div>
<div class="form-group col-sm-6">
<label class="exampleModalLabel">Address</label>
<textarea class="form-control" name="address" placeholder="Enter Address" required></textarea>
</div>
<div class="form-group col-sm-6">
<label class="exampleModalLabel">Phone Number</label>
<input type="tel" class="form-control" name="phone_number" id="phone_number" placeholder="Enter Phone Number" required>
<div class="invalid-feedback">
        Please enter a valid 10-digit phone number starting with 6, 7, 8, or 9.
    </div>
</div>

<div class="form-group col-sm-6">
        <label class="exampleModalLabel">Email Address</label>
        <input type="email" class="form-control" name="email" placeholder="Enter Email Address" required>
        <small id="emailHelp" class="form-text text-muted">Please enter a valid email with the domain @example.com.</small>
    </div>
    <div class="form-group col-sm-6">
<label class="exampleModalLabel">Date of Birth</label>
<input type="date" class="form-control" name="date_of_birth" placeholder="Enter Date of Birth" required>
</div>
    <div class="form-group col-sm-6">
<label class="exampleModalLabel">Qualification</label>
<input class="form-control" name="qualification" placeholder="Enter Qualification" required>

</div>
<div class="form-group col-sm-6">
<label class="exampleModalLabel">ID Proof</label>
<input class="form-control" name="id_proof" placeholder="Enter ID Proof" required>

</div>
<div class="form-group col-sm-6">
<label class="exampleModalLabel">Photo</label>
<input class="form-control" type="file" name="photo" accept="image/*" required>


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
                                                <th>DELIVERY AGENT NAME </th>
                                                <th>ADDRESS </th>
                                                <th>PHONE NUMBER</th>
                                                <th>EMAIL ADDRESS</th>
                                                <th>DATE OF BIRTH </th>
                                                <th>QUALIFICATION</th>
                                                <th>ID PROOF </th>
                                                <th>PHOTO</th>
                                                <th>ACTION</th>

                                            </tr>
                                        </thead>
                                        <tbody>@php $i=1; @endphp @foreach($deliveryagent as $key)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$key->name}}</td>
                                                <td>{{$key->address}}</td>
                                                <td>{{$key->phone_number}}</td>
                                                <td>{{$key->email}}</td>
                                                <td>{{$key->dob}}</td>
                                                <td>{{$key->qualification}}</td>
                                                <td>{{$key->id_proof}}</td>
                                                <td><img src="{{ asset('/img/'.$key->photo) }}" alt="" width="50"/></td>

                                               <td> <i class="fa fa-edit edit_deliveryagent" aria-hidden="true" data-toggle="modal" data-id="{{ $key->id }}"></i>

                                               
                                                <a href="#" onclick="confirmDelete('{{ $key->id }}')">
                                                <i class="fa fa-trash delete_banner text-danger" aria-hidden="true" data-id="{{ $key->id }}"></i> </td>
                                            </tr>@php $i++; @endphp @endforeach</tbody>
                                        <tfoot>
                                            <tr>
                                            <th>ID</th>
                                                <th>DELIVERY AGENT NAME </th>
                                                <th>ADDRESS </th>
                                                <th>PHONE NUMBER</th>
                                                <th>EMAIL ADDRESS</th>
                                                <th>DATE OF BIRTH </th>
                                                <th>QUALIFICATION</th>
                                                <th>ID PROOF </th>
                                                <th>PHOTO</th>
                                                <th>ACTION</th>

                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="modal" id="editdeliveryagent_modal" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Delivery Agent Details</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{url('delivery_agentedit')}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body row">
                                                            <input type="hidden" name="id" id="deliveryid">

                                                            <div class="form-group col-sm-6">
<label class="exampleModalLabel">Delivery Agent Name</label>
<input class="form-control" name="delivery_agent_name" id="delivery_agent_name" placeholder="Enter Delivery Agent Name" required>
</div>
<div class="form-group col-sm-6">
<label class="exampleModalLabel">Address</label>
<textarea class="form-control" name="address" id="address" placeholder="Enter Address" required></textarea>
</div>
<div class="form-group col-sm-6">
<label class="exampleModalLabel">Phone Number</label>
<input type="tel" class="form-control" name="contact_number" id="contact_number" placeholder="Enter Phone Number" required>
<div class="invalid-feedback">
        Please enter a valid 10-digit phone number starting with 6, 7, 8, or 9.
    </div>
</div>

<div class="form-group col-sm-6">
        <label class="exampleModalLabel">Email Address</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email Address" required>
        <small id="emailHelp" class="form-text text-muted">Please enter a valid email with the domain @example.com.</small>
    </div>
    <div class="form-group col-sm-6">
<label class="exampleModalLabel">Date of Birth</label>
<input type="date" class="form-control" name="date_of_birth" id="date_of_birth" placeholder="Enter Date of Birth" required>
</div>
    <div class="form-group col-sm-6">
<label class="exampleModalLabel">Qualification</label>
<input class="form-control" name="qualification" id="qualification" placeholder="Enter Qualification" required>

</div>

<div class="form-group col-sm-6">
<label class="exampleModalLabel">ID Proof</label>
<input class="form-control" name="id_proof" id="id_proof" placeholder="Enter ID Proof" required>

</div>
<div class="form-group col-sm-6">
<label class="exampleModalLabel">Photo</label>
<input class="form-control" type="file" name="photo" id="photo" accept="image/*">


</div></div>
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
    $('.edit_deliveryagent').click(function(){
    		var id=$(this).data('id');
    	
    		if(id){
          $.ajax({
    					type: "POST",
    
    					url: "{{ route('delivery_agentfetch') }}",
    					data: {  "_token": "{{ csrf_token() }}",
    					id: id },
    					success: function (res) {
    					console.log(res);
              var obj=JSON.parse(res)
    		  $('#deliveryid').val(obj.id);
              $('#delivery_agent_name').val(obj.name);
              $('#contact_number').val(obj.phone_number);
              $('#email').val(obj.email);
              $('#address').val(obj.address);
              $('#qualification').val(obj.qualification);

              $('#date_of_birth').val(obj.dob);
              $('#id_proof').val(obj.id_proof);
              $('#photo').val(obj.photo);
             
    					},
    					});	 
    		}
    		$('#editdeliveryagent_modal').modal('show');
    	});
</script>
<script>
    function confirmDelete(deliveryId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user clicks "Yes", proceed with the deletion
                window.location.href = "{{ url('delivery_agentdelete') }}/" + deliveryId;
            }
        });
    }
</script>

<script>
document.getElementById('phone_number').addEventListener('input', function() {
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