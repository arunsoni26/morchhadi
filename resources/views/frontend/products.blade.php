@extends('frontend.layouts.app')

@section('title', 'Morchadi — Products')

@section('content')
<main class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Products</h2>

        <div class="d-flex gap-2">
            <!-- 🟡 Category Filter -->
            <form id="filterForm" method="GET" action="{{ route('products') }}" class="d-flex gap-2">
                <select name="category_id" class="form-select form-select-sm" style="width: 180px" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    @foreach($categories as $id => $name)
                        <option value="{{ $id }}" {{ request('category_id') == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>

                <!-- 🟡 Price Sorting -->
                <select name="sort" id="sortSelect" class="form-select form-select-sm" style="width:160px" onchange="this.form.submit()">
                    <option value="">Sort by</option>
                    <option value="price-asc" {{ request('sort') == 'price-asc' ? 'selected' : '' }}>Price low → high</option>
                    <option value="price-desc" {{ request('sort') == 'price-desc' ? 'selected' : '' }}>Price high → low</option>
                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Popular</option>
                </select>
            </form>
        </div>
    </div>

    <!-- 🟡 Product Grid -->
    <div id="productGrid" class="row g-4">
        @forelse($products as $product)
            @php
                $gallery = json_decode($product->gallery_images, true);
                $firstImage = $gallery[0] ?? 'images/no-image.jpg';
            @endphp

            <div class="col-md-3 col-sm-6">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset($firstImage) }}" class="card-img-top" alt="{{ $product->name }}">

                    <div class="card-body text-center">
                        <h6 class="fw-bold">{{ $product->name }}</h6>
                        <p class="text-muted mb-1 small">
                            {{ $product->category->name ?? 'Uncategorized' }}
                        </p>
                        <p class="text-dark mb-1 fw-semibold">
                            ₹{{ number_format($product->price, 2) }}
                        </p>
                        <button class="btn btn-sm btn-outline-primary add-to-cart" data-id="{{ $product->id }}">
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted mb-0">No products found.</p>
            </div>
        @endforelse
    </div>
</main>
@endsection
