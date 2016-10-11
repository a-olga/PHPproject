<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use frontend\components\Cart;
use common\models\Product;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use common\models\Image;
?>
<div class = "cart-wrapper">
<?php
if (Cart::getProductsId()) {
    foreach (Cart::getProductsId() as $productId) {
        $model = Product::findOne(['id' => $productId]);?>
        <div class = "item-container">
            <div class = "product-image-container">
            <?php
            if ($model->getImages()->one()) {
                $imageLink = $model->getImages()->one()->link;
            } else {
                $imageLink = Image::NO_IMAGE_URL;
            }
            echo Html::img($imageLink, ['id' => $model->id, 'class' => 'cart-product-image img-responsive',]);
            ?>
            </div>
            <div class = "description-container">
                <div class="cart-product-title">
                    <?= Html::a($model->title, Url::to(['product/item-view', 'id' => $model->id])) ?>
                </div>

                <div class="product-price">
                    <?= HtmlPurifier::process(
                        Html::tag('span', '', ['class' => 'glyphicon glyphicon-tags'])
                        . '&nbsp; ' . $model->price / 100 . ' ₴')
                    ?>
                </div>
            </div>

            <?= Html::button(Html::tag('span', '', ['class' => 'glyphicon glyphicon-remove-circle'])
                .'', ['id' =>$productId, 'class' => 'delete-from-cart']) ?>

        </div>
        <?php
    }
        echo Html::button('Make an order', ['class' => 'make-order btn btn-success']);
} else {
    echo Html::encode('Your cart is empty');
}
?>
</div>


