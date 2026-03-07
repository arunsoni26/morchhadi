@extends('frontend.layouts.app')
@section('title', 'Morchhadi — Home')
@section('meta_description', 'Morchhadi Chai – Premium quality strong tea with rich color and kadak taste.')

@section('content')

<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(120deg, #fffdf8, #fef6e6);
    color: #3a2e2a;
    scroll-behavior: smooth;
  }

  /* ================= HERO ================= */

  .hero {
    min-height: 100vh;
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;
    padding: 80px 0;
  }

  .hero::before {
    content: "";
    position: absolute;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, #ffb34730, #ff7a0020);
    border-radius: 50%;
    top: -200px;
    right: -150px;
    z-index: 0;
  }

  .hero::after {
    content: "";
    position: absolute;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, #ff7a0025, #ffb34720);
    border-radius: 50%;
    bottom: -200px;
    left: -150px;
    z-index: 0;
  }

  .hero-content {
    position: relative;
    z-index: 2;
  }

  .glass-box {
    background: #ffffff;
    padding: 60px;
    border-radius: 30px;
    box-shadow: 0 30px 80px rgba(0, 0, 0, 0.08);
    animation: fadeUp 1.2s ease;
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

  /* ================= BUTTON ================= */

  .btn-premium {
    background: linear-gradient(45deg, #c56a00, #ff8c00);
    border: none;
    color: #fff;
    padding: 14px 35px;
    border-radius: 50px;
    font-weight: 500;
    transition: 0.4s ease;
    box-shadow: 0 10px 30px rgba(255, 140, 0, 0.3);
  }

  .btn-premium:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 40px rgba(255, 140, 0, 0.4);
  }

  /* ================= HERO IMAGE FLOAT ================= */

  .hero-img {
    animation: float 4s ease-in-out infinite;
  }

  @keyframes float {
    0% {
      transform: translateY(0);
    }

    50% {
      transform: translateY(-15px);
    }

    100% {
      transform: translateY(0);
    }
  }

  /* ================= FEATURES ================= */

  .section-title {
    font-weight: 700;
    margin-bottom: 20px;
    position: relative;
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

  .feature-box {
    background: #fff;
    padding: 35px;
    border-radius: 25px;
    transition: 0.4s ease;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.06);
  }

  .feature-box:hover {
    transform: translateY(-12px);
    box-shadow: 0 30px 80px rgba(255, 140, 0, 0.2);
  }

  .icon {
    font-size: 45px;
  }

  /* ================= PRODUCT CARDS ================= */

  .product-card {
    background: #fff;
    border-radius: 30px;
    overflow: hidden;
    transition: 0.4s ease;
    box-shadow: 0 25px 70px rgba(0, 0, 0, 0.08);
  }

  .product-card img {
    transition: 0.4s ease;
  }

  .product-card:hover img {
    transform: scale(1.08);
  }

  .product-card:hover {
    transform: translateY(-15px);
    box-shadow: 0 35px 90px rgba(255, 140, 0, 0.2);
  }

  .price {
    color: #c56a00;
    font-weight: 700;
  }

  /* ================= TESTIMONIAL ================= */

  .testimonial-box {
    background: #fff;
    padding: 50px;
    border-radius: 30px;
    box-shadow: 0 30px 80px rgba(0, 0, 0, 0.06);
    transition: 0.4s ease;
  }

  .testimonial-box:hover {
    transform: translateY(-8px);
  }

  .whatsapp-float {
    position: fixed;
    bottom: 25px;
    right: 25px;
    background: #25D366;
    color: #fff;
    padding: 16px 20px;
    border-radius: 50%;
    font-size: 26px;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
    transition: 0.3s;
  }

  .whatsapp-float:hover {
    transform: scale(1.1);
  }
</style>
<style>
  /* ================= SMOOTH PAGE FADE ================= */
  body {
    animation: pageFade 1s ease;
  }

  @keyframes pageFade {
    from {
      opacity: 0;
    }

    to {
      opacity: 1;
    }
  }

  /* ================= FLOATING BACKGROUND ANIMATION ================= */

  .hero::before {
    animation: floatBg 8s ease-in-out infinite alternate;
  }

  .hero::after {
    animation: floatBg2 10s ease-in-out infinite alternate;
  }

  @keyframes floatBg {
    0% {
      transform: translateY(0px);
    }

    100% {
      transform: translateY(40px);
    }
  }

  @keyframes floatBg2 {
    0% {
      transform: translateX(0px);
    }

    100% {
      transform: translateX(40px);
    }
  }

  /* ================= BUTTON SHINE EFFECT ================= */

  .btn-premium {
    position: relative;
    overflow: hidden;
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

  /* ================= PRODUCT STAGGER ANIMATION ================= */

  .product-card {
    opacity: 0;
    transform: translateY(40px);
    animation: productFade 0.8s forwards;
  }

  .product-card:nth-child(1) {
    animation-delay: 0.2s;
  }

  .product-card:nth-child(2) {
    animation-delay: 0.4s;
  }

  .product-card:nth-child(3) {
    animation-delay: 0.6s;
  }

  .product-card:nth-child(4) {
    animation-delay: 0.8s;
  }

  .product-card:nth-child(5) {
    animation-delay: 1s;
  }

  @keyframes productFade {
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  /* ================= FEATURE ICON BOUNCE ================= */

  .feature-box .icon {
    transition: 0.4s;
  }

  .feature-box:hover .icon {
    transform: scale(1.2) rotate(5deg);
  }

  /* ================= HERO IMAGE STEAM EFFECT ================= */

  .hero-img {
    position: relative;
  }

  .hero-img::after {
    content: "";
    position: absolute;
    top: -20px;
    left: 50%;
    width: 20px;
    height: 60px;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.6), transparent);
    animation: steam 3s infinite ease-in-out;
  }

  @keyframes steam {
    0% {
      transform: translateY(0) scale(1);
      opacity: 0.7;
    }

    50% {
      transform: translateY(-30px) scale(1.3);
      opacity: 0.3;
    }

    100% {
      transform: translateY(-60px) scale(1.6);
      opacity: 0;
    }
  }

  /* ================= SECTION FADE ON SCROLL ================= */

  .fade-section {
    opacity: 0;
    transform: translateY(60px);
    transition: all 1s ease;
  }

  .fade-section.show {
    opacity: 1;
    transform: translateY(0);
  }

  /* ================= WHATSAPP PULSE ================= */

  .whatsapp-float {
    animation: pulseWhatsapp 2s infinite;
  }

  @keyframes pulseWhatsapp {
    0% {
      box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.6);
    }

    70% {
      box-shadow: 0 0 0 15px rgba(37, 211, 102, 0);
    }

    100% {
      box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
    }
  }
