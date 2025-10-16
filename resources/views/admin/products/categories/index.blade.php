@extends('layouts.admin-app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Categories</h4>
    <button class="btn btn-primary" id="addCategoryBtn">
        <i class="bi bi-plus-circle me-1"></i> Add Category
    </button>
</div>

<div class="row mb-3">
</div>

<table id="categoriesTable" class="table table-bordered table-striped">
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

    function initCategoriesTable(retries = retryCount) {
        if ($.fn.DataTable.isDataTable('#categoriesTable')) {
            $('#categoriesTable').DataTable().destroy();
        }

        table = $('#categoriesTable').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: "{{ route('admin.products.categories.list') }}",
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
                        console.warn(`Retrying categories table load... (${retryCount - retries + 1})`);
                        setTimeout(() => {
                            initCategoriesTable(retries - 1);
                        }, 1000);
                    } else {
                        console.warn("Failed to load categories data. Please reload the page.");
                    }
                }
            },
            columns: [
                { data: 'categoryIndex', name: 'categoryIndex' },
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
    initCategoriesTable();


    $('.filter').change(() => table.ajax.reload());

    // 🟢 Add Category
    $('#addCategoryBtn').click(function() {
        $.get("{{ route('admin.products.categories.form') }}", function(res) {
            $('#addEditContent').html(res);
            $('#editModal').modal('show');
        });
    });

    // 🟡 Edit Category
    $(document).on('click', '.editBtn', function() {
        const id = $(this).data('id');
        $.get("{{ route('admin.products.categories.form') }}", { id }, function(res) {
            $('#addEditContent').html(res);
            $('#editModal').modal('show');
        });
    });

    // 💾 Save Category (Create/Update)
    $(document).on('submit', '#cateoryForm', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        $.ajax({
            url: "{{ route('admin.products.categories.store') }}",
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

    // View Category
    $(document).on('click', '.viewBtn', function() {
        const id = $(this).data('id');
        $.get(`/admin/products/categories/view/${id}`, function(res) {
            $('#modalContainer').html(res);
            $('#viewModal').modal('show');
        });
    });

    // Delete Category
    $(document).on('click', '.deleteBtn', function() {
        const id = $(this).data('id');
        if (confirm('Are you sure you want to delete this category?')) {
            $.ajax({
                url: `/admin/products/categories/delete/${id}`,
                method: 'DELETE',
                data: { _token: '{{ csrf_token() }}' },
                success: function(res) {
                    if (res.success) {
                        table.ajax.reload();
                        toastr.success('Category deleted successfully!');
                    }
                }
            });
        }
    });

    // 🔁 Toggle Status
    $(document).on('change', '.toggle-status', function() {
        const id = $(this).data('id');
        $.post("{{ url('admin/products/categories/toggle-status') }}/" + $(this).data('id'), {_token: "{{ csrf_token() }}"});
    });
});
</script>
@endpush
