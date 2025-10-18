<!-- Cart Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="cartCanvas">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">Your Cart</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body d-flex flex-column">
    <div id="cartItems" class="list-group mb-3"></div>
    <div class="mt-auto">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="fw-bold">Total</div>
        <div id="cartTotal" class="fw-bold">₹0</div>
      </div>
      <a href="{{ route('products') }}" class="btn btn-outline-secondary w-100 mb-2">Continue Shopping</a>
      <button id="checkoutTopBtn" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#checkoutModal">Checkout</button>
    </div>
  </div>
</div>

<!-- Checkout Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Checkout</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="checkoutFormShared">
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input required id="custName" type="text" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input required id="custEmail" type="email" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Address</label>
            <textarea required id="custAddress" class="form-control" rows="2"></textarea>
          </div>
          <div class="form-check mb-3">
            <input required id="termsCheck" class="form-check-input" type="checkbox">
            <label class="form-check-label">I agree to the terms & place the order</label>
          </div>
          <div class="text-end">
            <button class="btn btn-primary">Place Order</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Order Confirmation Modal -->
<div class="modal fade" id="orderModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center p-4">
        <h4>Thank you — Order Placed!</h4>
        <p class="small text-muted">A confirmation has been sent to your email.</p>
        <button class="btn btn-success mt-3" data-bs-dismiss="modal">Continue Shopping</button>
      </div>
    </div>
  </div>
</div>
