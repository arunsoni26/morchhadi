<div class="modal fade" id="viewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $product->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p><strong>Category:</strong> {{ $product->category?->name }}</p>
                <p><strong>Brand:</strong> {{ $product->brand?->name }}</p>
                <p><strong>Price:</strong> ₹{{ number_format($product->price, 2) }}</p>
                <p><strong>Description:</strong> {{ $product->description }}</p>
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" width="150">
                @endif
            </div>
        </div>
    </div>
</div>
