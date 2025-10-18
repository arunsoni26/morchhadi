@extends('frontend.layouts.app')

@section('title', 'Morchadi — Products')

@section('content')
<main class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Products</h2>
        <div class="d-flex gap-2">
            <!-- Filters -->
            <div class="btn-group">
                <button class="btn btn-sm btn-outline-secondary filter-pill" data-filter="all">All</button>
                <button class="btn btn-sm btn-outline-secondary filter-pill" data-filter="black">Black</button>
                <button class="btn btn-sm btn-outline-secondary filter-pill" data-filter="green">Green</button>
                <button class="btn btn-sm btn-outline-secondary filter-pill" data-filter="herbal">Herbal</button>
            </div>
            <!-- Sorting -->
            <select id="sortSelect" class="form-select form-select-sm" style="width:160px">
                <option value="popular">Popular</option>
                <option value="price-asc">Price low → high</option>
                <option value="price-desc">Price high → low</option>
            </select>
        </div>
    </div>

    <!-- Product Grid -->
    <div id="productGrid" class="row g-4">
        {{-- Example static product card (you can replace with @foreach for dynamic data) --}}
        @foreach($products ?? [] as $product)
            <div class="col-md-3 col-sm-6">
                <div class="card h-100 shadow-sm">
                    <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body text-center">
                        <h6 class="fw-bold">{{ $product->name }}</h6>
                        <p class="text-muted mb-1">₹{{ number_format($product->price, 2) }}</p>
                        <button class="btn btn-sm btn-outline-primary add-to-cart" data-id="{{ $product->id }}">
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</main>
@endsection
