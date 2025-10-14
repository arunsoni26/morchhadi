@extends('layouts.admin-app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Products</h4>
    <button class="btn btn-primary" id="addProductBtn">
        <i class="bi bi-plus-circle me-1"></i> Add Product
    </button>
</div>

<div class="row mb-3">
    <div class="col-md-3">
        <select class="form-select filter" id="categoryFilter">
            <option value="">All Categories</option>
            @foreach($categories as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <select class="form-select filter" id="brandFilter">
            <option value="">All Brands</option>
            @foreach($brands as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </select>
    </div>
</div>

<table id="productsTable" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Category</th>
            <th>Brand</th>
            <th>Price</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
</table>

{{-- Reusable modal containers --}}
<div id="modalContainer"></div>
@endsection


@push('scripts')
<script>
$(function() {
    const table = $('#productsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('admin.products.list') }}",
            data: function(d) {
                d.category_id = $('#categoryFilter').val();
                d.brand_id = $('#brandFilter').val();
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'name', name: 'name' },
            { data: 'category', name: 'category' },
            { data: 'brand', name: 'brand' },
            { data: 'price', name: 'price' },
            { data: 'status', orderable: false, searchable: false },
            { data: 'actions', orderable: false, searchable: false },
        ]
    });

    $('.filter').change(() => table.ajax.reload());

    // 🟢 Add Product
    $('#addProductBtn').click(function() {
        $.get("{{ route('admin.products.form') }}", function(res) {
            $('#addEditContent').html(res);
            $('#editModal').modal('show');
        });
    });

    // 🟡 Edit Product
    $(document).on('click', '.editBtn', function() {
        const id = $(this).data('id');
        $.get("{{ route('admin.products.form') }}", { id }, function(res) {
            $('#addEditContent').html(res);
            $('#editModal').modal('show');
        });
    });

    // 💾 Save Product (Create/Update)
    $(document).on('submit', '#productForm', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        $.ajax({
            url: "{{ route('admin.products.save') }}",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(res) {
                if (res.success) {
                    $('#editModal').modal('hide');
                    table.ajax.reload();
                    toastr.success(res.message);
                }
            },
            error: function(err) {
                let msg = 'Something went wrong';
                if (err.responseJSON?.errors) {
                    msg = Object.values(err.responseJSON.errors).join('<br>');
                }
                toastr.error(msg);
            }
        });
    });

    // 👁️ View Product
    $(document).on('click', '.viewBtn', function() {
        const id = $(this).data('id');
        $.get(`/admin/products/view/${id}`, function(res) {
            $('#modalContainer').html(res);
            $('#viewModal').modal('show');
        });
    });

    // ❌ Delete Product
    $(document).on('click', '.deleteBtn', function() {
        const id = $(this).data('id');
        if (confirm('Are you sure you want to delete this product?')) {
            $.ajax({
                url: `/admin/products/delete/${id}`,
                method: 'DELETE',
                data: { _token: '{{ csrf_token() }}' },
                success: function(res) {
                    if (res.success) {
                        table.ajax.reload();
                        toastr.success('Product deleted successfully!');
                    }
                }
            });
        }
    });

    // 🔁 Toggle Status
    $(document).on('change', '.toggle-status', function() {
        const id = $(this).data('id');
        $.post(`/admin/products/toggle-status/${id}`, { _token: '{{ csrf_token() }}' });
    });
});
</script>
@endpush
