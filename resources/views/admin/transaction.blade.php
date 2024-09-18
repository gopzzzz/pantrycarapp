@extends('layout.mainlayout') @section('content')

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start --> 
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Transactions</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Transactions</a></li>
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

          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add Transactions</button>

                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                        <form method="POST"  id="form1" action="{{ route('transactioninsert') }}" enctype="multipart/form-data">
@csrf
<div class="modal-dialog" role="document" style="width:80%;">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Add Transactions</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>

</button>

</div>
<div class="modal-body row">
<div class="form-group col-sm-6">
                                        <label class="exampleModalLabel">Account Head</label>
                                        <select name="account_head" class="form-control" required>
                                        <option value=""disabled selected>select Account Head</option>
                                        @foreach($account as $key)
                                        <option value="{{$key->id}}">{{$key->head_name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                   
                                    <div class="form-group col-sm-6">
                                                        <label class="exampleModalLabel">Type</label>
                                                        <select class="form-control" name="type" required>
                                                        <option value="0" disabled selected >Select Type</option>

                                                        <option value="1" >Income</option>
                                                        <option value="2" >Expense</option>
                                                        </select>
                                                    </div>

    <div class="form-group col-sm-6">
<label class="exampleModalLabel">Title</label>
<input  class="form-control" name="title" placeholder="Enter Title" required>
</div>
    <div class="form-group col-sm-6">
<label class="exampleModalLabel">Amount</label>
<input type="number" class="form-control" name="amount" placeholder="Enter Amount" required>

</div>
<div class="form-group col-sm-6">
<label class="exampleModalLabel">Remarks</label>
<textarea class="form-control" name="remark" placeholder="Enter Remarks" required></textarea>
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
                                                <th>TRANSACTION TYPE</th>
                                                <th>TITLE</th>
                                                <th>AMOUNT</th>
                                                <th>REMARK</th>
                                              
                                                <th>ACTION</th>

                                            </tr>
                                        </thead>
                                        <tbody>@php $i=1; @endphp @foreach($transaction as $key)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$key->head_name}}</td>
                                                <td>@if($key->type==1) INCOME @elseif($key->type==2) EXPENSE @endif</td>

                                                <td>{{$key->title}}</td>
                                                <td>{{$key->amount}}</td>
                                                <td>{{$key->remark}}</td>
                                              


                                               <td>
                                                <a href="#" onclick="confirmDelete('{{ $key->id }}')">
                                                <i class="fa fa-trash delete_banner text-danger" aria-hidden="true" data-id="{{ $key->id }}"></i> </td>
                                            </tr>@php $i++; @endphp @endforeach</tbody>
                                        <tfoot>
                                            <tr>
                                            <th>ID</th>
                                                <th>ACCOUNT HEAD NAME </th>
                                                <th>TRANSACTION TYPE</th>
                                                <th>TITLE</th>
                                                <th>AMOUNT</th>
                                                <th>REMARK</th>
                                              
                                                <th>ACTION</th>

                                            </tr>
                                        </tfoot>
                                    </table>
                                  



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
    function confirmDelete(transactionId) {
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
                window.location.href = "{{ url('transactiondelete') }}/" + transactionId;
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