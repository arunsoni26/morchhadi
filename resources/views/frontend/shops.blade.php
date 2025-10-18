@extends('frontend.layouts.app')

@section('title', 'Morchadi — Shops')

@section('content')
<main class="container my-5">
    <h2 class="mb-3">Our Shops</h2>
    <p>Find our retail partners and pop-up stores. Visit to taste before you buy.</p>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card p-3 h-100">
                <h5>TeaHouse — Brigade Road</h5>
                <p class="small text-muted">Open: 9am–9pm</p>
                <p>Address: 123 Tea Street, Bangalore</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3 h-100">
                <h5>TeaHouse — MG Road</h5>
                <p class="small text-muted">Open: 10am–8pm</p>
                <p>Address: 45 Leaf Lane, Mumbai</p>
            </div>
        </div>
    </div>
</main>
@endsection
