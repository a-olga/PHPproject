 $(document).ready(function() {
     $('.add-to-cart').on('click', function() {
         var productId = $(this).attr('id');
         $.ajax({
             type: "POST",
             dataType: 'json',
             url: "index.php?r=cart/add-in-cart",
             data: { product_id: productId},
             success: function(data){
                 alert('You have added the product to you cart!');
                 $('.cart-status').html(data.cartStatus);
             }
         });
     });
 });