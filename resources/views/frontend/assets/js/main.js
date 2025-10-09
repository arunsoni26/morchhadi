// Shared products data and cart logic
const products = [
  {id:1, name:'Assam Bold', desc:'Strong morning black tea', price:299, tag:'black', img:'https://images.unsplash.com/photo-1521302080394-8e5b1a2a7b2b?auto=format&fit=crop&w=800&q=60'},
  {id:2, name:'Darjeeling First Flush', desc:'Delicate floral notes', price:599, tag:'black', img:'https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=800&q=60'},
  {id:3, name:'Sencha Green', desc:'Fresh grassy green tea', price:349, tag:'green', img:'https://images.unsplash.com/photo-1556911073-52527ac437f5?auto=format&fit=crop&w=800&q=60'},
  {id:4, name:'Matcha Ceremonial', desc:'Vibrant powdered green tea', price:999, tag:'green', img:'https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=800&q=60'},
  {id:5, name:'Chamomile Calm', desc:'Caffeine-free floral herbal', price:249, tag:'herbal', img:'https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=800&q=60'},
  {id:6, name:'Peppermint Zing', desc:'Refreshing herbal mint', price:229, tag:'herbal', img:'https://images.unsplash.com/photo-1518976024611-1884b85b6b1b?auto=format&fit=crop&w=800&q=60'}
];

// load or init cart from localStorage
let cart = JSON.parse(localStorage.getItem('teaCart')||'{}');

function saveCart(){ localStorage.setItem('teaCart', JSON.stringify(cart)); updateCartUI(); }
function addToCart(id){ const p = products.find(x=>x.id===id); if(!p) return; if(cart[id]) cart[id].qty++; else cart[id]={...p, qty:1}; saveCart(); showToast(`${p.name} added to cart`); }
function removeFromCart(id){ if(!cart[id]) return; delete cart[id]; saveCart(); }
function changeQty(id,delta){ if(!cart[id]) return; cart[id].qty += delta; if(cart[id].qty<=0) removeFromCart(id); saveCart(); }
function cartTotal(){ return Object.values(cart).reduce((s,item)=> s + item.price*item.qty, 0); }

function updateCartUI(){ const $items = $('#cartItems'); $items.empty(); const vals = Object.values(cart);
  if(vals.length===0){ $items.append('<div class="text-center text-muted">Cart is empty</div>'); $('#cartTotal').text('₹0'); $('#cartCountTop').addClass('d-none'); }
  else{ vals.forEach(it=>{ const $el = $(`
        <div class="list-group-item d-flex align-items-center">
          <img src="${it.img}" width="56" class="rounded me-3 object-fit-cover">
          <div>
            <div class="fw-bold">${it.name}</div>
            <div class="small text-muted">₹${it.price} x ${it.qty} = ₹${it.price*it.qty}</div>
          </div>
          <div class="ms-auto d-flex gap-2 align-items-center">
            <button class="btn btn-sm btn-outline-secondary qty-dec" data-id="${it.id}">-</button>
            <span class="px-2">${it.qty}</span>
            <button class="btn btn-sm btn-outline-secondary qty-inc" data-id="${it.id}">+</button>
            <button class="btn btn-sm btn-danger ms-2 remove-item" data-id="${it.id}"><i class="bi bi-trash"></i></button>
          </div>
        </div>
      `); $items.append($el); });
    $('#cartTotal').text('₹' + cartTotal()); $('#cartCountTop').removeClass('d-none').text(vals.reduce((s,i)=>s+i.qty,0)); }
}

// render products into a supplied container
function renderProductsTo(selector, filter='all', sort='popular', search=''){ let list = products.slice(); if(filter!=='all') list = list.filter(p=>p.tag===filter); if(search) list = list.filter(p=> (p.name+' '+p.desc).toLowerCase().includes(search.toLowerCase())); if(sort==='price-asc') list.sort((a,b)=>a.price-b.price); if(sort==='price-desc') list.sort((a,b)=>b.price-a.price); const $grid = $(selector); $grid.empty(); list.forEach(p=>{ const card = `
    <div class="col-12 col-sm-6 col-lg-4">
      <div class="card product-card h-100">
        <img src="${p.img}" class="tea-img w-100" alt="${p.name}">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title mb-1">${p.name}</h5>
          <p class="small text-muted mb-2">${p.desc}</p>
          <div class="d-flex align-items-center mt-auto"><div class="price">₹${p.price}</div><div class="ms-auto d-flex gap-2">
            <a class="btn btn-outline btn-success" href="https://wa.me/11234567890?text=Hello%20I%20need%20assistance" target="_blank">
              <i class="bi bi-whatsapp"></i>
            </a>
            <button class="btn btn-outline-secondary btn-sm view-btn" data-id="${p.id}">View</button>
            <button class="btn btn-primary btn-sm add-btn" data-id="${p.id}">Add</button></div></div>
        </div>
      </div>
    </div>
  `; $grid.append(card); }); }

