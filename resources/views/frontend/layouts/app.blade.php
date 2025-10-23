<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Morchadi — Home')</title>

  <link rel="icon" href="https://morchhadichai.co.in/public/img/images/morchhadi-logo-2.jpg" type="image/x-icon">

  <!-- Bootstrap CSS & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <style>
    /* Include your entire CSS here (you can later move this into app.css if needed) */
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f9f9f9;
      line-height: 1.6;
    }
    a { transition: all 0.3s ease-in-out; }
    h1, h2, h3, h4, h5 { font-weight: 600; }

    .navbar { border-bottom: 1px solid #eee; transition: all 0.3s ease-in-out; }
    .nav-link { color: #333; font-weight: 500; padding: 8px 12px; }
    .nav-link:hover, .nav-link.active { color: #006241; }

    header.container.hero-section {
      background: linear-gradient(135deg, #e6fff4 0%, #ffffff 100%);
      border-radius: 12px;
      padding: 50px 30px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.03);
      position: relative;
      overflow: hidden;
    }
    header.container.hero-section .hero-overlay {
      position: absolute; top: 0; right: 0; width: 40%; height: 100%;
      background: url('https://morchhadichai.co.in/public/img/products/morchhadi-product.jpg') no-repeat center center;
      background-size: cover; opacity: 0.08; pointer-events: none;
    }
    .hero-img { max-height: 350px; object-fit: cover; border-radius: 8px; }

    .why-choose { padding: 60px 0; }
    .why-choose .feature-card {
      text-align: center; padding: 30px 20px; background-color: #fff;
      border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .why-choose .feature-card:hover { transform: translateY(-8px); box-shadow: 0 8px 24px rgba(0,0,0,0.1); }
    
    .why-choose .feature-card .icon {
      font-size: 2.5rem;
      color: #006241;
      margin-bottom: 15px;
    }

    .product-card {
      border: none; transition: all 0.3s; box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      border-radius: 12px; overflow: hidden;
    }
    .product-card:hover { transform: translateY(-5px); box-shadow: 0 6px 20px rgba(0,0,0,0.1); }
    .product-card .price { font-weight: 600; color: #006241; }

    .btn-primary {
      background-color: #006241; border-color: #006241; border-radius: 30px; padding: 10px 24px;
    }
    .btn-primary:hover { background-color: #004f34; border-color: #004f34; }

    
    /* === TESTIMONIALS SECTION === */
    .testimonials {
      background: #ffffff;
      padding: 60px 0;
    }
    .testimonial-card {
      background-color: #f8fefa;
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.04);
      transition: transform 0.3s ease-in-out;
    }
    .testimonial-card:hover {
      transform: translateY(-6px);
    }
    .testimonial-card .quote-icon {
      font-size: 2rem;
      color: #006241;
      margin-bottom: 15px;
    }
    .testimonial-card p {
      font-style: italic;
      color: #444;
    }
    .testimonial-card .customer {
      margin-top: 20px;
      font-weight: 600;
      color: #006241;
    }

    footer { font-size: 0.9rem; background-color: #f0f0f0; }
    .back-to-top { color: #006241; cursor: pointer; text-decoration: underline; }

    @media (max-width: 768px) {
      header.container.hero-section { text-align: center; padding: 30px 20px; }
      .hero-img { margin-top: 20px; }
      .why-choose .feature-card { margin-bottom: 20px; }
    }
  </style>
  @stack('styles')
</head>
<body>
  <div class="d-flex flex-column min-vh-100">
    @include('frontend.partials.navbar')

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>
    @include('frontend.partials.footer')
  </div>

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.getElementById('yearSpan').textContent = new Date().getFullYear();
  </script>
  @stack('scripts')
</body>
</html>
