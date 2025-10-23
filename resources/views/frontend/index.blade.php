@extends('frontend.layouts.app')

@section('title', 'Morchadi — Home')

@section('content')
  <!-- Hero Section -->
  <header class="container hero-section my-5">
    <div class="hero-overlay"></div>
    <div class="row align-items-center">
      <div class="col-lg-7 col-md-6 col-12 mb-4 mb-md-0 text-center text-md-start">
        <h1 class="display-5 fw-bold">Sip joy. Savor calm.</h1>
        <p class="lead text-muted">Handpicked premium tea blends from across the globe — delivered to your cup.</p>
        <a href="{{ route('products') }}" class="btn btn-primary btn-lg mt-2">Shop Teas</a>
      </div>
      <div class="col-lg-5 col-md-6 col-12 text-center">
        <img src="{{ asset('img/products/morchhadi-product.jpg') }}" 
             class="img-fluid rounded shadow-sm hero-img" alt="Tea hero">
      </div>
    </div>
  </header>
  
  <!-- Why Choose Us -->
  <section class="container why-choose">
    <div class="text-center mb-5">
      <h2>Why Choose Us</h2>
      <p class="text-muted">Experience the difference with every cup.</p>
    </div>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="feature-card">
          <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-leaf" viewBox="0 0 16 16">
              <path d="M1.4 1.7c.216.289.65.84 1.725 1.274 1.093.44 2.884.774 5.834.528l.37-.023c1.823-.06 3.117.598 3.956 1.579C14.16 6.082 14.5 7.41 14.5 8.5c0 .58-.032 1.285-.229 1.997q.198.248.382.54c.756 1.2 1.19 2.563 1.348 3.966a1 1 0 0 1-1.98.198c-.13-.97-.397-1.913-.868-2.77C12.173 13.386 10.565 14 8 14c-1.854 0-3.32-.544-4.45-1.435-1.125-.887-1.89-2.095-2.391-3.383C.16 6.62.16 3.646.509 1.902L.73.806zm-.05 1.39c-.146 1.609-.008 3.809.74 5.728.457 1.17 1.13 2.213 2.079 2.961.942.744 2.185 1.22 3.83 1.221 2.588 0 3.91-.66 4.609-1.445-1.789-2.46-4.121-1.213-6.342-2.68-.74-.488-1.735-1.323-1.844-2.308-.023-.214.237-.274.38-.112 1.4 1.6 3.573 1.757 5.59 2.045 1.227.215 2.21.526 3.033 1.158.058-.39.075-.782.075-1.158 0-.91-.288-1.988-.975-2.792-.626-.732-1.622-1.281-3.167-1.229l-.316.02c-3.05.253-5.01-.08-6.291-.598a5.3 5.3 0 0 1-1.4-.811"></path>
            </svg>
          </div>
          <h5>Premium Ingredients</h5>
          <p class="text-muted">We source only the finest tea leaves from sustainable farms.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="feature-card">
          <div class="icon"><i class="bi bi-clock-history"></i></div>
          <h5>Freshly Packed</h5>
          <p class="text-muted">Each order is handled and packed fresh for you.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="feature-card">
          <div class="icon"><i class="bi bi-truck"></i></div>
          <h5>Fast Delivery</h5>
          <p class="text-muted">Get your tea delivered promptly across the region.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Featured Products -->
  <section class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
      <h3 class="mb-0">Featured Blends</h3>
      <a href="{{ route('products') }}" class="text-decoration-none">View all</a>
    </div>
    <div id="" class="row g-4">
      @foreach ($products as $product)
        <div class="col-12 col-sm-6 col-lg-4">
          <div class="card product-card h-100">
            <img src="{{ $product->image }}" class="tea-img w-100" alt="{{ $product->name }}">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title mb-1">{{ $product->name }}</h5>
              <p class="small text-muted mb-2">{{ $product->description }}</p>
              <div class="d-flex align-items-center mt-auto"><div class="price">₹ {{ $product->price }}</div><div class="ms-auto d-flex gap-2">
                <a href="https://wa.me/{{ $product->whatsapp_number }}?text=Hello%20I%20want%20to%20inquire%20about%20{{ urlencode($product->name) }}"
                  class="btn btn-outline-success btn-sm" target="_blank" title="Chat on WhatsApp">
                  <i class="bi bi-whatsapp"></i>
                </a>

                <a href="{{ route('product.view', $product->id) }}" class="btn btn-sm btn-outline-secondary" title="View Product">
                    View
                </a>
                <!-- <button 
                  class="btn btn-primary btn-sm addToCartBtn"
                  data-id="{{ $product->id }}"
                  data-name="{{ $product->name }}"
                  data-price="{{ $product->price }}"
                  data-img="{{ asset($product->image) }}"
                >
                  Add
                </button> -->
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </section>
  
  <section class="container testimonials">
    <div class="text-center mb-5">
      <h2>What Our Customers Say</h2>
      <p class="text-muted">Real reviews from tea enthusiasts.</p>
    </div>
    <div class="row g-4">
      <div class="col-md-6 col-lg-4">
        <div class="testimonial-card">
          <div class="quote-icon"><i class="bi bi-chat-quote-fill"></i></div>
          <p>"Absolutely love the aroma and flavour. My go-to brand for relaxing evenings."</p>
          <div class="customer">— Priya R.</div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="testimonial-card">
          <div class="quote-icon"><i class="bi bi-chat-quote-fill"></i></div>
          <p>"Prompt delivery and superb packaging. The tea stays fresh longer."</p>
          <div class="customer">— Anil S.</div>
        </div>
      </div>
      <!-- Add more testimonials as needed -->
    </div>
  </section>
@endsection
