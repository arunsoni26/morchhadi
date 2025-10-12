<form id="branchForm">
    @csrf
    <input type="hidden" name="id" value="{{ $branch->id ?? '' }}">

    <div class="modal-header">
        <h5 class="modal-title">{{ isset($branch) ? 'Edit Branch' : 'Add Branch' }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>

    <div class="modal-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Owner Name *</label>
                <input type="text" name="owner_name" value="{{ $branch->owner_name ?? '' }}" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Shop Name *</label>
                <input type="text" name="shop_name" value="{{ $branch->shop_name ?? '' }}" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Branch Type</label>
                <input type="text" name="branch_type" value="{{ $branch->branch_type ?? '' }}" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">City</label>
                <input type="text" name="city" value="{{ $branch->city ?? '' }}" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Phone</label>
                <input type="text" name="phone_number" value="{{ $branch->phone_number ?? '' }}" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="active" {{ (isset($branch) && $branch->status=='active')?'selected':'' }}>Active</option>
                    <option value="inactive" {{ (isset($branch) && $branch->status=='inactive')?'selected':'' }}>Inactive</option>
                </select>
            </div>
            <div class="col-md-12">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control">{{ $branch->address ?? '' }}</textarea>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>

<script>
$('#branchForm').on('submit', function(e){
    e.preventDefault();
    $.post("{{ route('admin.branches.save') }}", $(this).serialize(), function(res){
        if(res.success){
            $('#editModal').modal('hide');
            $('#branchesTable').DataTable().ajax.reload();
            toastr.success(res.message);
        }else{
            toastr.error(res.message);
        }
    }).fail(function(xhr){
        toastr.error(xhr.responseJSON.message);
    });
});
</script>
