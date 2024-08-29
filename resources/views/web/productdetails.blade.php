@extends('layout.weblayout')
 @section('content')

 @php
 $productImage=DB::table('tbl_productimages')->where('product_id',$productDetails->id)->first();
 $productImageall=DB::table('tbl_productimages')->where('product_id',$productDetails->id)->get();

 @endphp

    <main>
        <div class="product-container">
            <div class="product-gallery">
                <img src="{{ asset('/market/'.$productImage->images) }}" alt="Product Image" id="main-image">
                <div class="thumbnails">
                    @foreach($productImageall as $thumbnail)
                    <img src="{{ asset('/market/'.$thumbnail->images) }}" alt="Thumbnail 1" class="thumbnail">
                   
                    @endforeach
                </div>
            </div>
            <div class="product-info">
                <h1>{{$productDetails->product_name}}</h1>
                <p>{{$productDetails->description}}</p>
               
                <!-- <div class="price">₹99.99</div> -->
                <button class="add-to-cart"><i class="fas fa-shopping-cart"></i> Enquiry Now</button>
               
                <div class="product-meta">
                    <p><i class="fas fa-check-circle"></i> In Stock</p>
                   
                </div>
            </div>
        </div>

        <div class="product-details">
            <div class="tabs">
                <!-- <button class="tab-btn " data-tab="description">Description</button>
                <button class="tab-btn" data-tab="specs">Specifications</button>
                <button class="tab-btn" data-tab="reviews">Reviews</button> -->
                <button class="tab-btn active" data-tab="video">Video</button>
            </div>
            <div class="tab-content " id="description">
                <p>This is the product description. It's an amazing product with fantastic features!</p>
            </div>
            <div class="tab-content" id="specs">
                <ul>
                    <li><strong>Spec 1:</strong> Value</li>
                    <li><strong>Spec 2:</strong> Value</li>
                    <li><strong>Spec 3:</strong> Value</li>
                </ul>
            </div>
            <div class="tab-content" id="reviews">
                <div class="review">
                    <div class="review-header">
                        <span class="review-author">John D.</span>
                        <span class="review-rating">★★★★★</span>
                    </div>
                    <p class="review-text">Great product! Highly recommended.</p>
                </div>
                <div class="review">
                    <div class="review-header">
                        <span class="review-author">Jane S.</span>
                        <span class="review-rating">★★★★☆</span>
                    </div>
                    <p class="review-text">Good quality, but a bit pricey.</p>
                </div>
            </div>
            <div class="tab-content active" id="video">
                <div class="video-container">
                    <iframe width="560" height="315" src="{{$productDetails->video_link}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </main>
    @endsection
