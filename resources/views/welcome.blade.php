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
                            <h5 class="m-b-10">Dashboard Analytics</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        
        <!-- [ Main Content ] start -->
        <div class="row">

            @foreach($meals as $meal)
                @php
                    $today = date('Y-m-d');
                    $todayCount = DB::table('customer_charts')->where('meal_id', $meal->id)->where('date', $today)->count();

                    $mealPlans = DB::table('customer_charts')
                        ->leftJoin('plan_details', 'customer_charts.plan_id', '=', 'plan_details.id')
                        ->leftJoin('tbl_master_plans', 'plan_details.masterplan_id', '=', 'tbl_master_plans.id')
                        ->select(DB::raw('tbl_master_plans.id as plan_id, COUNT(customer_charts.id) as total'))
                        ->where('meal_id', $meal->id)
                        ->where('date', $today)
                        ->groupBy('tbl_master_plans.id')
                        ->pluck('total', 'plan_id');

                    $totalSilver = $mealPlans->get(1, 0); // Plan ID 1 is Silver
                    $totalGold = $mealPlans->get(2, 0); // Plan ID 2 is Gold
                    $totalVeg = $mealPlans->get(3, 0); // Plan ID 3 is Veg
                    $totalLunchPremium = $mealPlans->get(4, 0); // Plan ID 4 is Lunch Premium
                @endphp

                <div class="col-md-12 col-xl-4">
                    <div class="col-sm-12">{{ $meal->meals }}</div>
                    <div class="card flat-card">
                        <div class="row-table">
                            <div class="col-sm-6 card-body br">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <i class="icon feather icon-mail text-c-yellow mb-1 d-block"></i>
                                    </div>
                                    <div class="col-sm-8 text-md-center">
                                        <h5>{{ $totalSilver }}</h5>
                                        <span>Total Silver</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <i class="icon feather icon-mail text-c-yellow mb-1 d-block"></i>
                                    </div>
                                    <div class="col-sm-8 text-md-center">
                                        <h5>{{ $totalGold }}</h5>
                                        <span>Total Gold</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row-table">
                            <div class="col-sm-6 card-body br">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <i class="icon feather icon-mail text-c-yellow mb-1 d-block"></i>
                                    </div>
                                    <div class="col-sm-8 text-md-center">
                                        <h5>{{ $totalVeg }}</h5>
                                        <span>Total Veg</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <i class="icon feather icon-mail text-c-yellow mb-1 d-block"></i>
                                    </div>
                                    <div class="col-sm-8 text-md-center">
                                        <h5>{{ $totalLunchPremium }}</h5>
                                        <span>Total LP</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- widget primary card start -->
                    <div class="card flat-card widget-primary-card">
                        <div class="row-table">
                            <div class="col-sm-3 card-body">
                                <i class="feather icon-star-on"></i>
                            </div>
                            <div class="col-sm-7">
                                <h4>{{ $todayCount }}</h4>
                                <h6>Total {{ $meal->meals }}</h6>
                            </div>
                           
                            <div class="col-sm-2">
                           <a href="{{ route('customerList', ['id' => $meal->id]) }}" style="color:white;"><i class="feather icon-user"></i> </a>

                            </div>
                        </div>
                    </div>
                    <!-- widget primary card end -->
                </div>
            @endforeach

        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- [ Main Content ] end -->
@endsection
