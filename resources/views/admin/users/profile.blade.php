@extends('layouts.admin-app')

<style>
    .description-text {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Settings</h1>

    <div class="row">
        <div class="col-md-3 col-xl-2">

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Profile Settings</h5>
                </div>

                <div class="list-group list-group-flush" role="tablist">
                    <a class="list-group-item list-group-item-action {{ (session('active_tab', old('active_tab', 'account')) === 'account') ? 'active' : '' }}"
                        data-bs-toggle="list" href="#account" role="tab"> Basic Details
                    </a>
                    <!-- <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#password" role="tab">
                        Password
                    </a> -->
                    <a class="list-group-item list-group-item-action {{ session('active_tab') === 'password' ? 'active' : '' }}"
                        data-bs-toggle="list" href="#password" role="tab">Password
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-9 col-xl-10">
            <div class="tab-content">
                <!-- Basic info tab -->
                <div class="tab-pane fade {{ session('active_tab', 'account') === 'account' ? 'show active' : '' }}" id="account" role="tabpanel">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">User info</h5>
                        </div>

                        <div class="card-body">
                            @if(session('success'))
                            <div class="alert alert-success" style="padding: 1rem;">
                                {{ session('success') }}
                                <button type="button" class="btn-close ms-3" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            @if($errors->any())
                            <div class="alert alert-danger" style="padding: 1rem;">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close ms-3" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">Name</label>
                                            <input type="text" name="name" value="{{ $userInfo->name ?? '' }}" class="form-control" id="inputUsername" placeholder="Username">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUseremail">Email</label>
                                            <input type="text" name="email" value="{{ $userInfo->email ?? '' }}" class="form-control" id="inputUseremail" placeholder="Email" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-center">
                                            @php
                                                $profilePic = url('/img/avatars/dummyavatar.png');
                                                if (!empty($userInfo->image)) {
                                                    //$profilePic = Storage::disk('s3')->url($userInfo->image);
                                                    $profilePic = Storage::disk('s3')->temporaryUrl($userInfo->image, now()->addMinutes(120));
                                                }
                                            @endphp
                                            <img id="profilePreview" src="{{ $profilePic }}" alt="Profile Image" class="rounded-circle img-responsive mt-2"
                                                width="128" height="128">
                                            <!-- <img id="profilePreview" src="{{ asset($userInfo->image) }}" alt="Profile Picture" class="rounded-circle img-responsive mt-2" -->
                                            <div class="mt-2">
                                                <label class="btn btn-primary">
                                                    <i class="fas fa-upload"></i> Upload
                                                    <input type="file" name="image" accept="image/*" hidden onchange="previewImage(event)">
                                                </label>
                                            </div>
                                            <small>For best results, use an image at least 128px by 128px in .jpg format</small>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Password tab -->
                <div class="tab-pane fade {{ session('active_tab') === 'password' ? 'show active' : '' }}" id="password" role="tabpanel">
                    <div class="card">
                        <div class="card-body" style="padding: 1rem;">
                            @if(session('success') && session('active_tab') === 'password')
                            <div class="alert alert-success" style="padding: 1rem;">
                                {{ session('success') }}
                                <button type="button" class="btn-close ms-3" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                            @if($errors->any() && session('active_tab') === 'password')
                            <div class="alert alert-danger" style="padding: 1rem;">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close ms-3" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            <h5 class="card-title">Password</h5>

                            <form action="{{ route('admin.settings.password') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="inputPasswordCurrent">Current password</label>
                                    <input required type="password" name="current_password" class="form-control" id="inputPasswordCurrent">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="inputPasswordNew">New password</label>
                                    <input required type="password" name="new_password" class="form-control" id="inputPasswordNew">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="inputPasswordNew2">Verify password</label>
                                    <input required type="password" name="new_password_confirmation" class="form-control" id="inputPasswordNew2">
                                </div>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </form>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const colorInput = document.getElementById('inputColor');
        const colorName = document.getElementById('colorName');

        colorInput.addEventListener('input', function() {
            colorName.textContent = colorInput.value;
        });
    });
</script>
<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('profilePreview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endpush