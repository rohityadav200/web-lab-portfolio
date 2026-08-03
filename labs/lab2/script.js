// ==============================
// SHOP EASY CART
// Reads product details automatically
// ==============================

// Navbar Elements
const cartBtn = document.getElementById("cart-btn");
const cartPanel = document.getElementById("cart-panel");
const closeCart = document.getElementById("close-cart");

// Cart Elements
const cartItems = document.getElementById("cart-items");
const cartTotal = document.getElementById("cart-total");
const cartCount = document.getElementById("cart-count");

// All Buy Buttons
const addCartButtons = document.querySelectorAll(".add-cart");

// Load Cart
let cart = JSON.parse(localStorage.getItem("cart")) || [];

// ==============================
// OPEN CART
// ==============================

if (cartBtn) {

    cartBtn.addEventListener("click", function (e) {

        e.preventDefault();

        cartPanel.classList.add("active");

    });

}

// ==============================
// CLOSE CART
// ==============================

if (closeCart) {

    closeCart.addEventListener("click", function () {

        cartPanel.classList.remove("active");

    });

}

// ==============================
// ADD PRODUCT
// ==============================

addCartButtons.forEach(button => {

    button.addEventListener("click", function () {

        const card = this.closest(".product-card");

        const name = card.querySelector("h3").textContent;

        const priceText = card.querySelector(".price").textContent;

        const price = Number(priceText.replace(/[₹,]/g, ""));

        const existing = cart.find(item => item.name === name);

        if (existing) {

            existing.quantity++;

        } else {

            cart.push({

                name: name,

                price: price,

                quantity: 1

            });

        }

        updateCart();

        cartPanel.classList.add("active");

    });

});

// ==============================
// UPDATE CART
// ==============================

function updateCart() {

    if (!cartItems) return;

    cartItems.innerHTML = "";

    let total = 0;

    let count = 0;

    if (cart.length === 0) {

        cartItems.innerHTML = "<p>Your cart is empty.</p>";

    }

    cart.forEach((item, index) => {

        total += item.price * item.quantity;

        count += item.quantity;

        cartItems.innerHTML += `

        <div class="cart-item">

            <div>

                <h4>${item.name}</h4>

                <p>₹${item.price.toLocaleString()}</p>

            </div>

            <div class="qty-box">

                <button onclick="decreaseQty(${index})">−</button>

                <span>${item.quantity}</span>

                <button onclick="increaseQty(${index})">+</button>

            </div>

            <button class="delete-btn"

                onclick="removeItem(${index})">

                🗑

            </button>

        </div>

        `;

    });

    cartTotal.textContent = total.toLocaleString();

    cartCount.textContent = count;

    localStorage.setItem("cart", JSON.stringify(cart));

}

// ==============================
// INCREASE
// ==============================

function increaseQty(index) {

    cart[index].quantity++;

    updateCart();

}

// ==============================
// DECREASE
// ==============================

function decreaseQty(index) {

    cart[index].quantity--;

    if (cart[index].quantity <= 0) {

        cart.splice(index, 1);

    }

    updateCart();

}

// ==============================
// REMOVE
// ==============================

function removeItem(index) {

    cart.splice(index, 1);

    updateCart();

}

// ==============================

updateCart();