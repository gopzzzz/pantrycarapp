
@extends('layout.mainlayout')
@section('content')

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Add Product</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Add Product</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
   <section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
<div class="col-sm-6">
 </div>
 <div class="col-sm-6">
 
  </div>
 </div>
</div>
<!-- /.container-fluid -->
   </section>
  @if(session('success'))
<h3 style="margin-left: 19px;color: green;">{{session('success')}}</h3>
 @endif
 <!-- Main content -->
<section class="content">
     <div class="container-fluid">
         <div class="row">
  <div class="col-12">
 <!-- /.card -->
  <div class="card">
 <div class="card-header">
 <p align="right">
<form method="POST" action="{{ route('productadd')}}" enctype="multipart/form-data">

                           @csrf
  <div class="modal-dialog" role="document" style="width:80%;">
  <div class="modal-content">
  <div class="modal-header">

</div>
                                 <div class="modal-body row">

                                 <div class="form-group col-sm-12">
    <label class="exampleModalLabel">Product Name</label>
    
    <input class="form-control" name="product_name" placeholder="Enter Product Name" required>
 
</div>
<div class="form-group col-sm-12">
<label class="exampleModalLabel">Category</label>
<select name="category" class="form-control" required>
<option value=""disabled selected>Select Category</option>
@foreach($category as $Categoryy)
            <option value="{{ $Categoryy->id }}">{{ $Categoryy->category_name }}</option>
        @endforeach
</select>
</div>
<input type="hidden" name="product_id">
<div class="form-group col-sm-12">
                                        <label class="exampleModalLabel">Images</label>

                    <input class="form-control" type="file" name="images[]" accept="image/*" multiple required>
                    </div>            

<div class="form-group col-sm-12">
    <label class="exampleModalLabel">Description</label>
    <textarea class="form-control" name="description" placeholder="Enter Description" required></textarea>
</div>



                    <div class="form-group col-sm-12">
        <label class="exampleModalLabel">Video Link</label>
        <input  name="video_link" class="form-control" placeholder="Enter Video Link"  required>
    </div>
    </div>

    <div class="modal-footer">
       <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                 </div>
                                 </div>
 </div>
 </form> 



                  <!-- /.card-header -->
 
                        </div>



                     </div>
                        

 

   
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
    {{ Session::forget('success') }} 
@endif

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
@if ($errors->any())
    @php
        $allErrors = '';
        foreach ($errors->all() as $error) {
            $allErrors .= $error . '\n';
        }
    @endphp
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
@endif


@endsection






