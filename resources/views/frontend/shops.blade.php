@extends('frontend.layouts.app')

@section('title', 'Morchadi — Shops')

@section('content')
<main class="container my-5">
    <h2 class="mb-3">Our Shops</h2>
    <p>Find our retail partners and pop-up stores. Visit to taste before you buy.</p>

    <div class="row g-4">
        @forelse($branches as $branch)
            <div class="col-md-6">
                <div class="card p-3 h-100">
                    <h5>{{ $branch->shop_name }}</h5>
                    <p class="small text-muted">
                        Open: 
                        {{ \Carbon\Carbon::parse($branch->opening_time)->format('h:i A') ?? 'N/A' }} – 
                        {{ \Carbon\Carbon::parse($branch->closing_time)->format('h:i A') ?? 'N/A' }}
                    </p>
                    <p>
                        Address: {{ $branch->address }}, {{ $branch->city }}, {{ $branch->state }} {{ $branch->pincode ?? '' }}
                    </p>
                    @if($branch->phone_number)
                        <p>Phone: {{ $branch->phone_number }}</p>
                    @endif
                    @if($branch->whatsapp_number)
                        <p>
                            WhatsApp: 
                            <a href="https://wa.me/{{ preg_replace('/\D/', '', $branch->whatsapp_number) }}" target="_blank" class="text-success">
                                <i class="bi bi-whatsapp me-1"></i> {{ $branch->whatsapp_number }}
                            </a>
                        </p>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted mb-0">No shops found.</p>
            </div>
        @endforelse
    </div>
</main>
@endsection
