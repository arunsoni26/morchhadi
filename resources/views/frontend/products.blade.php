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
        
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height:200px;">

                <div class="card-body text-center">
                    <h6 class="fw-bold">{{ $product->name }}</h6>
                    <p class="text-muted mb-1 small">
                        {{ $product->category->name ?? 'Uncategorized' }}
                    </p>
                    <p class="text-dark mb-1 fw-semibold">
                        ₹{{ number_format($product->price, 2) }}
                    </p>

                    <div class="d-flex justify-content-center gap-2">
                        @if($product->whatsapp_number)
                        <a href="https://wa.me/{{ $product->whatsapp_number }}?text=Hello%20I%20want%20to%20inquire%20about%20{{ urlencode($product->name) }}"
                            class="btn btn-outline-success btn-sm" target="_blank" title="Chat on WhatsApp">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                        @endif

                        <a href="{{ route('product.view', $product->id) }}" class="btn btn-sm btn-outline-secondary" title="View Product">
                            View
                        </a>

                    </div>
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