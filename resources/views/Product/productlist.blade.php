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
                            <h5 class="m-b-10">Product List</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Product List</a></li>
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

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  </div>
  </div>
<div class="card-body">

<table id="example1" class="table table-bordered table-striped">
 <thead>
  <tr>

 <th>id</th>
 <th>Product Images</th>

 <th>Product Name</th>
 <th>Category Name</th>
<th>Description</th>
<th>Video Link</th>

                                        <th>Status</th>
 <th>Action</th>
  </tr>
 </thead>
   <tbody>@php $i=1; @endphp 
    @foreach($product as $key)
									<tr>
										<td>{{$i}}</td>
                                        <td>
    <button type="button" class="btn btn-success btn-sm image_show" 
            data-toggle="modal" 
            data-id="{{$key->id}}">
        <i class="fa fa-eye"></i> Images
    </button>
</td>
                                        <td>{{$key->product_name}}</td>
                                        <td>{{$key->category_name}}</td>

 <td>{{$key->description}}</td>

                                                                           <td>
    <a href="{{ $key->video_link }}" style="color: blue;" target="_blank">
        {{ $key->video_link }}
    </a>
</td>
                                        <td>

@if($key->status==0) Active @else Inactive @endif</td>

<td> <i class="fa fa-edit edit_product" aria-hidden="true" data-toggle="modal" data-id="{{$key->id}}"></i>
</td>

									</tr>@php $i++; @endphp @endforeach</tbody>
								<tfoot>
									<tr>
									<th>id</th>
                                    <th>Product Images</th>

 <th>Product Name</th>
 <th>Category Name</th>

 <th>Description</th>

                                        <th>Video Link</th>

                                        <th>Status</th>
 <th>Action</th>

									</tr>
								</tfoot>
							</table>
                            <div class="modal fade" id="exampleModalimageadd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{ route('productimageinsert') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Images</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="form-group row">
              &nbsp;  &nbsp; &nbsp; <div class="form-group col-sm-6">
                    <label class="exampleModalLabel">Image</label>
                    <input type="hidden" name="productid" id="prod_id">
                    <input class="form-control" type="file" name="images[]" accept="image/*" multiple required>

                </div>
                <div class="modal-footer d-flex justify-content-center">
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</div>
</div>

                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>id</td>
                                <td>Images</td>
                                <td>Action</td> 

                            </tr>
                        </thead>
                        <tbody id="imageshowtbody"></tbody>
                    </table>
                 
                </div>
            </div>
        </div>
    </form>
</div>
             
		<div class="modal" id="editproduct_modal" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
 <div class="modal-content">
 <div class="modal-header">
<h5 class="modal-title">Edit Product</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
 </div>
 <form method="POST" action="{{url('productedit')}}" enctype="multipart/form-data">
@csrf
<div class="modal-body row">
      <div class="form-group col-sm-12">
<input type="hidden" name="id" id="productid">


<div class="form-group col-sm-12">
    <label class="exampleModalLabel">Product Name</label>
    
    <input class="form-control" name="product_name" id="product_name" placeholder="Enter Product Name" required>
 
</div>
<div class="form-group col-sm-12">
<label class="exampleModalLabel">Category</label>
<select name="category" id="category" class="form-control" required>
<option value=""disabled selected>Select Category</option>
@foreach($category as $Categoryy)
            <option value="{{ $Categoryy->id }}">{{ $Categoryy->category_name }}</option>
        @endforeach
</select>
</div>
       

<div class="form-group col-sm-12">
    <label class="exampleModalLabel">Description</label>
    <textarea class="form-control" name="description" id="description" placeholder="Enter Description" required></textarea>
</div>

    <div class="form-group col-sm-12">
        <label class="exampleModalLabel">Video Link</label>
        <input name="video_link" id="video_link" class="form-control" required>
    </div>
    <div class="form-group col-sm-12">

<label class="exampleModalLabel">Status</label>

<select name="status" id="status" class="form-control"  required>

<option value="0">Active</option>
<option value="1">In Active</option>

</select>

</div>
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
$('.edit_product').click(function(){
		var id=$(this).data('id');
	
		if(id){
      $.ajax({
					type: "POST",

					url: "{{ route('productfetch') }}",
					data: {  "_token": "{{ csrf_token() }}",
					id: id },
					success: function (res) {
					console.log(res);
          var obj=JSON.parse(res)
		  $('#productid').val(obj.id);
          $('#product_name').val(obj.product_name);
          $('#description').val(obj.description);
          $('#video_link').val(obj.video_link);

          $('#category').val(obj.category_id);

		  $('#status').val(obj.status);
         
					},
					});	 
		}
		$('#editproduct_modal').modal('show');
	});
    </script>
    
    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@if(Session::has('success'))
    <script>
        // Set the Toastr options including the position
        toastr.options = {
            "positionClass": "toast-top-center toast-margin", 
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

<script>
    $(document).ready(function () {
        $('#example1').on('click', '.image_show', function () {
            var prod_id = $(this).data('id');

            if (prod_id) {
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('productimagefetch') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        prod_id: prod_id
                    },
                    success: function (res) {
                        $('#imageshowtbody').empty();
                        var i = 1;

                        $.each(res, function (key, value) {
                            var img = $('<img>').attr('src', "{{ asset('market/') }}/" + value.images).attr('alt', 'Image');
                            img.css({
                                width: '100px',
                                height: 'auto',
                            });

                            var row = $('<tr>');
                            var cell1 = $('<td>').text(i);
                            var cell2 = $('<td>').append(img);

                            // Delete button and hidden input for image ID
                            var cell3 = $('<td>');
                            var deleteBtn = $('<button>').addClass('btn btn-danger btn-sm delete-image').data('image-id', value.id).text('Delete');
                            var hiddenInput = $('<input>').attr({
                                type: 'hidden',
                                name: 'image_ids[]',
                                value: value.id,
                            });

                            cell3.append(deleteBtn, hiddenInput);
                            row.append(cell1, cell2, cell3);

                            $('#imageshowtbody').append(row);
                            i++;
                        });

                      
                        $('#exampleModalimageadd').on('click', '.delete-image', function () {
                            var imageId = $(this).data('image-id');
                            var row = $(this).closest('tr');

                           
                            if (confirm("Are you sure you want to delete this image?")) {
                               
                                $.ajax({
                                    type: "POST",
                                    dataType: "json",
                                    url: "{{ route('productimagedelete') }}",
                                    data: {
                                        "_token": "{{ csrf_token() }}",
                                        image_id: imageId
                                    },
                                    success: function (response) {
                                    
                                        if (response.success) {
                                            row.remove();
                                        } else {
                                            alert("Failed to delete image. Please try again.");
                                        }
                                    },
                                    error: function () {
                                        alert("Error deleting image. Please try again.");
                                    }
                                });
                            }
                        });
						$('#prod_id').val(prod_id);

                     
                        $('#exampleModalimageadd').modal('show');
                    },
                });
            }
        });
    });
</script>
@endsection










