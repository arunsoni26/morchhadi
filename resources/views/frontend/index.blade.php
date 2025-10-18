@extends('frontend.layouts.app')

@section('title', 'Morchadi — Home')

@section('content')
  <!-- Hero Section -->
  <header class="container my-5">
    <div class="row align-items-center">
      <div class="col-lg-7 col-md-6 col-12 mb-4 mb-md-0 text-center text-md-start">
        <h1 class="display-5 fw-bold">Sip joy. Savor calm.</h1>
        <p class="lead text-muted">Handpicked premium tea blends from across the globe — delivered to your cup.</p>
        <a href="{{ route('products') }}" class="btn btn-primary btn-lg mt-2">Shop Teas</a>
      </div>
      <div class="col-lg-5 col-md-6 col-12 text-center">
        <img src="https://images.unsplash.com/photo-1510627498534-cf7e9002facc?auto=format&fit=crop&w=900&q=60" 
             class="img-fluid rounded shadow-sm hero-img" alt="Tea hero">
      </div>
    </div>
  </header>

  <!-- Featured Products -->
  <section class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
      <h3 class="mb-0">Featured Blends</h3>
      <a href="{{ route('products') }}" class="text-decoration-none">View all</a>
    </div>
    <div id="featuredGrid" class="row g-4">
      <!-- Product cards populated dynamically (e.g. using JS or Blade loop) -->
    </div>
  </section>
@endsection
