// Sample product data
const products = [
    {
        id: 1,
        title: "Wireless Headphones",
        desc: "High-quality wireless headphones with noise cancellation.",
        price: 69.99,
        img: "assets/headphones.jpg"
    },
    {
        id: 2,
        title: "Smart Watch",
        desc: "Track your fitness and notifications with style.",
        price: 49.99,
        img: "assets/smartwatch.jpg"
    },
    {
        id: 3,
        title: "Classic Sneakers",
        desc: "Comfortable and trendy sneakers for everyday wear.",
        price: 39.99,
        img: "assets/sneakers.jpg"
    },
    {
        id: 4,
        title: "Eco Tote Bag",
        desc: "Reusable tote bag made from eco-friendly materials.",
        price: 14.99,
        img: "assets/totebag.jpg"
    },
    {
        id: 5,
        title: "Bluetooth Speaker",
        desc: "Portable speaker with deep bass and long battery life.",
        price: 29.99,
        img: "assets/speaker.jpg"
    }
];

// Cart state
let cart = [];

// Render products
function renderProducts() {
    const grid = document.getElementById('productGrid');
    if (!grid) return;
    grid.innerHTML = '';
    const user = localStorage.getItem('bazaar_user');
    products.forEach(product => {
        const card = document.createElement('div');
        card.className = 'product-card';
        card.innerHTML = `
            <img src="${product.img}" alt="${product.title}" class="product-img">
            <div class="product-info">
                <div class="product-title">${product.title}</div>
                <div class="product-desc">${product.desc}</div>
                <div class="product-price">$${product.price.toFixed(2)}</div>
                <button class="add-cart-btn" data-id="${product.id}">Add to Cart</button>
                ${user ? `<button class="add-wishlist-btn" data-id="${product.id}">♡ Wishlist</button>` : ''}
            </div>
        `;
        grid.appendChild(card);
    });
    // Add event listeners for add to cart
    grid.querySelectorAll('.add-cart-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            addToCart(id);
        });
    });
    // Add event listeners for add to wishlist
    grid.querySelectorAll('.add-wishlist-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            addToWishlist(id);
        });
    });
}

function addToWishlist(productId) {
    const user = localStorage.getItem('bazaar_user');
    if (!user) {
        alert('Please log in to use wishlist.');
        return;
    }
    const product = products.find(p => p.id == productId);
    if (!product) return;
    let all = JSON.parse(localStorage.getItem('bazaar_wishlist')||'{}');
    let list = all[user] || [];
    if (list.some(item => item.id == productId)) {
        alert('Already in wishlist!');
        return;
    }
    list.push({id: product.id, title: product.title, price: product.price, img: product.img});
    all[user] = list;
    localStorage.setItem('bazaar_wishlist', JSON.stringify(all));
    alert('Added to wishlist!');
}

// Product modal
function openProductModal(product) {
    const modal = document.getElementById('productModal');
    modal.innerHTML = `
        <img src="${product.img}" alt="${product.title}">
        <h3>${product.title}</h3>
        <p>${product.desc}</p>
        <div class="modal-price">$${product.price.toFixed(2)}</div>
        <button class="add-cart-btn" onclick="addToCart(${product.id});closeProductModal();">Add to Cart</button>
        <button class="close-cart" onclick="closeProductModal()">&times;</button>
    `;
    document.getElementById('modalBg').classList.add('open');
    modal.classList.add('open');
}
function closeProductModal() {
    document.getElementById('modalBg').classList.remove('open');
    document.getElementById('productModal').classList.remove('open');
}
document.getElementById('modalBg').addEventListener('click', closeProductModal);