// small toast utility
function showToast(msg){ const $t = $(`<div class="toast align-items-center text-white bg-dark border-0 position-fixed end-0 m-3" role="status" aria-live="polite" aria-atomic="true"><div class="d-flex"><div class="toast-body">${msg}</div><button type="button" class="btn-close btn-close-white ms-auto me-2" data-bs-dismiss="toast"></button></div></div>`); $('body').append($t); const t = new bootstrap.Toast($t[0], {delay:1500}); t.show(); $t.on('hidden.bs.toast', ()=> $t.remove()); }

// document ready behaviors shared across pages
$(function(){
  // update year
  $('#yearSpan').text(new Date().getFullYear());
  // render featured on index if container exists
  if($('#featuredGrid').length) renderProductsTo('#featuredGrid','all','popular','');
  // render products page
  if($('#productGrid').length) renderProductsTo('#productGrid','all','popular','');

  updateCartUI();

  // global events
  $(document).on('click', '.add-btn', function(){ addToCart(parseInt($(this).data('id'))); });
  $(document).on('click', '.qty-inc', function(){ changeQty(parseInt($(this).data('id')),1); });
  $(document).on('click', '.qty-dec', function(){ changeQty(parseInt($(this).data('id')),-1); });
  $(document).on('click', '.remove-item', function(){ removeFromCart(parseInt($(this).data('id'))); });
  $(document).on('click', '.filter-pill', function(){ $('.filter-pill').removeClass('active'); $(this).addClass('active'); const f = $(this).data('filter'); renderProductsTo('#productGrid' in window ? '#productGrid' : '#featuredGrid', f, $('#sortSelect').val()||'popular', $('#searchInput').val()||''); });

  $('#sortSelect').on('change', function(){ renderProductsTo('#productGrid','#productGrid'.length?$('.filter-pill.active').data('filter')||'all':'all', $(this).val(), $('#searchInput').val()||''); });
  $('#searchInput').on('input', function(){ renderProductsTo('#productGrid' in window ? '#productGrid' : '#featuredGrid', $('.filter-pill.active').data('filter')||'all', $('#sortSelect').val()||'popular', $(this).val()); });

  // checkout form (shared)
  $(document).on('submit', '#checkoutFormShared', function(e){ e.preventDefault(); $('#checkoutModal').modal('hide'); setTimeout(()=>{ $('#orderModal').modal('show'); cart={}; saveCart(); }, 350); });

  // quick view (simple)
  $(document).on('click', '.view-btn', function(){ const id = parseInt($(this).data('id')); const p = products.find(x=>x.id===id); if(!p) return; const html = `<div class="modal fade" id="pvModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-body p-3"><div class="row"><div class="col-5"><img src="${p.img}" class="img-fluid rounded"></div><div class="col-7"><h5>${p.name}</h5><p class="small text-muted">${p.desc}</p><div class="fw-bold mb-3">₹${p.price}</div><div class="d-flex gap-2"><button class="btn btn-primary add-btn" data-id="${p.id}">Add to Cart</button><button class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button></div></div></div></div></div></div>`; $('body').append(html); const m = new bootstrap.Modal(document.getElementById('pvModal')); m.show(); $('#pvModal').on('hidden.bs.modal', function(){ $(this).remove(); }); });

  // search in navbar
  $('#searchInputNav').on('keypress', function(e){ if(e.which==13){ e.preventDefault(); localStorage.setItem('lastSearch', $(this).val()); window.location.href='products.html'; } });

  // when landing on products page after search, populate
  if(window.location.pathname.endsWith('products.html') && localStorage.getItem('lastSearch')){ const q = localStorage.getItem('lastSearch'); $('#searchInput').val(q); renderProductsTo('#productGrid','all','popular', q); localStorage.removeItem('lastSearch'); }
});

// expose addToCart globally for inline use
window.addToCart = addToCart;