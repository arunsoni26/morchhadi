@extends('frontend.layouts.app')

@section('title', 'Contact Us — Morchhadi')

@section('content')

<style>
  /* SAME HOME PAGE THEME */
  body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(120deg, #fffdf8, #fef6e6);
    color: #3a2e2a;
  }

  /* HERO */
  .contact-hero {
    min-height: 60vh;
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;
    padding: 80px 0;
  }

  .contact-hero::before {
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

  .contact-hero::after {
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
    margin-bottom: 20px;
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

  /* CONTACT BOX */
  .contact-box {
    background: #fff;
    padding: 20px;
    border-radius: 20px;
    margin-bottom: 20px;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.05);
    transition: 0.3s;
  }

  .contact-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 60px rgba(255, 140, 0, 0.15);
  }

  /* FORM */
  .form-control {
    border-radius: 50px;
    padding: 12px 18px;
    border: 1px solid #eee;
  }

  textarea.form-control {
    border-radius: 20px;
  }

  .form-control:focus {
    border-color: #ff8c00;
    box-shadow: none;
  }

  /* BUTTON */
  .btn-premium {
    background: linear-gradient(45deg, #c56a00, #ff8c00);
    border: none;
    color: #fff;
    border-radius: 50px;
    padding: 12px 30px;
    transition: 0.3s;
  }

  .btn-premium:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(255, 140, 0, 0.3);
  }

  /* SCROLL FADE */
  .fade-section {
    opacity: 0;
    transform: translateY(60px);
    transition: 1s ease;
  }

  .fade-section.show {
    opacity: 1;
    transform: translateY(0);
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
</style>


<!-- HERO -->
<section class="contact-hero">
  <div class="container text-center">

    <div class="glass-box mx-auto" style="max-width:700px;">

      <h1 class="fw-bold display-5">
        Contact Morchhadi ☕
      </h1>

      <p class="mt-3">
        Humse jude — hum hamesha aapke saath hain.
      </p>

    </div>

  </div>
</section>


<!-- CONTACT CONTENT -->
<section class="container py-5 fade-section">

  <div class="row g-5">

    <!-- CONTACT INFO -->
    <div class="col-md-5">

      <div class="glass-box">

        <h4 class="section-title">Get In Touch</h4>

        <div class="contact-box">
          📞 <strong>Phone:</strong><br>
          <a href="tel:9009733514"
            class="text-decoration-none"
            style="color:#c56a00;">
            9009733514
          </a>
        </div>

        <div class="contact-box">
          📧 <strong>Email:</strong><br>
          <a href="mailto:morchadichai@gmail.com"
            class="text-decoration-none"
            style="color:#c56a00;">
            morchadichai@gmail.com
          </a>
        </div>

        <div class="contact-box">
          📍 <strong>Address:</strong><br>
          Shajapur, Madhya Pradesh
        </div>

        <p class="mt-3 text-muted">
          Aap humse directly contact kar sakte hain ya form fill kare —
          hum jaldi reply karenge.
        </p>

      </div>

    </div>


    <!-- CONTACT FORM -->
    <div class="col-md-7">

      <div class="glass-box">

        <h4 class="section-title">Send Message</h4>

        <form action="" method="POST">
          @csrf

          <div class="mb-3">
            <input type="text"
              name="name"
              class="form-control"
              placeholder="Your Name"
              required>
          </div>

          <div class="mb-3">
            <input type="email"
              name="email"
              class="form-control"
              placeholder="Your Email"
              required>
          </div>

          <div class="mb-3">
            <input type="text"
              name="phone"
              class="form-control"
              placeholder="Phone Number">
          </div>

          <div class="mb-3">
            <textarea name="message"
              rows="4"
              class="form-control"
              placeholder="Your Message"
              required></textarea>
          </div>

          <button type="submit" class="btn btn-premium">
            Send Message
          </button>

        </form>

      </div>

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