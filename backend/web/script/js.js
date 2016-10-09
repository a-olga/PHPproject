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

    $('.delete-image-button').on('click', function() {
        if (confirm('Do you really want to delete this image?')){
            var imageId = $(this).attr('id');
            var imageDiv = $(this).closest('div');
            $.ajax({
                type: "POST",
                url: "index.php?r=product/delete-image",
                data: { id: imageId}
            }).done(function() {
                imageDiv.remove();
            }).fail(function () {
                alert('Request is NOT completed');
            });
        }
    });
});
