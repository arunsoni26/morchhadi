@extends('layouts.admin-app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3><i class="bi bi-shop"></i> Branches</h3>
    <button id="addBranchBtn" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add Branch
    </button>
</div>

<div class="card">
    <div class="card-body">
        <!-- Filters -->
        <div class="row g-2 mb-3">
            <div class="col-md-3">
                <select id="filterType" class="form-select form-select-sm">
                    <option value="">All Branch Types</option>
                    @foreach($branchTypes as $type)
                    <option value="{{ $type }}">{{ $type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select id="filterStatus" class="form-select form-select-sm">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="text" id="filterName" class="form-control form-control-sm" placeholder="Branch Name">
            </div>
            <div class="col-md-3">
                <input type="text" id="filterShop" class="form-control form-control-sm" placeholder="Shop Name">
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table id="branchesTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Owner Name</th>
                        <th>Shop Name</th>
                        <th>Type</th>
                        <th>City</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <!-- <th>Total Sales</th> -->
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div id="addEditContent"></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        let table = $('#branchesTable').DataTable({
            ajax: {
                url: "{{ route('admin.branches.list') }}",
                dataSrc: '', 
                data: function(d) {
                    d.branch_type = $('#filterType').val();
                    d.status = $('#filterStatus').val();
                    d.owner_name = $('#filterName').val();
                    d.shop_name = $('#filterShop').val();
                }
            },
            columns: [{
                    data: 'owner_name'
                },
                {
                    data: 'shop_name'
                },
                {
                    data: 'branch_type'
                },
                {
                    data: 'city'
                },
                {
                    data: 'phone_number'
                },
                {
                    data: 'status',
                    render: d => d === 'active' ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-secondary">Inactive</span>'
                },
                {
                    data: null,
                    className: 'text-center',
                    render: function(data) {
                        return `
                <button class="btn btn-sm btn-primary editBranchBtn" data-id="${data.id}">
                    <i class="fa fa-pencil"></i>
                </button>
                <button class="btn btn-sm btn-danger deleteBranchBtn" data-id="${data.id}">
                    <i class="fa fa-trash"></i>
                </button>
            `;
                    }
                }
            ]
        });


        // Filters
        $('#filterType, #filterStatus, #filterName, #filterShop').on('change keyup', function() {
            table.ajax.reload();
        });

        // Add
        $('#addBranchBtn').click(function() {
            $.post("{{ route('admin.branches.form') }}", {
                _token: '{{ csrf_token() }}'
            }, function(html) {
                $('#addEditContent').html(html);
                $('#editModal').modal('show');
            });
        });

        // Edit
        $(document).on('click', '.editBranchBtn', function() {
            let id = $(this).data('id');
            $.post("{{ route('admin.branches.form') }}", {
                branchId: id,
                _token: '{{ csrf_token() }}'
            }, function(html) {
                $('#addEditContent').html(html);
                $('#editModal').modal('show');
            });
        });

        // Delete
        $(document).on('click', '.deleteBranchBtn', function() {
            let id = $(this).data('id');
            if (confirm('Are you sure you want to delete this branch?')) {
                $.ajax({
                    url: "{{ url('admin/branches') }}/" + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        if (res.success) {
                            table.ajax.reload();
                            toastr.success(res.message);
                        }
                    }
                });
            }
        });
    });
</script>
@endpush