
<div class="modal-header">
    <h5 class="modal-title" id="editModalLabel">
        {{ isset($product) ? 'Edit Product' : 'Add Product' }}
    </h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<form id="productForm" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $product->id ?? '' }}">

    <div class="modal-body">
        <div class="row g-3">

        {{-- Name --}}
        <div class="col-md-6">
            <label class="form-label">Product Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" value="{{ $product->name ?? '' }}" required>
        </div>

        {{-- SKU --}}
        <div class="col-md-6">
            <label class="form-label">SKU</label>
            <input type="text" name="sku" class="form-control" value="{{ $product->sku ?? '' }}">
        </div>

        {{-- Category --}}
        <div class="col-md-6">
            <label class="form-label">Category <span class="text-danger">*</span></label>
            <select name="category_id" id="categorySelection" class="form-select" required>
                <option value="">Select Category</option>
                @foreach($categories as $id => $name)
                    <option value="{{ $id }}" {{ (isset($product) && $product->category_id == $id) ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Brand --}}
        <div class="col-md-6">
            <label class="form-label">Brand</label>
            <select name="brand_id"  id="brandSelection"class="form-select">
                <option value="">Select Brand</option>
                @foreach($brands as $id => $name)
                    <option value="{{ $id }}" {{ (isset($product) && $product->brand_id == $id) ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Price --}}
        <div class="col-md-6">
            <label class="form-label">Price <span class="text-danger">*</span></label>
            <input type="number" step="0.01" name="price" class="form-control" value="{{ $product->price ?? '' }}" required>
        </div>

        {{-- Discount Price --}}
        <div class="col-md-6">
            <label class="form-label">Discount Price</label>
            <input type="number" step="0.01" name="discount_price" class="form-control" value="{{ $product->discount_price ?? '' }}">
        </div>

        {{-- Stock Quantity --}}
        <div class="col-md-6">
            <label class="form-label">Stock Quantity</label>
            <input type="number" name="stock_quantity" class="form-control" value="{{ $product->stock_quantity ?? 0 }}">
        </div>

        {{-- Weight --}}
        <div class="col-md-6">
            <label class="form-label">Weight</label>
            <input type="text" name="weight" class="form-control" value="{{ $product->weight ?? '' }}">
        </div>

        {{-- Flavor Notes --}}
        <div class="col-md-6">
            <label class="form-label">Flavor Notes</label>
            <input type="text" name="flavor_notes" class="form-control" value="{{ $product->flavor_notes ?? '' }}">
        </div>

        {{-- Origin --}}
        <div class="col-md-6">
            <label class="form-label">Origin</label>
            <input type="text" name="origin" class="form-control" value="{{ $product->origin ?? '' }}">
        </div>

        {{-- Short Description --}}
        <div class="col-12">
            <label class="form-label">Short Description</label>
            <textarea name="short_description" class="form-control" rows="2">{{ $product->short_description ?? '' }}</textarea>
        </div>

        {{-- Long Description --}}
        <div class="col-12">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4">{{ $product->description ?? '' }}</textarea>
        </div>

        {{-- Main Image --}}
        <div class="col-md-6">
            <label class="form-label">Main Image</label>
            <input type="file" name="image" class="form-control">
            @if(!empty($product->image))
            <div class="mt-2">
                <img src="{{ asset('storage/'.$product->image) }}" alt="Product" width="80" class="rounded border">
            </div>
            @endif
        </div>

        {{-- Gallery Images --}}
        <div class="col-md-6">
            <label class="form-label">Gallery Images</label>
            <input type="file" name="gallery_images[]" class="form-control" multiple>
            @if(!empty($product->gallery_images))
            <div class="mt-2 d-flex flex-wrap gap-2">
                @foreach(json_decode($product->gallery_images, true) ?? [] as $img)
                <img src="{{ asset('storage/'.$img) }}" alt="Gallery" width="60" class="rounded border">
                @endforeach
            </div>
            @endif
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Available in Branches</label>
            <select name="branch_ids[]" id="branchSelection" class="form-select" multiple>
                @foreach($branches as $id => $name)
                    <option value="{{ $id }}" 
                        @if(isset($product) && $product->branches->pluck('id')->contains($id)) selected @endif>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Featured --}}
        <div class="col-md-6">
            <label class="form-label">Featured Product</label>
            <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="is_featured" value="1" {{ isset($product) && $product->is_featured ? 'checked' : '' }}>
            </div>
        </div>

        {{-- Status --}}
        <div class="col-md-6">
            <label class="form-label">Status</label>
            <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="status" value="1" {{ isset($product) && $product->status ? 'checked' : '' }}>
            </div>
        </div>

        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">{{ isset($product) ? 'Update' : 'Save' }}</button>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('#branchSelection, #categorySelection, #brandSelection').select2({ theme: 'bootstrap-5', width: '100%' });
    })
</script>