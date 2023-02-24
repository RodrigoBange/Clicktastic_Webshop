function editQuantity($button) {
    // Get number of ID and new quantity
    const $id = $button.id.match(/\d/g).join("");
    const $quantity = $button.value;

    const $cartcount = document.getElementById("cartcount");
    const $items = document.getElementById("items");
    const $summary = document.getElementById("summary");
    const $subtotal = document.getElementById("subtotal");
    const $total = document.getElementById("total");
    const $shipping = document.getElementById("shipping");
    let $shippingcost = 5.99;

    $.ajax({
        url: '/cart/editcart',
        data: {product_id : $id, product_quantity : $quantity},
        success: function(reply) {
            $reply = JSON.parse(reply);

            // Check if product quantity reached 0
            if ($reply.deleteProduct) {
                var $product = document.getElementById("product-" + $id);
                $product.remove();

                // Check if there are no items left
                if ($reply.cartEmpty === true) {
                    $shippingcost = 0.00;
                    $shipping.textContent = "\u20ac " + $shippingcost.toFixed(2);

                    // Disable checkout
                    if (!$summary.classList.contains("collapse")) {
                        $summary.classList.add("collapse");
                    }

                    // Display message
                    $items.insertAdjacentHTML('afterbegin',
                        '<h5>Your cart is currently empty.</h5>' +
                        '<a href="/shop/products" class="btn btn-theme text-white btn-lg btn-block">' +
                        'Browse products</a>');
                }
            }
            // Set pricing
            $cartcount.textContent = $reply.totalQuantity;
            $subtotal.textContent = "\u20ac " + $reply.subTotal.toFixed(2);
            $total.textContent = "\u20ac " + ($reply.subTotal + $shippingcost).toFixed(2);

            // In case of input abuse
            if ($quantity > 10) {
                $button.value = 10;
            }
        },
        error: function(req, status, error) {
            console.log( 'Something went wrong: ', status, error, req );
        }
    });
}