@extends('frontend.layouts.app')

@section('title', 'Morchadi — Products')

@push('styles')
<!-- 💅 Hover & Responsive Styles -->
<style>
.card {
    transition: all 0.3s ease;
    border: none;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}
.card-img-top {
    object-fit: cover;
    height: 200px;
    border-top-left-radius: 0.5rem;
    border-top-right-radius: 0.5rem;
}
@media (max-width: 576px) {
    #searchInput, #categorySelect, #sortSelect {
        width: 100% !important;
    }
    .d-flex.flex-md-row {
        flex-direction: column !important;
        align-items: stretch !important;
    }
}
</style>
@endpush

@section('content')
<main class="container my-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
        <h2 class="fw-bold mb-0">Our Products</h2>

        <div class="d-flex flex-wrap gap-2 align-items-center">
            <!-- 🔍 Live Search -->
            <input type="text" id="searchInput" class="form-control form-control-sm" 
                   placeholder="Search products..." style="width: 200px;">

            <!-- 🟡 Category Filter -->
            <select name="category_id" id="categorySelect" class="form-select form-select-sm" style="width: 180px">
                <option value="">All Categories</option>
                @foreach($categories as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>

            <!-- 🟡 Price Sorting -->
            <select name="sort" id="sortSelect" class="form-select form-select-sm" style="width:160px">
                <option value="">Sort by</option>
                <option value="price-asc">Price low → high</option>
                <option value="price-desc">Price high → low</option>
                <option value="popular">Popular</option>
            </select>
        </div>
    </div>

    <!-- 🟡 Product Grid -->
    <div id="productGrid" class="row g-4">
        @include('frontend.partials.product_list', ['products' => $products])
    </div>
</main>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
<script>
$(document).ready(function() {

    // Function to fetch filtered/sorted/searched products
    function fetchProducts() {
        let query = $('#searchInput').val();
        let category = $('#categorySelect').val();
        let sort = $('#sortSelect').val();

        $.ajax({
            url: "{{ route('products') }}",
            method: 'GET',
            data: { search: query, category_id: category, sort: sort },
            beforeSend: function() {
                $('#productGrid').html('<div class="text-center py-5 w-100"><div class="spinner-border text-success"></div></div>');
            },
            success: function(data) {
                $('#productGrid').html($(data));
            },
            error: function() {
                $('#productGrid').html('<div class="text-center text-danger py-5">Error loading products</div>');
            }
        });
    }

    // Trigger on input/select change
    $('#searchInput').on('keyup', _.debounce(fetchProducts, 400)); // live search delay
    $('#categorySelect, #sortSelect').on('change', fetchProducts);
});
</script>

@endpush