// // Cart logic
// function addToCart(id) {
//     const item = cart.find(i => i.id === id);
//     if (item) {
//         item.qty++;
//     } else {
//         const product = products.find(p => p.id === id);
//         cart.push({ ...product, qty: 1 });
//     }
//     updateCart();
// }
// function removeFromCart(id) {
//     cart = cart.filter(item => item.id !== id);
//     updateCart();
// }
// function updateCart() {
//     const cartItems = document.getElementById('cartItems');
//     const cartCount = document.getElementById('cartCount');
//     const cartTotal = document.getElementById('cartTotal');
//     cartItems.innerHTML = '';
//     let total = 0, count = 0;
//     cart.forEach(item => {
//         total += item.price * item.qty;
//         count += item.qty;
//         const div = document.createElement('div');
//         div.className = 'cart-item';
//         div.innerHTML = `
//             <div style="display:flex;align-items:center;gap:10px;">
//                 <img src="${item.img}" alt="${item.title}" style="width:50px;height:50px;border-radius:6px;">
//                 <div>
//                     <div><b>${item.title}</b></div>
//                     <div style="font-size:0.95em;color:#666;">$${item.price.toFixed(2)} x ${item.qty}</div>
//                 </div>
//             </div>
//             <button class="close-cart" style="font-size:1.2rem;" onclick="removeFromCart(${item.id})">&times;</button>
//         `;
//         cartItems.appendChild(div);
//     });
//     cartCount.textContent = count;
//     cartTotal.textContent = total.toFixed(2);
// }

// // Cart sidebar
// const cartSidebar = document.getElementById('cartSidebar');
// document.getElementById('cartIcon').addEventListener('click', () => {
//     cartSidebar.classList.add('open');
// });
// document.getElementById('closeCart').addEventListener('click', () => {
//     cartSidebar.classList.remove('open');
// });
// // Enhanced checkout button logic
// const checkoutBtn = document.getElementById('checkoutBtn');
// if (checkoutBtn) {
//     checkoutBtn.addEventListener('click', function(e) {
//         if (cart.length === 0) {
//             e.preventDefault();
//             alert('Your cart is empty! Please add products before checking out.');
//             cartSidebar.classList.remove('open');
//             return false;
//         }
//         cartSidebar.classList.remove('open');
//         // Cart will persist due to localStorage
//     });
// }
// // Load cart from localStorage on page load
// if (localStorage.getItem('bazaar_cart')) {
//     try {
//         const storedCart = JSON.parse(localStorage.getItem('bazaar_cart'));
//         if (Array.isArray(storedCart)) {
//             cart = storedCart;
//         }
//     } catch (e) {}
//     updateCart();
// }

// // Initial render
// renderProducts();
// updateCart();

// Show Admin nav if logged in
function updateAdminNav() {
    const adminNavItem = document.getElementById('adminNavItem');
    const ordersNavItem = document.getElementById('ordersNavItem');
    if (adminNavItem) {
        if (localStorage.getItem('bazaar_admin')) {
            adminNavItem.style.display = '';
        } else {
            adminNavItem.style.display = 'none';
        }
    }
    if (ordersNavItem) {
        if (localStorage.getItem('bazaar_user')) {
            ordersNavItem.style.display = '';
        } else {
            ordersNavItem.style.display = 'none';
        }
    }
}
updateAdminNav();
window.addEventListener('storage', updateAdminNav);

// Enhance form input attractiveness
function enhanceInputs() {
    const inputs = document.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.style.borderColor = '#e4b363';
            this.style.boxShadow = '0 0 4px #e4b36355';
        });
        input.addEventListener('blur', function() {
            this.style.borderColor = '';
            this.style.boxShadow = '';
        });
    });
}
window.addEventListener('DOMContentLoaded', enhanceInputs);

