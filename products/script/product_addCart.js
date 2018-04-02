$(document).ready(function () {
    $(".btn#addCart").click(function () {
        $.ajax({
            type: "POST",
            cache: false,
            url: 'product_addCart.php',
            data: {
                company_id: company_id,
                prod_id: prod_id,
                prod_name: prod_name,
                prod_description: prod_description,
                prod_image_url: prod_image_url,
                prod_price: prod_price
            },
            success: function (result) {
                console.log(result)
            }
        });
    });
});
