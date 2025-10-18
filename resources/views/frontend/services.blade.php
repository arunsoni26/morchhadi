@extends('frontend.layouts.app')

@section('title', 'Morchadi — Services')

@section('content')
<main class="container my-5">
    <h2 class="mb-4">Services</h2>
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card p-3 h-100">
                <h5>Gift Packs</h5>
                <p>Create curated gift boxes for special occasions.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3 h-100">
                <h5>Subscriptions</h5>
                <p>Monthly deliveries of seasonal teas.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3 h-100">
                <h5>Corporate Orders</h5>
                <p>Bulk packaging and branding for corporate gifting.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3 h-100">
                <h5>Tasting Events</h5>
                <p>Host a guided tasting session for groups.</p>
            </div>
        </div>
    </div>
</main>
@endsection