// User login/register modal logic
function showUserModal(show, mode) {
    const modalBg = document.getElementById('userModalBg');
    const modal = document.getElementById('userModal');
    const mainContent = document.getElementById('mainContent');
    if (show) {
        modalBg.classList.add('open');
        modal.style.display = 'block';
        mainContent.style.display = 'none';
        if (mode === 'register') {
            document.getElementById('loginForm').style.display = 'none';
            document.getElementById('registerForm').style.display = '';
            document.getElementById('modalTitle').textContent = 'Register';
            document.getElementById('loginPrompt').style.display = 'none';
            document.getElementById('registerPrompt').style.display = '';
        } else {
            document.getElementById('loginForm').style.display = '';
            document.getElementById('registerForm').style.display = 'none';
            document.getElementById('modalTitle').textContent = 'Login';
            document.getElementById('loginPrompt').style.display = '';
            document.getElementById('registerPrompt').style.display = 'none';
        }
    } else {
        modalBg.classList.remove('open');
        modal.style.display = 'none';
        mainContent.style.display = '';
    }
    document.getElementById('userModalError').textContent = '';
}
function isUserLoggedIn() {
    return !!localStorage.getItem('bazaar_user');
}
function setUser(username) {
    localStorage.setItem('bazaar_user', username);
}
function logoutUser() {
    localStorage.removeItem('bazaar_user');
    location.reload();
}
// On page load
window.addEventListener('DOMContentLoaded', () => {
    // Show login/register modal if not logged in
    if (!isUserLoggedIn()) {
        showUserModal(true, 'login');
    } else {
        showUserModal(false);
    }
    // Modal switch logic
    document.getElementById('showRegister').onclick = function(e) {
        e.preventDefault();
        showUserModal(true, 'register');
    };
    document.getElementById('showLogin').onclick = function(e) {
        e.preventDefault();
        showUserModal(true, 'login');
    };
    // Login form
    document.getElementById('loginForm').onsubmit = function(e) {
        e.preventDefault();
        const username = document.getElementById('loginUsername').value;
        const password = document.getElementById('loginPassword').value;
        const users = JSON.parse(localStorage.getItem('bazaar_users') || '{}');
        if (users[username] && users[username] === password) {
            setUser(username);
            showUserModal(false);
        } else {
            document.getElementById('userModalError').textContent = 'Invalid username or password!';
        }
    };
    // Register form
    document.getElementById('registerForm').onsubmit = function(e) {
        e.preventDefault();
        const username = document.getElementById('registerUsername').value;
        const password = document.getElementById('registerPassword').value;
        let users = JSON.parse(localStorage.getItem('bazaar_users') || '{}');
        if (users[username]) {
            document.getElementById('userModalError').textContent = 'Username already exists!';
            return;
        }
        users[username] = password;
        localStorage.setItem('bazaar_users', JSON.stringify(users));
        setUser(username);
        showUserModal(false);
    };
    // Add logout to nav if logged in
    if (isUserLoggedIn()) {
        const navLinks = document.querySelector('.nav-links');
        if (navLinks && !document.getElementById('logoutNavItem')) {
            const li = document.createElement('li');
            li.id = 'logoutNavItem';
            const a = document.createElement('a');
            a.href = '#';
            a.textContent = 'Logout';
            a.onclick = (e) => { e.preventDefault(); logoutUser(); };
            li.appendChild(a);
            navLinks.appendChild(li);
        }
    }
});

// Expose functions for inline onclick
window.addToCart = addToCart;
window.removeFromCart = removeFromCart;
window.closeProductModal = closeProductModal;

// Checkout logic
if (window.location.pathname.endsWith('checkout.html')) {
    const checkoutForm = document.querySelector('.checkout-form');
    const mainSection = document.querySelector('.checkout-section');
    if (checkoutForm) {
        checkoutForm.onsubmit = function(e) {
            e.preventDefault();
            // Gather user info
            const name = checkoutForm.querySelector('input[type="text"]').value;
            const email = checkoutForm.querySelector('input[type="email"]').value;
            const address = checkoutForm.querySelector('input[type="text"]:nth-of-type(2)').value;
            const payment = checkoutForm.querySelector('select').value;
            // Get cart
            let cartData = JSON.parse(localStorage.getItem('bazaar_cart') || '[]');
            // Save order
            let orders = JSON.parse(localStorage.getItem('bazaar_orders') || '[]');
            const order = {
                id: Date.now(),
                user: localStorage.getItem('bazaar_user'),
                name, email, address, payment,
                items: cartData,
                total: cartData.reduce((sum, item) => sum + item.price * item.qty, 0)
            };
            orders.push(order);
            localStorage.setItem('bazaar_orders', JSON.stringify(orders));
            // Clear cart
            localStorage.setItem('bazaar_cart', '[]');
            // Redirect to confirmation page
            window.location.href = `order-confirmation.html?orderId=${order.id}`;
        };
    }
}
// Save cart state to localStorage whenever cart changes
function saveCart() {
    localStorage.setItem('bazaar_cart', JSON.stringify(cart));
}
// Update updateCart to save cart
const originalUpdateCart = updateCart;
updateCart = function() {
    originalUpdateCart.apply(this, arguments);
    saveCart();
};
