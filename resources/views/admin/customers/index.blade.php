@extends('layouts.admin-app')

@section('content')
<ul class="nav nav-tabs" id="customerTabs">
    <li class="nav-item">
        <a class="nav-link active" data-bs-toggle="tab" href="#customersTab">Customers</a>
    </li>
    <!-- <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#groupsTab">Groups</a>
    </li> -->
</ul>

<div class="tab-content mt-3">
    <div class="tab-pane fade show active" id="customersTab">
        <div class="container-fluid py-4">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header text-white d-flex justify-content-between align-items-center rounded-top-4 p-3">
                    <h4 class="mb-0 fw-bold">
                        <i class="bi bi-people-fill me-2"></i> Customers
                    </h4>
                    <div class="btn-group">
                        @if(canDo('customers','can_view') && canDo('customer_docs','can_view'))
                            <a href="{{ route('admin.customers.download-customers') }}" class="btn btn-success">
                                <i class="fas fa-download"></i>
                            </a>
                        @endif
                        @if(canDo('customers','can_view'))
                            <button id="addCustomerBtn" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Add Customer
                            </button>
                        @endif
                    </div>
                </div>

                <div class="card-body">
                    <!-- Filters Row -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <select id="filterStatus" class="form-select form-select-sm shadow-sm">
                                <option value="">All Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="text" id="filterName" placeholder="Search Name..." class="form-control shadow-sm" />
                        </div>
                        <div class="col-md-4">
                            <input type="text" id="filterEmail" placeholder="Search Email..." class="form-control shadow-sm" />
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table id="customersTable" class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <!-- <th>Father's Name</th>
                                    <th>Client Type</th> -->
                                    <th>Whatsapp Number</th>
                                    <th>Status</th>
                                    <!-- <th>Dashboard</th> -->
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="groupsTab">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h5>Groups List</h5>
            <button class="btn btn-success btn-sm" onclick="openGroupForm()">Add Group</button>
        </div>
        <table class="table table-bordered table-striped" id="groupsTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


<script>
    $(document).ready(function() {
        // Initialize Select2
        $('#filterGroup, #filterStatus').select2({ theme: 'bootstrap-5', width: '100%' });
        
        let retryCount = 1;
        let table;

        function initCustomersTable(retries = retryCount) {
            if ($.fn.DataTable.isDataTable('#customersTable')) {
                $('#customersTable').DataTable().destroy();
            }

            table = $('#customersTable').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: "{{ route('admin.customers.list') }}",
                    data: function(d) {
                        d.group_id = $('#filterGroup').val();
                        d.status = $('#filterStatus').val();
                        d.name = $('#filterName').val();
                        d.email = $('#filterEmail').val();
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
                            console.warn(`Retrying customer table load... (${retryCount - retries + 1})`);
                            setTimeout(() => {
                                initCustomersTable(retries - 1);
                            }, 1000);
                        } else {
                            console.warn("Failed to load customer data. Please reload the page.");
                        }
                    }
                },
                columns: [
                    { data: 'name' },
                    { data: 'email' },
                    { data: 'mobile' },
                    { data: 'whatsapp_number' },
                    // { data: 'client_type_status' },
                    // { data: 'group' },
                    { data: 'status_toggle', orderable: false, searchable: false },
                    // { data: 'dashboard_toggle', orderable: false, searchable: false },
                    { data: 'actions', orderable: false, searchable: false, className: 'text-center' }
                ],
                createdRow: function (row, data, dataIndex) {
                    // $(row).addClass('zoom-item');
                }
            });
        }

        // Initialize customers table on load
        initCustomersTable();

        // Reload on filters
        $('#filterGroup, #filterStatus, #filterName, #filterEmail').on('change keyup', function() {
            if (table) {
                table.ajax.reload();
            }
        });

    });

    // Add Customer button
    $('#addCustomerBtn').on('click', function(){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "{{route('admin.customers.form')}}",
            success: function (data) {
                $('#addEditContent').html(data);
                $('#editModal').modal('show');
            }
        });
    });

    // Edit Customer button (delegated)
    $(document).on('click', '.editCustomerBtn', function(){
        let id = $(this).data('id');
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "{{route('admin.customers.form')}}",
            data: {
                customerId: id
            },
            success: function (data) {
                $('#addEditContent').html(data);
                $('#editModal').modal('show');
            }
        });
    });
    

    $(document).on('change', '.toggle-status', function(){
        $.post("{{ url('admin/customers/toggle-status') }}/" + $(this).data('id'), {_token: "{{ csrf_token() }}"});
    });

    $(document).on('change', '.toggle-dashboard', function(){
        $.post("{{ url('admin/customers/toggle-dashboard') }}/" + $(this).data('id'), {_token: "{{ csrf_token() }}"});
    });

   

    $(document).on('click', '.viewCustomer', function () {
        let id = $(this).data('id');
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "{{route('admin.customers.view')}}",
            data: {
                custId: id
            },
            success: function (data) {
                $('#addEditContent').html(data);
                $('#editModal').modal('show');
            }
        });
    });
</script>

<style>
    .bg-gradient-primary {
        background: linear-gradient(45deg, #007bff, #0056b3);
    }
    .select2-container .select2-selection--single {
        height: calc(2.25rem + 2px);
        padding: 4px 8px;
    }
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }
</style>
@endpush
