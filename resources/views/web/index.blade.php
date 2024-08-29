@extends('layout.weblayout')
 @section('content')

 

    <main>
       
        <section id="home" class="hero">
            <div class="toplog">
                <img class="imgtop" src="{{asset('assets/images/web/img8-removebg-preview.png')}}" alt="" srcset="">
            </div>
            <div class="hero-container">
                <div class="hero-content">
                    <h1>Fitness that <span class="highlight">Fits your Life </span></h1>
                    <p>Get Fit with Top Grade Ultra Modern  Fitness Equipments
</p>
                    <a href="#products" class="cta-button">Contact Us</a>
                </div>
                <div class="hero-image">
                    <img src="{{asset('assets/images/web/3441d51d284640f5a9bae69e0048ea05.jpg')}}" alt="Premium Gym Equipment">
                </div>
            </div>
            <div class="dellercontainer">
                <img src="{{asset('assets/images/web/img8-removebg-preview.png')}}" alt="Company Logo" class="dellerlogo">
                <h1 class="dellerheading">Your Trusted Dealer in Kerala</h1>
                <p class="dellersubheading">Experience unparalleled service and quality with our extensive range of products.</p>
            </div>
        </section>
      
        <section id="products" class="products">
            <h2>Discover your Fitness Solution</h2>
            <div class="product-grid">
                @foreach($category as $categoryList)
                <div class="product-card">
                    <img src="{{ asset('/market/'.$categoryList->image) }}" alt="Treadmill">
                    <h3>{{$categoryList->category_name}}</h3>
                    <!-- <p>Advanced treadmill with AI-powered training</p> -->
                    <a href="{{ url('products/' . $categoryList->id) }}" class="btn">View More</a>
                </div>
                @endforeach
                
            </div>
        </section>

        <section id="features" class="features">
            <h2>Choose from the Best Worldwide </h2>
            <div class="feature-grid">
                <div class="feature-item">
                    <i class="fas fa-medal"></i>
                    <h3>Top Grade</h3>
                    <p>Premium quality</p>
                    <p>Imported products </p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-mobile-alt"></i>
                    <h3>Cutting-Edge</h3>
                    <p>AI Powered Innovative Technology </p>
                    <p>for Personalized Training </p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-users"></i>
                    <h3>Smart Integration </h3>
                    <p>Seamless connectivity to fitness apps </p>
                    <p>with access to global training sessions
                    </p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-cogs"></i>
                    <h3>Unmatched Service </h3>
                    <p>Unlimited Lifetime Service Support</p>
                </div>
            </div>
        </section>

        <section id="testimonials" class="testimonials">
            <h2>Your Trusted Gym Equipment Dealer in Kerala</h2>
            <div class="testimonial-slider">
                <div class="">
                    <p>Experience an unbeatable fitness journey with world-class Aerofit fitness equipments. Ensure  expert approved premium range of products from authorized Aerofit fitness equipment dealer in Kerala.
</p>
                </div>
               
            </div>
        </section>

        <section id="contact" class="contact">
            <h2>Get in Touch</h2>
            <form>
                <input type="text" placeholder="Name" required>
                <input type="email" placeholder="Email" required>
                <select required>
                    <option value="" disabled selected>Select Inquiry Type</option>
                    <option value="sales">Sales</option>
                    <option value="support">Support</option>
                    <option value="partnership">Partnership</option>
                </select>
                <textarea placeholder="Message" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </section>
    </main>

    @endsection
