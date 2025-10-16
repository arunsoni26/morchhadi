@extends('layouts.admin-app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Brands</h4>
    <button class="btn btn-primary" id="addBrandBtn">
        <i class="bi bi-plus-circle me-1"></i> Add Brand
    </button>
</div>

<div class="row mb-3">
</div>

<table id="brandsTable" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Slug</th>
            <th>Description</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
</table>
@endsection


@push('scripts')
<script>
$(function() {
    
    let retryCount = 1;
    let table;

    function initBrandsTable(retries = retryCount) {
        if ($.fn.DataTable.isDataTable('#brandsTable')) {
            $('#brandsTable').DataTable().destroy();
        }

        table = $('#brandsTable').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: "{{ route('admin.products.brands.list') }}",
                data: function(d) {
                },
                error: function (xhr, error, thrown) {
                    console.error("DataTables AJAX error:", xhr.responseText);
                    let isServerError = false;

                    try {
                        const json = JSON.parse(xhr.responseText);
                        if (json.message && json.message === "Server Error") {
                            isServerError = true;
                        }
                    } catch (e) {
                        isServerError = xhr.status === 500;
                    }

                    if (retries > 0 && isServerError) {
                        console.warn(`Retrying brands table load... (${retryCount - retries + 1})`);
                        setTimeout(() => {
                            initBrandsTable(retries - 1);
                        }, 1000);
                    } else {
                        console.warn("Failed to load brands data. Please reload the page.");
                    }
                }
            },
            columns: [
                { data: 'brandIndex', name: 'brandIndex' },
                { data: 'name' },
                { data: 'slug', name: 'slug' },
                { data: 'description', name: 'description' },
                { data: 'status_toggle', orderable: false, searchable: false },
                { data: 'actions', orderable: false, searchable: false, className: 'text-center' }
            ],
            createdRow: function (row, data, dataIndex) {
                // $(row).addClass('zoom-item');
            }
        });
    }

    // Initialize customers table on load
    initBrandsTable();


    $('.filter').change(() => table.ajax.reload());

    // 🟢 Add Brand
    $('#addBrandBtn').click(function() {
        $.get("{{ route('admin.products.brands.form') }}", function(res) {
            $('#addEditContent').html(res);
            $('#editModal').modal('show');
        });
    });

    // 🟡 Edit Brand
    $(document).on('click', '.editBtn', function() {
        const id = $(this).data('id');
        $.get("{{ route('admin.products.brands.form') }}", { id }, function(res) {
            $('#addEditContent').html(res);
            $('#editModal').modal('show');
        });
    });

    // 💾 Save Brand (Create/Update)
    $(document).on('submit', '#cateoryForm', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        $.ajax({
            url: "{{ route('admin.products.brands.store') }}",
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

    // View Brand
    $(document).on('click', '.viewBtn', function() {
        const id = $(this).data('id');
        $.get(`/admin/products/brands/view/${id}`, function(res) {
            $('#modalContainer').html(res);
            $('#viewModal').modal('show');
        });
    });

    // Delete Brand
    $(document).on('click', '.deleteBtn', function() {
        const id = $(this).data('id');
        if (confirm('Are you sure you want to delete this brand?')) {
            $.ajax({
                url: `/admin/products/brands/delete/${id}`,
                method: 'DELETE',
                data: { _token: '{{ csrf_token() }}' },
                success: function(res) {
                    if (res.success) {
                        table.ajax.reload();
                        toastr.success('Brand deleted successfully!');
                    }
                }
            });
        }
    });

    // 🔁 Toggle Status
    $(document).on('change', '.toggle-status', function() {
        const id = $(this).data('id');
        $.post("{{ url('admin/products/brands/toggle-status') }}/" + $(this).data('id'), {_token: "{{ csrf_token() }}"});
    });
});
</script>
@endpush
