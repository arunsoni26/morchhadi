<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TeaHouse — Products</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/styles.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
  <!-- Navbar same as index (keep links consistent) -->
  <nav class="navbar navbar-expand-lg bg-white px-3 py-3 shadow-sm sticky-top">
    <div class="container">
      <a class="navbar-brand" href="{{ route('homepage') }}">TeaHouse</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"></button>
      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="{{ route('homepage') }}">Home</a></li>
          <li class="nav-item"><a class="nav-link active" href="{{ route('products') }}">Products</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('shop') }}">Shops</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About Us</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('services') }}">Services</a></li>
        </ul>
        <form class="d-flex me-3" role="search"><input id="searchInput" class="form-control me-2" type="search" placeholder="Search teas..."></form>
        <div class="d-flex gap-2 align-items-center"><a href="#" class="btn btn-outline-secondary"><i class="bi bi-person"></i></a>
        <button id="cartBtnTop" class="btn btn-outline-secondary position-relative" data-bs-toggle="offcanvas" data-bs-target="#cartCanvas"><i class="bi bi-cart3"></i><span id="cartCountTop" class="badge bg-danger position-absolute top-0 start-100 translate-middle d-none">0</span></button>
        </div>
      </div>
    </div>
  </nav>

  <main class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2>Products</h2>
      <div class="d-flex gap-2">
        <div class="btn-group">
          <button class="btn btn-sm btn-outline-secondary filter-pill" data-filter="all">All</button>
          <button class="btn btn-sm btn-outline-secondary filter-pill" data-filter="black">Black</button>
          <button class="btn btn-sm btn-outline-secondary filter-pill" data-filter="green">Green</button>
          <button class="btn btn-sm btn-outline-secondary filter-pill" data-filter="herbal">Herbal</button>
        </div>
        <select id="sortSelect" class="form-select form-select-sm" style="width:160px"><option value="popular">Popular</option><option value="price-asc">Price low→high</option><option value="price-desc">Price high→low</option></select>
      </div>
    </div>
    <div id="productGrid" class="row g-4"></div>
  </main>

  <!-- reuse cart & modals from index (same IDs) -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="cartCanvas">
    <div class="offcanvas-header"><h5>Your Cart</h5><button class="btn-close" data-bs-dismiss="offcanvas"></button></div>
    <div class="offcanvas-body d-flex flex-column"><div id="cartItems" class="list-group mb-3"></div><div class="mt-auto"><div class="d-flex justify-content-between align-items-center mb-3"><div class="fw-bold">Total</div><div id="cartTotal" class="fw-bold">₹0</div></div><a href="{{ route('products') }}" class="btn btn-outline-secondary w-100 mb-2">Continue Shopping</a><button id="checkoutTopBtn" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#checkoutModal">Checkout</button></div></div>
  </div>

  <div class="modal fade" id="checkoutModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Checkout</h5><button class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body"><form id="checkoutFormShared"><div class="mb-3"><label class="form-label">Name</label><input required id="custName" type="text" class="form-control"></div><div class="mb-3"><label class="form-label">Email</label><input required id="custEmail" type="email" class="form-control"></div><div class="mb-3"><label class="form-label">Address</label><textarea required id="custAddress" class="form-control" rows="2"></textarea></div><div class="form-check mb-3"><input required id="termsCheck" class="form-check-input" type="checkbox"><label class="form-check-label">I agree to the terms & place the order</label></div><div class="text-end"><button class="btn btn-primary">Place Order</button></div></form></div></div></div></div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/main.js"></script>
</body>
</html>