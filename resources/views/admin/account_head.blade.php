@extends('layout.mainlayout') @section('content')

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start --> 
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Account Head</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Account Head</a></li>
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

          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Account Head</button>

                               

                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                        <form method="POST"  id="form1" action="{{ route('account_headinsert') }}" enctype="multipart/form-data">
@csrf
<div class="modal-dialog" role="document" style="width:80%;">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Add Account Head</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>

</button>

</div>
<div class="modal-body row">
<div class="form-group col-sm-12">
<label class="exampleModalLabel">Account Head Name</label>
<input class="form-control" name="head_name"  placeholder="Enter Account Head Name" required>
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
                                            <th>ACCOUNT HEAD NAME </th>
                                            <th>STATUS </th>

                                                <th>ACTION</th>

                                            </tr>
                                        </thead>
                                        <tbody>@php $i=1; @endphp @foreach($account as $key)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$key->head_name}}</td>
                                                <td>@if($key->status==0) ACTIVE @elseif($key->status==1) INACTIVE @endif</td>


                                               <td> <i class="fa fa-edit edit_accounthead" aria-hidden="true" data-toggle="modal" data-id="{{ $key->id }}"></i>

                                               
                                                <a href="#" onclick="confirmDelete('{{ $key->id }}')">
                                                <i class="fa fa-trash delete_banner text-danger" aria-hidden="true" data-id="{{ $key->id }}"></i> </td>
                                            </tr>@php $i++; @endphp @endforeach</tbody>
                                        <tfoot>
                                            <tr>
                                            <th>ID</th>
                                                <th>ACCOUNT HEAD NAME </th>
                                                <th>STATUS </th>

                                                <th>ACTION</th>


                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="modal" id="editaccount_modal" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Account Head Details</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{url('account_headedit')}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body row">
                                                            <input type="hidden" name="id" id="accountid">

                                                            <div class="form-group col-sm-12">
<label class="exampleModalLabel">Account Head Name</label>
<input class="form-control" name="head_name" id="head_name" placeholder="Enter Account Head Name" required>
</div>
<div class="form-group col-sm-12">

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
    $('.edit_accounthead').click(function(){
    		var id=$(this).data('id');
    	
    		if(id){
          $.ajax({
    					type: "POST",
    
    					url: "{{ route('account_headfetch') }}",
    					data: {  "_token": "{{ csrf_token() }}",
    					id: id },
    					success: function (res) {
    					console.log(res);
              var obj=JSON.parse(res)
    		  $('#accountid').val(obj.id);
              $('#head_name').val(obj.head_name);
              $('#status').val(obj.status);

             
    					},
    					});	 
    		}
    		$('#editaccount_modal').modal('show');
    	});
</script>
<script>
    function confirmDelete(accountId) {
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
                window.location.href = "{{ url('account_headdelete') }}/" + accountId;
            }
        });
    }
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