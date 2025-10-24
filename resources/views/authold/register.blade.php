@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                {{-- Full Name --}}
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input id="name" type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" required>
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                {{-- Mobile --}}
                                <div class="mb-3">
                                    <label for="mobile" class="form-label">Mobile</label>
                                    <input id="mobile" type="text" name="mobile"
                                        class="form-control @error('mobile') is-invalid @enderror"
                                        value="{{ old('mobile') }}" required>
                                    @error('mobile')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                {{-- Password --}}
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input id="password" type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror" required>
                                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                {{-- House No. --}}
                                <div class="mb-3">
                                    <label for="house_no" class="form-label">House No.</label>
                                    <input id="house_no" type="text" name="house_no"
                                        class="form-control @error('house_no') is-invalid @enderror"
                                        value="{{ old('house_no') }}">
                                    @error('house_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                {{-- Locality --}}
                                <div class="mb-3">
                                    <label for="locality" class="form-label">Locality</label>
                                    <input id="locality" type="text" name="locality"
                                        class="form-control @error('locality') is-invalid @enderror"
                                        value="{{ old('locality') }}">
                                    @error('locality')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                {{-- State --}}
                                <div class="mb-3">
                                    <label for="state" class="form-label">State</label>
                                    <input id="state" type="text" name="state"
                                        class="form-control @error('state') is-invalid @enderror"
                                        value="{{ old('state') }}" required>
                                    @error('state')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                {{-- Pincode --}}
                                <div class="mb-3">
                                    <label for="pincode" class="form-label">Pincode</label>
                                    <input id="pincode" type="text" name="pincode"
                                        class="form-control @error('pincode') is-invalid @enderror"
                                        value="{{ old('pincode') }}" required>
                                    @error('pincode')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                {{-- Email --}}
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input id="email" type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" required>
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                {{-- WhatsApp --}}
                                <div class="mb-3">
                                    <label for="whatsapp_number" class="form-label">WhatsApp Number</label>
                                    <input id="whatsapp_number" type="text" name="whatsapp_number"
                                        class="form-control @error('whatsapp_number') is-invalid @enderror"
                                        value="{{ old('whatsapp_number') }}">
                                    @error('whatsapp_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                {{-- Confirm Password --}}
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input id="password_confirmation" type="password" name="password_confirmation"
                                        class="form-control" required>
                                </div>



                                {{-- Landmark --}}
                                <div class="mb-3">
                                    <label for="landmark" class="form-label">Landmark</label>
                                    <input id="landmark" type="text" name="landmark"
                                        class="form-control @error('landmark') is-invalid @enderror"
                                        value="{{ old('landmark') }}">
                                    @error('landmark')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                {{-- City --}}
                                <div class="mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input id="city" type="text" name="city"
                                        class="form-control @error('city') is-invalid @enderror"
                                        value="{{ old('city') }}" required>
                                    @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                {{-- Country --}}
                                <div class="mb-3">
                                    <label for="country" class="form-label">Country</label>
                                    <input id="country" type="text" name="country"
                                        class="form-control @error('country') is-invalid @enderror"
                                        value="{{ old('country', 'India') }}" required>
                                    @error('country')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                {{-- Buttons --}}
                                <div class="mb-3" style="padding-top:30px;">
                                    <button type="submit" class="btn btn-primary px-4">Register</button>
                                    <a href="{{ route('login') }}" class="btn btn-link">Already have an account?</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection