<nav class="navbar navbar-expand-lg bg-white px-3 py-3 shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand" href="{{ route('homepage') }}">
      <img src="https://morchhadichai.co.in/public/img/images/morchhadi-logo-3.png" alt="Morchhadi" style="height: 60px;">
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

      <div class="d-flex gap-2 align-items-center">
        
        {{-- Show when user is authenticated --}}
        @auth
        <div class="dropdown">
          <a href="#" id="accountBtn" class="btn btn-outline-secondary dropdown-toggle" 
            title="Account" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person"></i>
          </a>

          <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="accountBtn">
            <li class="dropdown-header d-flex align-items-center gap-2 px-3">
              <i class="bi bi-person-circle"></i>
              <span><strong>{{ auth()->user()->name }}</strong></span>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <a class="dropdown-item d-flex align-items-center gap-2" href="">
                <i class="bi bi-person-lines-fill"></i> Profile
              </a>
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i> Logout
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
            </li>
          </ul>
        </div>
        @endauth

        {{-- Show when user is guest --}}
        @guest
        <a href="{{ route('login') }}" class="btn btn-outline-primary">
          <i class="bi-person-lock"></i>
        </a>
        <a href="{{ route('register') }}" class="btn btn-outline-secondary">
          <i class="bi bi-person-plus-fill"></i>
        </a>
        @endguest

      </div>
    </div>
  </div>
</nav>
