
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
                            <h5 class="m-b-10">Enquiry List</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Enquiry List</a></li>
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
<th>Product Name</th>
 <th>Customer Name</th>
 <th>Phone Number</th>
 <th>Email Address</th>
  </tr>
 </thead>
   <tbody>@php $i=1; @endphp 
    @foreach($enquiry as $key)
									<tr>
										<td>{{$i}}</td>
                                        <td>{{$key->product_name}}</td>
                                        <td>{{$key->customer_name}}</td>
                                        <td>{{$key->customer_phone}}</td>
                                        <td>{{$key->customer_email}}</td>
									</tr>@php $i++; @endphp @endforeach</tbody>
								<tfoot>
									<tr>
                                    <th>id</th>
<th>Product Name</th>
 <th>Customer Name</th>
 <th>Phone Number</th>
 <th>Email Address</th>

									</tr>
								</tfoot>
							</table>
	
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

@endsection










