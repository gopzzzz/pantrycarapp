@extends('layout.mainlayout')

@section('content')
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
                            <h5 class="m-b-10">Meals Cancellation</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Meals Cancellation</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <div class="content-wrapper">
            @if(session('success'))
                <h3 style="margin-left: 19px; color: green;">{{ session('success') }}</h3>
                @else
                <h3 style="margin-left: 19px; color: red;">{{ session('error') }}</h3>
            @endif

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <!-- Card -->
                            <div class="card">
                                <div class="card-header">
                                    <p align="right">
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <!-- Modal content will go here -->
                                        </div>
                                    </p>
                                </div>
                                <div class="card-body">
                                    <form method="POST" id="form1" action="{{ route('cancelfoodmeals') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-dialog" role="document" style="width:80%;">
                                            <div class="modal-content">
                                                <div class="modal-body row">
                                                <div class="form-group col-sm-12">
                                                        <label class="exampleModalLabel">Select Customer Name </label>
                                                        <select name="customerid" class="form-control " required>
                                                        <option value="0" selected>Choose customer Name </option>
                                                        @foreach($customer as $cuskey)
                                                        <option value="{{$cuskey->id}}" >{{$cuskey->name}} </option>
                                                        @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-sm-12">
                                                        <label class="exampleModalLabel">Select Cancellation Type</label>
                                                        <select name="canceltype" class="form-control cancellation_type" required>
                                                            <option value="0" selected>Choose Cancellation Type</option>
                                                            <option value="1">Per Day Cancellation</option>
                                                            <option value="2">Number Of Days Cancellation</option>
                                                            <option value="3">Per Meal Cancellation</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-sm-12" style="display:none;" id="mealtype">
                                                        <label class="exampleModalLabel">Select Meals Type</label>
                                                        <select name="meal_type" class="form-control " required>
                                                        <option value="0" selected>Choose  Meals Type</option>
                                                        @foreach($meal_type as $mealkey)
                                                        <option value="{{$mealkey->id}}" >{{$mealkey->meals}} </option>
                                                        @endforeach
                                                        </select>
                                                       
                                                    </div>

                                                    <div class="form-group col-sm-12" style="display:none;" id="selectfromdate">
                                                        <label class="exampleModalLabel">From Date</label>
                                                        <input type="date" class="form-control" name="from_date" >
                                                    </div>

                                                    <div class="form-group col-sm-12" style="display:none;" id="selecttodate">
                                                        <label class="exampleModalLabel">To Date</label>
                                                        <input type="date" class="form-control" name="to_date" >
                                                    </div>

                                                    <div class="form-group col-sm-12" style="display:none;" id="datesection">
                                                        <label class="exampleModalLabel">Select Date</label>
                                                        <input type="date" class="form-control" name="date" >
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Cancel</button>
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
            </section>
            <!-- /.content -->
        </div>
    </div>
</div>

<!-- JavaScript and Libraries -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {
        $('.cancellation_type').on('change', function() {
            const type = $(this).val();
            switch (type) {
                case '1':
                    $('#datesection').show();
                    $('#selectfromdate').hide();
                    $('#selecttodate').hide();
                    $('#mealtype').hide();
                    break;
                case '2':
                    $('#selectfromdate').show();
                    $('#selecttodate').show();
                    $('#datesection').hide();
                    $('#mealtype').hide();
                    break;
                case '3':
                    $('#mealtype').show();
                    $('#selectfromdate').hide();
                    $('#selecttodate').show();
                    $('#datesection').hide();
                    break;
                default:
                    $('#datesection, #selectfromdate, #selecttodate, #mealtype').hide();
                    break;
            }
        });

        $('#form1').on('submit', function(e) {
            e.preventDefault(); // Prevent the form from submitting immediately

            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to cancel this action?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, cancel it!',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit(); // Submit the form if confirmed
                }
            });
        });
    });
</script>

<!-- Toastr Notifications -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@if(Session::has('success'))
<script>
    toastr.options = {
        "positionClass": "toast-top-center",
        "progressBar": true,
        "preventDuplicates": true,
        "timeOut": "3000"
    };
    toastr.success("{{ session('success') }}", 'Success');
</script>
{{ Session::forget('success') }}
@endif

<!-- SweetAlert2 Notifications -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
@if ($errors->any())
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var errorMessages = `{!! $errors->all() !!}`;
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            text: errorMessages,
        });
    });
</script>
@endif
@endsection
