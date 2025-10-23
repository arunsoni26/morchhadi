<footer class="bg-light text-center text-muted py-4 mt-auto">
  <div class="container">
    <div class="row">
      <div class="col-md-4 mb-3 mb-md-0">
        <h6>Company</h6>
        <ul class="list-unstyled">
          <li><a href="{{ url('/about') }}" class="text-muted">About Us</a></li>
          <li><a href="{{ url('/services') }}" class="text-muted">Services</a></li>
          <li><a href="{{ url('/shop') }}" class="text-muted">Shop Locations</a></li>
        </ul>
      </div>
      <div class="col-md-4 mb-3 mb-md-0">
        <h6>Support</h6>
        <ul class="list-unstyled">
          <li><a href="#" class="text-muted">Contact</a></li>
          <li><a href="#" class="text-muted">FAQ</a></li>
          <li><a href="#" class="text-muted">Returns</a></li>
        </ul>
      </div>
      <div class="col-md-4">
        <h6>Follow Us</h6>
        <a href="#" class="text-muted me-2"><i class="bi bi-facebook"></i></a>
        <a href="#" class="text-muted me-2"><i class="bi bi-instagram"></i></a>
        <a href="#" class="text-muted"><i class="bi bi-twitter"></i></a>
      </div>
    </div>
    <div class="mt-3">
      © <span id="yearSpan">{{ date('Y') }}</span> Morchadi — Crafted with care.
    </div>
    <div class="back-to-top" onclick="window.scrollTo({top:0, behavior:'smooth'})">Back to top ↑</div>
  </div>
</footer>
