@extends('frontend.layouts.app')

@section('title', 'Morchhadi — Products')

@section('content')

<style>

/* SAME THEME AS HOME */
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(120deg, #fffdf8, #fef6e6);
    color: #3a2e2a;
}

/* HERO SECTION */
.product-hero {
    min-height: 60vh;
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;
    padding: 80px 0;
}

.product-hero::before {
    content: "";
    position: absolute;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, #ffb34730, #ff7a0020);
    border-radius: 50%;
    top: -200px;
    right: -150px;
    z-index: 0;
    animation: floatBg 8s ease-in-out infinite alternate;
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
    z-index: 0;
    animation: floatBg2 10s ease-in-out infinite alternate;
}

@keyframes floatBg {
    0% { transform: translateY(0px); }
    100% { transform: translateY(40px); }
}

@keyframes floatBg2 {
    0% { transform: translateX(0px); }
    100% { transform: translateX(40px); }
}

/* GLASS BOX */
.glass-box {
    background: #ffffff;
    padding: 50px;
    border-radius: 30px;
    box-shadow: 0 30px 80px rgba(0,0,0,0.08);
    position: relative;
    z-index: 2;
    animation: fadeUp 1s ease;
}

@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* SECTION TITLE */
.section-title {
    font-weight: 700;
    text-align: center;
}

.section-title::after {
    content: "";
    width: 80px;
    height: 4px;
    background: linear-gradient(45deg, #c56a00, #ff8c00);
    display: block;
    margin: 10px auto;
    border-radius: 10px;
}

/* PRODUCT CARD */
.product-card {
    background: #fff;
    border-radius: 30px;
    overflow: hidden;
    transition: 0.4s ease;
    box-shadow: 0 25px 70px rgba(0,0,0,0.08);
}

.product-card:hover {
    transform: translateY(-15px);
    box-shadow: 0 35px 90px rgba(255,140,0,0.2);
}

.product-card img {
    height: 240px;
    object-fit: cover;
    transition: 0.4s;
}

.product-card:hover img {
    transform: scale(1.08);
}

/* PRICE */
.price {
    color: #c56a00;
    font-weight: 700;
}

/* BUTTON */
.btn-premium {
    background: linear-gradient(45deg, #c56a00, #ff8c00);
    border: none;
    color: #fff;
    border-radius: 50px;
    padding: 8px 20px;
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


/* FILTER */
.filter-box {
    background: #fff;
    padding: 20px;
    border-radius: 20px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.05);
}

.form-control,
.form-select {
    border-radius: 50px;
}

/* SCROLL FADE */
.fade-section {
    opacity: 0;
    transform: translateY(60px);
    transition: 1s;
}

.fade-section.show {
    opacity: 1;
    transform: translateY(0);
}

</style>


<!-- HERO -->
<section class="product-hero">

    <div class="container">

        <div class="glass-box text-center">

            <h1 class="fw-bold display-5">
                Morchhadi Collection ☕
            </h1>

            <p class="mt-3">
                Premium chai patti with rich color & kadak taste
            </p>

        </div>

    </div>

</section>


<!-- FILTER -->
<section class="container py-5 fade-section">

    <div class="filter-box mb-4">

        <div class="row align-items-center">

            <div class="col-md-4 mb-2">
                <input type="text"
                    id="searchInput"
                    class="form-control"
                    placeholder="Search products...">
            </div>

            <div class="col-md-4 mb-2">
                <select id="categorySelect"
                    class="form-select">

                    <option value="">All Categories</option>

                    @foreach($categories as $id => $name)
                        <option value="{{ $id }}">
                            {{ $name }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="col-md-4 mb-2">
                <select id="sortSelect"
                    class="form-select">

                    <option value="">Sort by</option>
                    <option value="price-asc">Price low → high</option>
                    <option value="price-desc">Price high → low</option>

                </select>
            </div>

        </div>

    </div>


    <!-- PRODUCT GRID -->
    <div id="productGrid" class="row g-4">

        @foreach($products as $product)

        <div class="col-md-4 fade-section">

            <div class="product-card h-100">

                <img src="{{ $product->image }}"
                     class="w-100">

                <div class="p-4 text-center">

                    <h5 class="fw-bold">
                        {{ $product->name }}
                    </h5>

                    <p class="small text-muted">
                        {!! $product->description !!}
                    </p>

                    <div class="d-flex justify-content-between align-items-center mt-3">

                        <div>

                            <span class="text-muted text-decoration-line-through small">
                                ₹{{ $product->price }}
                            </span>

                            <span class="price ms-2">
                                ₹{{ $product->price - $product->discount_price }}
                            </span>

                        </div>

                        <a href="{{ route('product.view', $product->id) }}"
                           class="btn btn-premium btn-sm">

                            View

                        </a>

                    </div>

                </div>

            </div>

        </div>

        @endforeach

    </div>

</section>


<script>

const sections = document.querySelectorAll('.fade-section');

window.addEventListener('scroll', () => {

    const triggerBottom = window.innerHeight * 0.85;

    sections.forEach(section => {

        const sectionTop = section.getBoundingClientRect().top;

        if(sectionTop < triggerBottom){

            section.classList.add('show');

        }

    });

});

</script>


@endsection