</style>
<!-- ================= HERO ================= -->

<section class="hero">
  <div class="container hero-content">
    <div class="row align-items-center glass-box">

      <div class="col-lg-7">
        <h1 class="fw-bold display-5">
          Har Cup Me Desi Swad,<br>
          Har Ghoont Me Morchhadi Ka Vaada ☕
        </h1>

        <p class="mt-3">
          Premium strong chai patti with rich color & kadak taste.
        </p>

        <div class="mt-4 d-flex gap-3">
          <a href="{{ route('products') }}" class="btn btn-premium">
            Shop Now
          </a>
          <a href="#"
            class="btn btn-outline-dark rounded-pill px-4 d-inline-flex align-items-center justify-content-center">
            Wholesale Inquiry
          </a>
        </div>
      </div>

      <div class="col-lg-5 text-center">
        <img src="{{ asset('img/products/morchhadi-product.png') }}"
          class="img-fluid hero-img" alt="Morchhadi Tea">
      </div>

    </div>
  </div>
</section>

<!-- ================= FEATURES ================= -->

<section class="container py-5 text-center fade-section">
  <h2 class="section-title">Why Choose Morchhadi?</h2>

  <div class="row g-4 mt-4">
    <div class="col-md-4">
      <div class="feature-box h-100">
        <div class="icon">🌿</div>
        <h5 class="mt-3">Premium Tea Leaves</h5>
      </div>
    </div>

    <div class="col-md-4">
      <div class="feature-box h-100">
        <div class="icon">🔥</div>
        <h5 class="mt-3">Strong Color & Taste</h5>
      </div>
    </div>

    <div class="col-md-4">
      <div class="feature-box h-100">
        <div class="icon">📦</div>
        <h5 class="mt-3">Hygienic Packing</h5>
      </div>
    </div>
  </div>
</section>

<!-- ================= PRODUCTS ================= -->

<section class="container py-5 fade-section">
  <h2 class="section-title text-center">Popular Products</h2>

  <div class="row g-4 mt-4">
    @foreach ($products as $product)
    <div class="col-md-4">
      <div class="product-card p-4 h-100 text-center">
        <img src="{{ $product->image }}" class="img-fluid mb-3">
        <h5>{{ $product->name }}</h5>
        <p class="small text-muted">{{ $product->short_description }}</p>

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
    @endforeach
  </div>
</section>

<script>
  const sections = document.querySelectorAll('.fade-section');

  window.addEventListener('scroll', () => {
    const triggerBottom = window.innerHeight * 0.85;

    sections.forEach(section => {
      const sectionTop = section.getBoundingClientRect().top;

      if (sectionTop < triggerBottom) {
        section.classList.add('show');
      }
    });
  });
</script>
@endsection