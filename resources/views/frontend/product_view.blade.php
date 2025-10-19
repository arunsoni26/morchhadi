@extends('frontend.layouts.app')

@section('title', $product->name . ' — Morchadi')

@section('content')
<main class="container my-5">
    <div class="row">
        <div class="col-md-6">
            @php
                // Decode the gallery_images column (JSON string) to an array
                $gallery = $product->gallery_images ? json_decode($product->gallery_images, true) : [];
            @endphp

            @if(!empty($gallery) && is_array($gallery))
                <div id="productGallery" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($gallery as $key => $img)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ asset($img) }}" class="d-block w-100" alt="{{ $product->name }}">
                            </div>
                        @endforeach
                    </div>

                    @if(count($gallery) > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#productGallery" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productGallery" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    @endif
                </div>
            @else
                <img src="{{ asset($product->images ?? 'images/no-image.jpg') }}" class="img-fluid" alt="{{ $product->name }}">
            @endif
        </div>

        <div class="col-md-6">
            <h2>{{ $product->name }}</h2>
            <p class="text-muted">{{ $product->category->name ?? 'Uncategorized' }}</p>
            <h4 class="fw-semibold">₹{{ number_format($product->price, 2) }}</h4>
            <p>{{ $product->short_description }}</p>

            <div class="d-flex gap-2">
                <button class="btn btn-primary add-to-cart" data-id="{{ $product->id }}">Add to Cart</button>

                @if($product->whatsapp_number)
                   <a href="https://wa.me/{{ $product->whatsapp_number }}?text=Hello%20I%20want%20to%20inquire%20about%20Morchadi%20Product%20{{ urlencode($product->name) }}"
                    class="btn btn-success" target="_blank">
                        <i class="bi bi-whatsapp"></i> WhatsApp
                    </a>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection
