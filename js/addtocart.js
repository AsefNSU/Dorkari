document.addEventListener("DOMContentLoaded", function () {
    console.log("DOM loaded, binding buttons...");

    const addToCartButtons = document.querySelectorAll(".add-to-cart");
    console.log("Found", addToCartButtons.length, "Add buttons");

    addToCartButtons.forEach(button => {
        button.addEventListener("click", function () {
            const name = this.getAttribute("data-name");
            const price = parseFloat(this.getAttribute("data-price"));
            const image = this.getAttribute("data-image");

            console.log("Clicked Add:", name, price, image);

            const item = { name, price, image, quantity: 1 };
            let cart = JSON.parse(localStorage.getItem("cart")) || [];

            const existingItemIndex = cart.findIndex(i => i.name === name);

            if (existingItemIndex !== -1) {
                cart[existingItemIndex].quantity += 1;
            } else {
                cart.push(item);
            }

            localStorage.setItem("cart", JSON.stringify(cart));
            updateCartIcon();
            updateCartDropdown();
        });
    });

    updateCartIcon();
    updateCartDropdown();

    function updateCartIcon() {
        const cart = JSON.parse(localStorage.getItem("cart")) || [];
        const count = cart.reduce((total, item) => total + item.quantity, 0);
        const countElement = document.getElementById("count");
        if (countElement) {
            countElement.textContent = count;
        }
    }

    function updateCartDropdown() {
        const cart = JSON.parse(localStorage.getItem("cart")) || [];
        const cartDropdown = document.getElementById("cartitem");
        const totalElement = document.getElementById("total");

        if (!cartDropdown || !totalElement) return;

        if (cart.length === 0) {
            cartDropdown.innerHTML = "<li>Your cart is empty.</li>";
            totalElement.textContent = "0.00";
            return;
        }

        cartDropdown.innerHTML = "";
        let total = 0;

        cart.forEach(item => {
            const li = document.createElement("li");
            li.innerHTML = `
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                    <img src="images/${item.image}" style="width: 40px; height: 40px; object-fit: cover; border-radius: 5px;">
                    <div>
                        <strong>${item.name}</strong><br>
                        Qty: ${item.quantity} × ${item.price.toFixed(2)} BDT
                    </div>
                </div>
            `;
            cartDropdown.appendChild(li);
            total += item.quantity * item.price;
        });

        totalElement.textContent = total.toFixed(2);
    }
});
