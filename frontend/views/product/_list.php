<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
?>
<div class = "product-item-inner">
    <?php

    if ($image = $model->getImages()->one()){
        echo Html::img($image->link, ['id' => $model->id, 'class' => 'product-image img-responsive',]);
    } else {
        echo Html::img('../../backend/web/uploads/no_image.png', ['id' => $model->id, 'class' => 'img-responsive product-image']);
    }
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
            .' Add to cart', ['class' => 'add-to-cart btn btn-success']);
        ?>
</div>
