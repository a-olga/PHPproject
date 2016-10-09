<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'category_id',
            'description:text',
            'created_at',
            'updated_at',
            'quantity',
            'price',
        ],
    ]) ?>

    <?php
    foreach($model->getImages()->all() as $image){?>
        <div class = "view-image">
            <?= Html::img($image->link,['id' => $image->id, 'class' => 'product-image', 'style'=>'width: 70px; height: auto'])?>
            <?= Html::button('Delete', ['id' => $image->id, 'class' => 'delete-image-button btn btn-default'])?>
        </div>
        <?php
    }
    ?>


</div>
