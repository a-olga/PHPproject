<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use common\models\Image;
?>
<div class = "product-item-inner">
    <?php

    if ($model->getImages()->one()){
        $imageLink = $model->getImages()->one()->link;
    } else {
        $imageLink = Image::NO_IMAGE_URL;
    }
    echo Html::img($imageLink, ['id' => $model->id, 'class' => 'product-image img-responsive',]);
    ?>

    <h3>
        <?= Html::a($model->title, Url::to(['product/item-view', 'id' => $model->id])) ?>
    </h3>

    <div class = "product-description">
        <?= HtmlPurifier::process($model->description) ?>
    </div>

    <div class = "product-price">
        <?= HtmlPurifier::process(
            Html::tag('span', '', ['class' => 'glyphicon glyphicon-tags'])
            . '&nbsp; ' . $model->price/100 . ' ₴')
        ?>
    </div>
        <?= Html::button(
            Html::tag('span', '', ['class' => 'glyphicon glyphicon-shopping-cart'])
            .' Add to cart', ['id' => $model->id, 'class' => 'add-to-cart btn btn-success']);
        ?>
</div>
