@extends('frontend.layouts.app')

@section('title', 'Wholesale & Distributor — Morchhadi')

@section('content')

<style>
  /* SAME HOME PAGE THEME */
  body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(120deg, #fffdf8, #fef6e6);
    color: #3a2e2a;
  }

  /* HERO */
  .wholesale-hero {
    min-height: 60vh;
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;
    padding: 80px 0;
  }

  .wholesale-hero::before {
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

  .wholesale-hero::after {
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

  /* GLASS BOX */
  .glass-box {
    background: #ffffff;
    padding: 50px;
    border-radius: 30px;
    box-shadow: 0 30px 80px rgba(0, 0, 0, 0.08);
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
  }

  .section-title::after {
    content: "";
    width: 80px;
    height: 4px;
    background: linear-gradient(45deg, #c56a00, #ff8c00);
    display: block;
    margin-top: 10px;
    border-radius: 10px;
  }

  /* FEATURE BOX */
  .feature-box {
    background: #fff;
    padding: 25px;
    border-radius: 20px;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.05);
    transition: 0.3s;
    font-weight: 500;
  }

  .feature-box:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 60px rgba(255, 140, 0, 0.15);
  }

  /* BUTTON */
  .btn-premium {
    background: linear-gradient(45deg, #c56a00, #ff8c00);
    border: none;
    color: #fff;
    border-radius: 50px;
    padding: 14px 35px;
    transition: 0.3s;
  }

  .btn-premium:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(255, 140, 0, 0.3);
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


  /* FADE SCROLL */
  .fade-section {
    opacity: 0;
    transform: translateY(60px);
    transition: 1s ease;
  }

  .fade-section.show {
    opacity: 1;
    transform: translateY(0);
  }
</style>


<!-- HERO -->
<section class="wholesale-hero">

  <div class="container text-center">

    <div class="glass-box mx-auto" style="max-width:800px;">

      <h1 class="fw-bold display-5">
        Wholesale & Distributor Inquiry
      </h1>

      <p class="mt-3">
        Strong partnership. Strong chai. Strong business.
      </p>

    </div>

  </div>

</section>


<!-- CONTENT -->
<section class="container py-5 fade-section">

  <div class="glass-box">

    <p style="line-height:1.9; font-size:17px;">
      Agar aap apni dukaan, hotel ya distribution business ke liye
      high quality chai ki talash me hain, to
      <span style="color:#c56a00; font-weight:600;">
        Morchhadi Chai
      </span>
      aapke liye perfect choice hai.
    </p>

    <div class="row g-4 mt-4">

      <div class="col-md-6">
        <div class="feature-box">
          ✔ Attractive Wholesale Rates
        </div>
      </div>

      <div class="col-md-6">
        <div class="feature-box">
          ✔ Bulk Packing Options
        </div>
      </div>

      <div class="col-md-6">
        <div class="feature-box">
          ✔ Fast Delivery
        </div>
      </div>

      <div class="col-md-6">
        <div class="feature-box">
          ✔ Long Term Business Support
        </div>
      </div>

    </div>


    <!-- CTA -->
    <div class="text-center mt-5">

      <a href="{{ url('/contact') }}"
        target="_blank"
        class="btn btn-premium">

        Contact Now for Dealership

      </a>

    </div>

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