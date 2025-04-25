document.addEventListener("DOMContentLoaded", function () {
    loadCartItems();
});

function loadCartItems() {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    let cartContainer = document.getElementById("cart-items");
    let cartTotal = document.getElementById("cart-total");
    let cartCount = document.getElementById("cart-count");

    cartContainer.innerHTML = "";
    let totalPrice = 0;
    
    cart.forEach((item, index) => {
        let itemPrice = item.price * item.quantity;
        totalPrice += itemPrice;

        cartContainer.innerHTML += `
            <div class="cart-item">
                <img src="${item.image}" alt="${item.name}">
                <div class="item-details">
                    <h3>${item.name}</h3>
                    <p>Price: ₱${item.price}</p>
                    <label>Size:</label>
                    <select onchange="updateItem(${index}, 'size', this.value)">
                        <option ${item.size === 'S' ? 'selected' : ''} value="S">S</option>
                        <option ${item.size === 'M' ? 'selected' : ''} value="M">M</option>
                        <option ${item.size === 'L' ? 'selected' : ''} value="L">L</option>
                        <option ${item.size === 'XL' ? 'selected' : ''} value="XL">XL</option>
                    </select>
                    <label>Color:</label>
                    <select onchange="updateItem(${index}, 'color', this.value)">
                        <option ${item.color === 'Red' ? 'selected' : ''} value="Red">Red</option>
                        <option ${item.color === 'Blue' ? 'selected' : ''} value="Blue">Blue</option>
                        <option ${item.color === 'Black' ? 'selected' : ''} value="Black">Black</option>
                        <option ${item.color === 'White' ? 'selected' : ''} value="White">White</option>
                    </select>
                    <label>Quantity:</label>
                    <input type="number" min="1" value="${item.quantity}" onchange="updateItem(${index}, 'quantity', this.value)">
                </div>
                <div class="item-actions">
                    <button class="btn delete-btn" onclick="removeItem(${index})">Remove</button>
                </div>
            </div>
        `;
    });

    cartTotal.textContent = `₱${totalPrice}`;
    cartCount.textContent = cart.length;
}

function updateItem(index, field, value) {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    cart[index][field] = field === 'quantity' ? parseInt(value) : value;
    localStorage.setItem("cart", JSON.stringify(cart));
    loadCartItems();
}

function removeItem(index) {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    cart.splice(index, 1);
    localStorage.setItem("cart", JSON.stringify(cart));
    loadCartItems();
}
