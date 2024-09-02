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
.mess_heading{
    border: 1px solid green;
    background-color: green;
    color: white;
    font-size: 20px;
    font-family: 'feather';
    margin: 1px;
    padding: 4px;
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
                            <h5 class="m-b-10">Menu List</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Menu List</a></li>
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
            <div class="col-sm-8">
                <!-- Begin Form -->
                <form method="POST" action="{{ url('categoryedit') }}" enctype="multipart/form-data">
                    @csrf
                    <label for="category_name">Plan Name</label>
                    <div class="form-row align-items-center">
                    
                        <div class="form-group col-sm-6">
                            
                            <input type="text" class="form-control" name="category_name" id="category_name" required>
                        </div>
                        <label for="category_name">Day Name</label>
                    <div class="form-row align-items-center">
                    
                        <div class="form-group col-sm-6">
                            
                            <input type="text" class="form-control" name="category_name" id="category_name" required>
                        </div>
                        <label for="category_name">Meals Type</label>
                    <div class="form-row align-items-center">
                    
                        <div class="form-group col-sm-6">
                            
                            <input type="text" class="form-control" name="category_name" id="category_name" required>
                        </div>
                        <label for="category_name">Meals Name</label>
                    <div class="form-row align-items-center">
                    
                        <div class="form-group col-sm-6">
                            
                            <input type="text" class="form-control" name="category_name" id="category_name" required>
                        </div>
                        <div class="form-group col-sm-4 d-flex  align-items-center">
                            <button type="submit" class="btn btn-success">+ ADD RECORD</button>
                        </div>
                    </div>
                </form>
                <!-- End Form -->
            </div>
        </div>
    </div>
</section>




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

                                    <p align="right">

                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                        </div>
                                </div>
                                <div class="card-body">
                                

                                <div class="card-body table-border-style">
                        <div class="table-responsive">
                            @foreach($plans as $singlePlans)
                        <div class="mess_heading">{{$singlePlans->name}}</div>
                            <table class="table">
                                <thead>
                                    <tr>
                                       
                                        <th>DAYS</th>
                                        <th>BREAKFAST</th>
                                        <th>LUNCH</th>
                                        <th>DINNER</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($days as $singleDays)
                                        @php 
                                        $getBreakfast=DB::table('menus')->where('meal_id',1)->where('plan_id',$singlePlans->id)->where('day_id',$singleDays->id)->value('menu');
                                        $getlunch=DB::table('menus')->where('meal_id',2)->where('plan_id',$singlePlans->id)->where('day_id',$singleDays->id)->value('menu');
                                        $getdinner=DB::table('menus')->where('meal_id',3)->where('plan_id',$singlePlans->id)->where('day_id',$singleDays->id)->value('menu');
                                        @endphp
                                    <tr class="table-active">
                                        <td>{{$singleDays->day}}</td>
                                        <td>{{$getBreakfast}}</td>
                                        <td>{{$getlunch}}</td>
                                      
                                        <td>{{$getdinner}}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                      
                                        <th>DAYS</th>
                                        <th>BREAKFAST</th>
                                        <th>LUNCH</th>
                                        <th>DINNER</th>
                                    </tr>
                                </tbody>
                            </table>
                      
                        @endforeach
                        



                                 
                                    <div class="modal" id="editcategory_modal" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Days</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{url('categoryedit')}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body row">
                                                        <div class="form-group col-sm-12">
                                                            <input type="hidden" name="id" id="categoryid">


                                                            <div class="form-group col-sm-12">

                                                                <label class="exampleModalLabel">Category Name</label>

                                                                <input type="text" class="form-control" name="category_name" id="category_name" required>
                                                            </div>
                                                            <div class="form-group col-sm-6">
                                                                <label class="exampleModalLabel">Category Image</label>
                                                                <input type="file" name="image" accept="image/*" id="image">
                                                            </div>

                                                            <div class="form-group col-sm-12">

                                                                <label class="exampleModalLabel">Status</label>

                                                                <select name="status" id="status" class="form-control" required>

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
    $('.edit_category').click(function(){
    		var id=$(this).data('id');
    	
    		if(id){
          $.ajax({
    					type: "POST",
    
    					url: "#",
    					data: {  "_token": "{{ csrf_token() }}",
    					id: id },
    					success: function (res) {
    					console.log(res);
              var obj=JSON.parse(res)
    		  $('#categoryid').val(obj.id);
              $('#category_name').val(obj.category_name);
    
    		  $('#status').val(obj.status);
             
    					},
    					});	 
    		}
    		$('#editcategory_modal').modal('show');
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