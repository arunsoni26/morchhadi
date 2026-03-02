@extends('frontend.layouts.app')

@section('title', $product->name . ' — Morchhadi')

@section('content')

<style>
    /* SAME THEME AS PRODUCTS PAGE */
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(120deg, #fffdf8, #fef6e6);
        color: #3a2e2a;
    }


    /* HERO */
    .product-hero {
        min-height: 50vh;
        display: flex;
        align-items: center;
        position: relative;
        padding: 80px 0;
        overflow: hidden;
    }

    .product-hero::before {
        content: "";
        position: absolute;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, #ffb34730, #ff7a0020);
        border-radius: 50%;
        top: -200px;
        right: -150px;
    }

    .product-hero::after {
        content: "";
        position: absolute;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, #ff7a0025, #ffb34720);
        border-radius: 50%;
        bottom: -200px;
        left: -150px;
    }


    /* PREMIUM BOX */
    .premium-box {
        background: #fff;
        padding: 50px;
        border-radius: 30px;
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.08);
    }


    /* IMAGE */
    .carousel-inner img,
    .product-main-image {
        border-radius: 20px;
        height: 420px;
        object-fit: cover;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }


    /* TITLE */
    .product-title {
        font-weight: 700;
    }


    /* CATEGORY */
    .product-category {
        color: #8b5e3c;
    }


    /* PRICE */
    .old-price {
        text-decoration: line-through;
        color: #999;
    }

    .new-price {
        font-size: 26px;
        font-weight: 700;
        color: #c56a00;
    }


    /* BUTTON */
    .btn-premium {
        background: linear-gradient(45deg, #c56a00, #ff8c00);
        border: none;
        color: #fff;
        border-radius: 50px;
        padding: 10px 25px;
        transition: 0.3s;
    }

    .btn-premium:hover {
        transform: translateY(-3px);
    }

    .btn-premium::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 50%;
        height: 100%;
        background: rgba(255, 255, 255, 0.4);
        transform: skewX(-25deg);
        transition: 0.6s;
    }

    .btn-premium:hover::before {
        left: 120%;
    }

    /* WHATSAPP BUTTON */
    .btn-whatsapp {
        background: #25D366;
        color: #fff;
        border-radius: 50px;
        padding: 10px 25px;
        border: none;
    }

    .btn-whatsapp:hover {
        background: #1ebe5d;
    }


    /* DESCRIPTION */
    .product-description {
        line-height: 1.8;
        color: #555;
    }
</style>



<!-- HERO -->
<section class="product-hero">

    <div class="container">

        <div class="premium-box text-center">

            <h1 class="display-5 fw-bold">
                {{ $product->name }}
            </h1>

        </div>

    </div>

</section>



<!-- PRODUCT DETAIL -->
<section class="container py-5">

    <div class="premium-box">

        <div class="row align-items-center">


            <!-- IMAGE -->
            <div class="col-md-6 mb-4 mb-md-0">

                @php
                $gallery = $product->gallery_images ? json_decode($product->gallery_images, true) : [];
                @endphp


                @if(!empty($gallery) && is_array($gallery))

                <div id="productGallery" class="carousel slide">

                    <div class="carousel-inner">

                        @foreach($gallery as $key => $img)

                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">

                            <img src="{{ asset($img) }}" class="d-block w-100">

                        </div>

                        @endforeach

                    </div>


                    @if(count($gallery) > 1)

                    <button class="carousel-control-prev"
                        type="button"
                        data-bs-target="#productGallery"
                        data-bs-slide="prev">

                        <span class="carousel-control-prev-icon"></span>

                    </button>


                    <button class="carousel-control-next"
                        type="button"
                        data-bs-target="#productGallery"
                        data-bs-slide="next">

                        <span class="carousel-control-next-icon"></span>

                    </button>

                    @endif

                </div>

                @else

                <img src="{{ asset($product->image ?? 'images/no-image.jpg') }}"
                    class="img-fluid product-main-image">

                @endif

            </div>



            <!-- CONTENT -->
            <div class="col-md-6">

                <h2 class="product-title mb-2">
                    {{ $product->name }}
                </h2>


                <p class="product-category mb-3">
                    {{ $product->category->name ?? 'Premium Tea Category' }}
                </p>


                <div class="mb-3">

                    <span class="old-price me-2">
                        ₹{{ $product->price }}
                    </span>

                    <span class="new-price">
                        ₹{{ $product->price - $product->discount_price }}
                    </span>

                </div>


                <div class="product-description mb-4">
                    {!! $product->description !!}
                </div>


                <div class="d-flex gap-3 flex-wrap">

                    @if($product->whatsapp_number)

                    <a href="https://wa.me/{{ $product->whatsapp_number }}?text=Hello%20I%20want%20to%20inquire%20about%20{{ urlencode($product->name) }}"
                        target="_blank"
                        class="btn btn-whatsapp">

                        <i class="bi bi-whatsapp"></i>
                        Wholesale Inquiry

                    </a>

                    @endif


                    <a href="{{ route('products') }}"
                        class="btn btn-premium">

                        Back to Products

                    </a>

                </div>


            </div>


        </div>

    </div>

</section>


@endsection