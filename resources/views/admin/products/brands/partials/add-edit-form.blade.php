
<div class="modal-header">
    <h5 class="modal-title" id="editModalLabel">
        {{ isset($productBrand) ? 'Edit Brand' : 'Add Brand' }}
    </h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<form id="brandForm" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $productBrand->id ?? '' }}">

    <div class="modal-body">
        <div class="row g-3">

        {{-- Name --}}
        <div class="col-md-6">
            <label class="form-label">Brand Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" value="{{ $productBrand->name ?? '' }}" required>
        </div>

        {{-- Description --}}
        <div class="col-md-6">
            <label class="form-label">Brand Description <span class="text-danger">*</span></label>
            <textarea type="text" name="description" class="form-control" required>{{ $productBrand->description ?? '' }}</textarea>
        </div>

        {{-- Status --}}
        <div class="col-md-6">
            <label class="form-label">Status</label>
            <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="status" value="1" {{ isset($productBrand) && $productBrand->status ? 'checked' : '' }}>
            </div>
        </div>

        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">{{ isset($productBrand) ? 'Update' : 'Save' }}</button>
    </div>
</form>

<script>
(function () {
    const brandForm = document.getElementById('brandForm');

    if (brandForm) {
        const submitButton = brandForm.querySelector('button[type="submit"]');

        brandForm.addEventListener('submit', function (event) {
            if (!event.target.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                scrollToFirstInvalidField();
                return;
            }

            event.preventDefault();
            event.stopPropagation();

            submitButton.disabled = true;
            submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...';

            const formData = new FormData(brandForm);
            const categoryId = formData.get('id');
            const url = categoryId
                ? "{{ url('admin/products/brands') }}/" + categoryId
                : "{{ route('admin.products.brands.store') }}";
            const method = categoryId ? 'POST' : 'POST'; // Laravel expects POST even for PUT when using FormData
            if (categoryId) {
                formData.append('_method', 'PUT');
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: method,
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.success) {
                        toastr.success('Brand saved successfully');
                        setTimeout(() => {
                            window.location.reload();
                        }, 800);
                    } else {
                        toastr.error(data.msg || "Something went wrong");
                        resetButton();
                    }
                },
                error: function (err) {
                    if (err.status === 422) {
                        const errors = err.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            toastr.error(value[0]);
                        });
                        const firstField = $('[name="' + Object.keys(errors)[0] + '"]');
                        if (firstField.length) {
                            firstField.focus();
                        }
                    } else {
                        toastr.error("Something went wrong");
                    }
                    resetButton();
                }
            });

            function resetButton() {
                submitButton.disabled = false;
                submitButton.innerHTML = '{{ isset($productBrand) ? "Update" : "Save" }}';
            }

            event.target.classList.add('was-validated');
        }, false);
    }

    function scrollToFirstInvalidField() {
        const firstInvalidField = $('form .form-control:invalid')[0];
        if (firstInvalidField) {
            firstInvalidField.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
            setTimeout(() => firstInvalidField.focus(), 600);
        }
    }
})();
</script>
