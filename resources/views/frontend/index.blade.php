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
        <img src="{{ asset('img/products/morchhadi-product.jpg') }}" 
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
    <div id="" class="row g-4">
      @foreach ($products as $product)
        <div class="col-12 col-sm-6 col-lg-4">
          <div class="card product-card h-100">
            <img src="{{ $product->image }}" class="tea-img w-100" alt="{{ $product->name }}">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title mb-1">{{ $product->name }}</h5>
              <p class="small text-muted mb-2">{{ $product->description }}</p>
              <div class="d-flex align-items-center mt-auto"><div class="price">₹ {{ $product->price }}</div><div class="ms-auto d-flex gap-2">
                <a class="btn btn-outline btn-success" href="https://wa.me/{{ $product->branches[0]->whatsapp_number }}?text=Hello, I need assistance on {{ $product->name }} product" target="_blank">
                  <i class="bi bi-whatsapp"></i>
                </a>
                <button class="btn btn-outline-secondary btn-sm view-btn" data-id="{{ $product->id }}">View</button>
                <button 
                  class="btn btn-primary btn-sm addToCartBtn"
                  data-id="{{ $product->id }}"
                  data-name="{{ $product->name }}"
                  data-price="{{ $product->price }}"
                  data-img="{{ asset($product->image) }}"
                >
                  Add
                </button>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </section>
@endsection
