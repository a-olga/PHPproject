<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = 'Update Product: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    foreach($model->getImages()->all() as $image){
        echo '<div class = "view-image">' . Html::img($image->link,['id' => $image->id, 'class' => 'product-image', 'style'=>'width: 70px; height: auto']);
        echo Html::button('Delete', ['id' => $image->id, 'class' => 'delete-image-button btn btn-default']). '</div>';
    }
    ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
