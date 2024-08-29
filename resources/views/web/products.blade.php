@extends('layout.weblayout')
 @section('content')

    <section class="container">
        <div class="offer-banner">
            <h2>Summer Fitness Extravaganza!</h2>
            <p>Unleash your potential with <span class="highlight">up to 50% OFF</span> on premium equipment. Transform your workouts today!</p>
        </div>

        <div class="search-filter-container">
            <!-- <div class="search-bar">
                <input type="text" placeholder="Search products...">
            </div> -->
            <!-- <div class="filter-options">
                <select>
                    <option value="">Category</option>
                    <option value="cardio">Cardio</option>
                    <option value="strength">Strength</option>
                    <option value="yoga">Yoga</option>
                </select>
               
            </div> -->
        </div>

        <div class="product-grid">
            @foreach($productList as $products)
            @php 
            $productImgae=DB::table('tbl_productimages')->where('product_id',$products->id)->first();
            @endphp
            <div class="product-card">
                <span class="sale-tag">SALE</span>
                <img src="{{ asset('/market/'.$productImgae->images) }}" alt="UltraGlide Pro Treadmill" class="product-image">
                <div class="product-info">
                    <h2 class="product-name">{{$products->product_name}}</h2>
                    <!-- <p class="product-price">₹1,499.99</p> -->
                    <a href="{{ url('productdetails/' . $products->id) }}" class="btn">More Details</a>
                </div>
            </div>
            @endforeach
            <!-- Add more product cards here -->
        </div>
    </section>
    @endsection
