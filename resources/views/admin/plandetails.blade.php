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
                            <h5 class="m-b-10">Plan Details</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Plan Details</a></li>
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

          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Plan Details</button>

                               

                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                        <form method="POST"  id="form1" action="{{ route('plandetailsinsert') }}" enctype="multipart/form-data">
@csrf
<div class="modal-dialog" role="document" style="width:80%;">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Add Plan Details</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>

</button>

</div>
<div class="modal-body row">
<div class="form-group col-sm-6">
<label class="exampleModalLabel">Plan Name</label>
<input class="form-control" name="plan_name" placeholder="Enter Plan Name" required>
</div>
<div class="form-group col-sm-6">
<label class="exampleModalLabel">Description</label>
<textarea class="form-control" name="description" placeholder="Enter Description Price" required></textarea>
</div>
<div class="form-group col-sm-6">
<label class="exampleModalLabel">Breakfast Price</label>
<input type="number" class="form-control" name="breakfast" placeholder="Enter Breakfast Price" required>
</div><div class="form-group col-sm-6">
<label class="exampleModalLabel">Lunch Price</label>
<input  type="number" class="form-control" name="lunch" placeholder="Enter Lunch Price" required>
</div><div class="form-group col-sm-6">
<label class="exampleModalLabel">Dinner Price</label>
<input  type="number" class="form-control" name="dinner" placeholder="Enter Dinner Price" required>
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
                                                <th>PLAN NAME </th>
                                                <th>DESCRIPTION</th>
                                                <th>BREAKFAST PRICE</th>
                                                <th>LUNCH PRICE</th>
                                                <th>DINNER PRICE </th>
                                                <th>ACTION</th>

                                            </tr>
                                        </thead>
                                        <tbody>@php $i=1; @endphp @foreach($plandetails as $key)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$key->name}}</td>
                                                <td>{{$key->description}}</td>
                                                <td>{{$key->breakfast}}</td>
                                                <td>{{$key->lunch}}</td>
                                                <td>{{$key->dinner}}</td>
                                               <td> <i class="fa fa-edit edit_plandetails" aria-hidden="true" data-toggle="modal" data-id="{{ $key->id }}"></i>

                                                </td>

                                            </tr>@php $i++; @endphp @endforeach</tbody>
                                        <tfoot>
                                            <tr>
                                            <th>ID</th>
                                                <th>PLAN NAME </th>
                                                <th>DESCRIPTION</th>
                                                <th>BREAKFAST PRICE</th>
                                                <th>LUNCH PRICE</th>
                                                <th>DINNER PRICE </th>

                                                <th>ACTION</th>

                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="modal" id="editplandetails_modal" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Customer Details</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{url('plandetailsedit')}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body row">
                                                            <input type="hidden" name="id" id="plandetailsid">
                                                            <div class="form-group col-sm-6">
<label class="exampleModalLabel">Plan Name</label>
<input class="form-control" name="plan_name" id="plan_name" placeholder="Enter Plan Name" required>
</div>
<div class="form-group col-sm-6">
<label class="exampleModalLabel">Description</label>
<textarea class="form-control" name="description" id="description" placeholder="Enter Description" required></textarea>
</div>
<div class="form-group col-sm-6">
<label class="exampleModalLabel">Breakfast Price</label>
<input  type="number" class="form-control" name="breakfast" id="breakfast" placeholder="Enter Breakfast Price" required>
</div><div class="form-group col-sm-6">
<label class="exampleModalLabel">Lunch Price</label>
<input  type="number" class="form-control" name="lunch" id="lunch" placeholder="Enter Lunch Price" required>
</div><div class="form-group col-sm-6">
<label class="exampleModalLabel">Dinner Price</label>
<input  type="number" class="form-control" name="dinner" id="dinner" placeholder="Enter Dinner Price" required>
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
    $('.edit_plandetails').click(function(){
    		var id=$(this).data('id');
    	
    		if(id){
          $.ajax({
    					type: "POST",
    
    					url: "{{ route('plandetailsfetch') }}",
    					data: {  "_token": "{{ csrf_token() }}",
    					id: id },
    					success: function (res) {
    					console.log(res);
              var obj=JSON.parse(res)
    		  $('#plandetailsid').val(obj.id);
              $('#plan_name').val(obj.name);
              $('#description').val(obj.description);
              $('#breakfast').val(obj.breakfast);
              $('#lunch').val(obj.lunch);
              $('#dinner').val(obj.dinner);
             
    					},
    					});	 
    		}
    		$('#editplandetails_modal').modal('show');
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