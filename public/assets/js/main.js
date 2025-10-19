// initialize cart from localStorage
let cart = JSON.parse(localStorage.getItem('teaCart') || '{}');

// Save cart to localStorage and update UI
function saveCart() {
  localStorage.setItem('teaCart', JSON.stringify(cart));
  updateCartUI();
}

// Add to cart using inline dataset
function addToCart(product) {
  const id = parseInt(product.id);
  if (!id) return;

  if (cart[id]) {
    cart[id].qty++;
  } else {
    cart[id] = {
      id,
      name: product.name,
      price: parseFloat(product.price),
      img: product.img,
      qty: 1
    };
  }

  saveCart();
  showToast(`${product.name} added to cart`);
}

// Remove item from cart
function removeFromCart(id) {
  if (!cart[id]) return;
  delete cart[id];
  saveCart();
}

// Change quantity
function changeQty(id, delta) {
  if (!cart[id]) return;
  cart[id].qty += delta;
  if (cart[id].qty <= 0) {
    removeFromCart(id);
  } else {
    saveCart();
  }
}

// Total cart value
function cartTotal() {
  return Object.values(cart).reduce((sum, item) => sum + item.price * item.qty, 0);
}

// Update cart UI
function updateCartUI() {
  const $items = $('#cartItems');
  $items.empty();
  const vals = Object.values(cart);

  if (vals.length === 0) {
    $items.append('<div class="text-center text-muted">Cart is empty</div>');
    $('#cartTotal').text('₹0');
    $('#cartCountTop').addClass('d-none');
  } else {
    vals.forEach(item => {
      const $el = $(`
        <div class="list-group-item d-flex align-items-center">
          <img src="${item.img}" width="56" class="rounded me-3 object-fit-cover">
          <div>
            <div class="fw-bold">${item.name}</div>
            <div class="small text-muted">₹${item.price} x ${item.qty} = ₹${item.price * item.qty}</div>
          </div>
          <div class="ms-auto d-flex gap-2 align-items-center">
            <button class="btn btn-sm btn-outline-secondary qty-dec" data-id="${item.id}">-</button>
            <span class="px-2">${item.qty}</span>
            <button class="btn btn-sm btn-outline-secondary qty-inc" data-id="${item.id}">+</button>
            <button class="btn btn-sm btn-danger ms-2 remove-item" data-id="${item.id}"><i class="bi bi-trash"></i></button>
          </div>
        </div>
      `);
      $items.append($el);
    });

    $('#cartTotal').text('₹' + cartTotal());
    $('#cartCountTop').removeClass('d-none').text(vals.reduce((s, i) => s + i.qty, 0));
  }
}

// Toast utility
function showToast(msg) {
  const $t = $(`
    <div class="toast align-items-center text-white bg-dark border-0 position-fixed end-0 m-3" role="status" aria-live="polite" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">${msg}</div>
        <button type="button" class="btn-close btn-close-white ms-auto me-2" data-bs-dismiss="toast"></button>
      </div>
    </div>
  `);
  $('body').append($t);
  const t = new bootstrap.Toast($t[0], { delay: 1500 });
  t.show();
  $t.on('hidden.bs.toast', () => $t.remove());
}

// DOM Ready
$(function () {
  updateCartUI();

  // Add to cart via inline data attributes
  $(document).on('click', '.addToCartBtn', function () {
    const $btn = $(this);
    const product = {
      id: $btn.data('id'),
      name: $btn.data('name'),
      price: $btn.data('price'),
      img: $btn.data('img')
    };
    addToCart(product);
  });

  $(document).on('click', '.qty-inc', function () {
    changeQty(parseInt($(this).data('id')), 1);
  });

  $(document).on('click', '.qty-dec', function () {
    changeQty(parseInt($(this).data('id')), -1);
  });

  $(document).on('click', '.remove-item', function () {
    removeFromCart(parseInt($(this).data('id')));
  });
});
