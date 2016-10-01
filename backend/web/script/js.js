$(document).ready(function() {
    $('.restore-category-button').on('click', function() {
        var category = $(this);
        $.ajax({
            type: "POST",
            url: "index.php?r=category/restore",
            data: { id: category.attr('id')}
        }).done(function() {
            category.closest('tr').remove();
        }).fail(function () {
            alert('Request is NOT completed');
        });
    });

    $('.restore-image-button').on('click', function() {
        var image = $(this);
        $.ajax({
            type: "POST",
            url: "index.php?r=image/restore",
            data: { id: image.attr('id')}
        }).done(function() {
            image.closest('tr').remove();
        }).fail(function () {
            alert('Request is NOT completed');
        });
    });

    $('.restore-product-button').on('click', function() {
        var product = $(this);
        $.ajax({
            type: "POST",
            url: "index.php?r=product/restore",
            data: { id: product.attr('id')}
        }).done(function() {
            product.closest('tr').remove();
        }).fail(function () {
            alert('Request is NOT completed');
        });
    });

    // $('.show-images-button').on('click', function() {
    //     var productId = $(this).attr('id');
    //     $.ajax({
    //         type: "POST",
    //         url: "index.php?r=product/show-images",
    //         data: { id: productId}
    //      }); //.done(function() {
    //     //     // product.closest('tr').remove();
    //     // }).fail(function () {
    //     //     alert('Request is NOT completed');
    //     // });
    // });
});
