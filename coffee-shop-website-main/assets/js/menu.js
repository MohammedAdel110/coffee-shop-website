const addCartButtons = document.querySelectorAll(".add-cart");
const cartContent = document.querySelector(".cart-content");
const cartTotal = document.querySelector(".total-price");

const cartIcon = document.getElementById("cart-btn");
const cart = document.querySelector(".header .cart");

cartIcon.addEventListener("click", () => {
  cart.classList.toggle("active");
});

let totalPrice = 0;


// Add products to the cart
addCartButtons.forEach((button) => {
  button.addEventListener("click", (event) => {
    const productElement = event.target.closest(".box");
    const productImg = productElement.querySelector("img").src;
    const productTitle = productElement.querySelector(".product-title").textContent;
    const productPrice = parseFloat(productElement.querySelector(".price").textContent.replace("LE", ""));

    // Check if the item is already in the cart
    const existingCartItem = Array.from(cartContent.children).find(
      (item) => item.querySelector(".cart-item-title").textContent === productTitle
    );

    if (existingCartItem) {
      alert("This item is already in your  cart.");
      return;
    }

    // Add the item to the cart
    const cartItemHTML = `
      <div class="cart-item">
        <img src="${productImg}" alt="${productTitle}" class="cart-item-img">
        <div class="content">
          <h3 class="cart-item-title">${productTitle}</h3>
          <div class="price" data-price="${productPrice}">${productPrice.toFixed(2)}LE</div>
          <div class="quantity">
            <button class="decrease">-</button>
            <input type="number" value="1" min="1">
            <button class="increase">+</button>
          </div>
        </div>
        <i class="fas fa-times remove-item"></i>
      </div>
    `;
    cartContent.innerHTML += cartItemHTML;

    // Add event listeners to quantity buttons and remove button
    updateRemoveButtons();
    updateQuantityButtons();

    // Update the total price
    updateTotalPrice();
  });
});

// Update the total price based on cart items
function updateTotalPrice() {
  totalPrice = 0; // Reset total price
  const cartItems = document.querySelectorAll(".cart-item");
  cartItems.forEach((item) => {
    const priceElement = item.querySelector(".price");
    const productPrice = parseFloat(priceElement.dataset.price); // Use `data-price` for the base price
    const quantity = parseInt(item.querySelector("input").value);
    totalPrice += productPrice * quantity;
  });
  cartTotal.textContent = `${totalPrice.toFixed(2)} LE`;
}

// Handle quantity changes
function updateQuantityButtons() {
  const cartItems = document.querySelectorAll(".cart-item");
  cartItems.forEach((item) => {
    const decreaseBtn = item.querySelector(".decrease");
    const increaseBtn = item.querySelector(".increase");
    const quantityInput = item.querySelector("input");

    decreaseBtn.addEventListener("click", () => {
      let quantity = parseInt(quantityInput.value);
      if (quantity > 1) {
        quantity -= 1;
        quantityInput.value = quantity;
        updateTotalPrice();
      }
    });

    increaseBtn.addEventListener("click", () => {
      let quantity = parseInt(quantityInput.value);
      quantity += 1;
      quantityInput.value = quantity;
      updateTotalPrice();
    });

    // Update total price when quantity input is changed directly
    quantityInput.addEventListener("change", () => {
      if (quantityInput.value < 1) {
        quantityInput.value = 1; // Prevent negative or zero values
      }
      updateTotalPrice();
    });
  });
}

// Handle removal of cart items
function updateRemoveButtons() {
  const removeButtons = document.querySelectorAll(".remove-item");
  removeButtons.forEach((button) => {
    button.addEventListener("click", (event) => {
      const cartItem = event.target.closest(".cart-item");
      cartItem.remove();
      updateTotalPrice();
    });
  });
}

// Handle the checkout button click
const checkoutButton = document.querySelector(".btn-buy");

checkoutButton.addEventListener("click", () => {
  if (cartContent.children.length === 0) {
    alert("Your cart is empty!");
    return;
  }

  // Gather all cart items
  const cartItems = [];
  document.querySelectorAll(".cart-item").forEach((item) => {
    const productTitle = item.querySelector(".cart-item-title").textContent;
    const quantity = parseInt(item.querySelector("input").value);
    const price = parseFloat(item.querySelector(".price").dataset.price);

    cartItems.push({ product: productTitle, quantity, price });
  });

  // Send the data to the server using fetch (AJAX)
  fetch("checkout.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(cartItems), // Send the cart data as JSON
  })
  .then((response) => response.json())
  .then((data) => {
    if (data.success) {
      alert("Your order has been placed successfully!");
      // Optionally clear the cart after successful order
      cartContent.innerHTML = '';
      updateTotalPrice();
    } else {
      alert("Failed to place your order.");
    }
  })
  .catch((error) => {
    console.log("Error:", error);
    alert("There was an error processing your order. Please try again.");
  });
});
