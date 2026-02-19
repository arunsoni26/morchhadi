@forelse($products as $product)
<div class="col-md-3 col-sm-6">
    <div class="card h-100 shadow-sm">
        <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}">

        <div class="card-body text-center">
            <h6 class="fw-bold">{{ $product->name }}</h6>
            <p class="text-muted small mb-1">{{ $product->category->name ?? 'Uncategorized' }}</p>
            <p class="fw-semibold text-dark mb-2">₹{{ number_format($product->price, 2) }}</p>

            <div class="d-flex justify-content-center gap-2">
                @if($product->whatsapp_number)
                <a href="https://wa.me/{{ $product->whatsapp_number }}?text=Hello%20I%20want%20to%20inquire%20about%20{{ urlencode($product->name) }}"
                    class="btn btn-outline-success btn-sm" target="_blank">
                    <i class="bi bi-whatsapp"></i>
                </a>
                @endif

                <a href="{{ route('product.view', $product->id) }}" class="btn btn-outline-secondary btn-sm">
                    View
                </a>
            </div>
        </div>
    </div>
</div>
@empty
<div class="col-12 text-center py-5">
    <p class="text-muted">No products found.</p>
</div>
@endforelse
