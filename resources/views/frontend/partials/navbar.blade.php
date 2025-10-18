<nav class="navbar navbar-expand-lg bg-white px-3 py-3 shadow-sm sticky-top">
  <div class="container">
    <!-- <a class="navbar-brand" href="{{ route('homepage') }}">TeaHouse</a> -->
    <a class="navbar-brand" href="{{ route('homepage') }}">
        <img src="{{ asset('/img/images/morchhadi-logo-3.png') }}" 
            alt="{{ config('app.name', 'Laravel') }}" 
            style="height: 60px;"> 
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('homepage') ? 'active' : '' }}" href="{{ route('homepage') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('products') ? 'active' : '' }}" href="{{ route('products') }}">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('shop') ? 'active' : '' }}" href="{{ route('shop') }}">Shops</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}" href="{{ route('services') }}">Services</a>
        </li>
      </ul>

      <form class="d-flex me-3" role="search">
        <input id="searchInputNav" class="form-control me-2" type="search" placeholder="Search teas...">
      </form>

      <div class="d-flex gap-2 align-items-center">
        <a href="#" id="accountBtn" class="btn btn-outline-secondary" title="Account">
          <i class="bi bi-person"></i>
        </a>
        <button id="cartBtnTop" class="btn btn-outline-secondary position-relative" data-bs-toggle="offcanvas" data-bs-target="#cartCanvas" title="Cart">
          <i class="bi bi-cart3"></i>
          <span id="cartCountTop" class="badge bg-danger position-absolute top-0 start-100 translate-middle d-none">0</span>
        </button>
      </div>
    </div>
  </div>
</nav>
