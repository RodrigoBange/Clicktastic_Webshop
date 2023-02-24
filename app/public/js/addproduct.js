function addProduct($button_id) {
    // Get numbers of button ID
    var $id = $button_id.match(/\d/g).join("");
    var $price = document.getElementById("price-" + $id).innerText.replace('€', '').replace('&euro;', '');
    var $quantity = 1;
    var $cartcount = document.getElementById("cartcount");

    $.ajax({
        url: '/cart/addtocart',
        data: {product_id : $id, product_quantity : $quantity, product_price : $price},
        success: function(reply) {
            $cartcount.textContent = reply;
        },
        error: function(req, status, error) {
            console.log( 'Something went wrong: ', status, error, req );
        }
    });
}

function addProductWithQuantity($button_id) {
    // Get numbers of button ID
    var $id = $button_id.match(/\d/g).join("");
    var $price = document.getElementById("price").innerText.replace('€', '').replace('&euro;', '');
    var $quantity = document.getElementById("inputQuantity").value;
    var $cartcount = document.getElementById("cartcount");

    $.ajax({
        url: '/cart/addtocart',
        data: {product_id : $id, product_quantity : $quantity, product_price : $price},
        success: function(reply) {
            $cartcount.textContent = reply;

            // In case of input abuse
            if ($quantity > 10) {
                document.getElementById("inputQuantity").value = 10;
            }
        },
        error: function(req, status, error) {
            console.log( 'Something went wrong: ', status, error, req );
        }
    });
}