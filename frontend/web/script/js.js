 $(document).ready(function() {
     $('.add-to-cart').on('click', function() {
         var productId = $(this).attr('id');
         $.ajax({
             type: "POST",
             dataType: 'json',
             url: "index.php?r=cart/add-in-cart",
             data: { product_id: productId},
             success: function(data){
                 alert('You have successfully added the product to your cart!');
                 $('.cart-status').html(data.cartStatus);
                 //$('.add-to-cart').removeClass('btn btn-success').html('The product is already in cart'); //('The product is already in cart');
                 // $('.add-to-cart').html('The product is already in cart');
             }
         });
     });
     $('.delete-from-cart').on('click', function() {
         if (confirm('Do you really want to delete this item from your cart?')) {
             var productId = $(this).attr('id');
             $.ajax({
                 type: "POST",
                 dataType: 'json',
                 url: "index.php?r=cart/delete-from-cart",
                 data: {product_id: productId},
                 success: function (data) {
                     alert('Hello');
                     $('.cart-status').html(data.cartStatus);
                 }
             });
         }
     });
 });