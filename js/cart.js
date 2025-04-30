$(document).ready(function () {
    function updateCartUI() {
        $.get("cart-handler.php?action=fetch", function (data) {
            const cart = JSON.parse(data);
            let html = "";
            let total = 0;
            let count = 0;

            cart.forEach(item => {
                html += `
            <div class="cart-item d-flex justify-content-between mb-2">
              <div>
                <strong>${item.name}</strong><br>
                ৳${item.price} x ${item.quantity}
              </div>
              <div>
                <button class="btn btn-sm btn-danger remove-btn" data-id="${item.id}">x</button>
              </div>
            </div>`;
                total += item.price * item.quantity;
                count += item.quantity;
            });

            $("#cartitem").html(html);
            $("#total").text(total.toFixed(2));
            $("#count").text(count);
        });
    }

    $(document).on("click", ".add-to-cart", function () {
        const id = $(this).data("id");
        $.post("cart-handler.php", { action: "add", id }, updateCartUI);
    });

    $(document).on("click", ".remove-btn", function () {
        const id = $(this).data("id");
        $.post("cart-handler.php", { action: "remove", id }, updateCartUI);
    });

    updateCartUI(); // Load on page load
});
