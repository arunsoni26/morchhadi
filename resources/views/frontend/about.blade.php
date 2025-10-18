@extends('frontend.layouts.app')

@section('title', 'Morchadi — About Us')

@section('content')
<main class="container my-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">About TeaHouse</h2>
        <p class="text-muted mx-auto" style="max-width:600px;">
            TeaHouse is a small-batch tea curator — sourcing ethically and delivering freshness.
            Our mission is to reconnect people with thoughtful tea rituals.
        </p>
    </div>

    <h4 class="text-center mb-3">Our Team</h4>
    <div class="row g-4 justify-content-center">
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card p-3 text-center h-100">
                <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=400&q=60"
                     class="rounded-circle mb-2 mx-auto" width="80" alt="Priya Sharma">
                <h6 class="mb-0">Priya Sharma</h6>
                <small class="text-muted">Founder</small>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4">
            <div class="card p-3 text-center h-100">
                <img src="https://images.unsplash.com/photo-1545996124-6b8e6f4b3f7b?auto=format&fit=crop&w=400&q=60"
                     class="rounded-circle mb-2 mx-auto" width="80" alt="Rohit Patel">
                <h6 class="mb-0">Rohit Patel</h6>
                <small class="text-muted">Head of Sourcing</small>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4">
            <div class="card p-3 text-center h-100">
                <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=400&q=60"
                     class="rounded-circle mb-2 mx-auto" width="80" alt="Anita Desai">
                <h6 class="mb-0">Anita Desai</h6>
                <small class="text-muted">Head of Operations</small>
            </div>
        </div>
    </div>
</main>
@endsection
