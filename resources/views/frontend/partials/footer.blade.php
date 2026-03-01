<style>
  /* ===== CLEAN PREMIUM FOOTER ===== */

  footer {
    background: linear-gradient(135deg, #5a2e1f, #7b3f1d);
    color: #ffffff !important;
    padding: 40px 0 20px;
    /* reduced height */
    border-radius: 50px 50px 0 0;
    box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.15);
    font-size: 14px;
  }

  /* force all text white */
  footer,
  footer h6,
  footer p,
  footer span,
  footer div {
    color: #ffffff !important;
  }

  /* remove bootstrap muted override */
  footer .text-muted {
    color: rgba(255, 255, 255, 0.85) !important;
  }

  /* links */
  footer a {
    color: rgba(255, 255, 255, 0.85) !important;
    text-decoration: none;
    transition: 0.3s ease;
    font-size: 14px;
  }

  footer a:hover {
    color: #ffb347 !important;
    padding-left: 5px;
  }

  /* list spacing */
  footer ul li {
    margin-bottom: 6px;
  }

  /* social icons */
  footer i {
    font-size: 18px;
    transition: 0.3s ease;
  }

  footer i:hover {
    color: #ffb347;
    transform: scale(1.15);
  }

  /* divider line */
  footer .mt-3 {
    border-top: 1px solid rgba(255, 255, 255, 0.2);
    padding-top: 15px;
    margin-top: 25px;
  }

  /* back to top */
  .back-to-top {
    margin-top: 10px;
    display: inline-block;
    font-size: 13px;
    cursor: pointer;
    color: #ffb347;
    transition: 0.3s;
  }

  .back-to-top:hover {
    text-decoration: underline;
    transform: translateY(-2px);
  }
</style>

<!-- <footer class="bg-light text-center text-muted py-4 mt-auto"> -->
<footer class="text-center mt-auto">
  <div class="container">
    <div class="row">
      <div class="col-md-4 mb-3 mb-md-0">
        <!-- <h6>Company</h6> -->
        <ul class="list-unstyled">
          <li><a href="{{ url('/') }}" class="text-muted">Home</a></li>
          <li><a href="{{ url('/about') }}" class="text-muted">About Us</a></li>
          <li><a href="{{ url('/products') }}" class="text-muted">Products</a></li>
          <li><a href="{{ url('/wholesale') }}" class="text-muted">Wholesale Inquiry</a></li>
        </ul>
      </div>
      <div class="col-md-4 mb-3 mb-md-0">
        <!-- <h6>Support</h6> -->
        <ul class="list-unstyled">
          <li><a href="{{ url('/contact') }}" class="text-muted">Contact Us</a></li>
          <li><a href="#" class="text-muted">Privacy Policy</a></li>
          <li><a href="#" class="text-muted">Terms & Conditions</a></li>
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
      © <span id="yearSpan">{{ date('Y') }}</span> Morchhadi Chai. All Rights Reserved.
    </div>
    <div class="back-to-top" onclick="window.scrollTo({top:0, behavior:'smooth'})">Back to top ↑</div>
  </div>
</footer>