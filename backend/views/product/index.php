<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
//var_dump($dataProvider); exit;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Show inactive', ['show-inactive'], ['class' => 'btn btn-warning'])?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'style' => 'max-width: 100%;'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',

            'category_id',

//            [
//                'label'=>'Category',
//                'format' => 'raw',
//                'value' => function($model) {
//                    return Html::encode($model->getCategory()->one()->name);
//                }
//            ],

            'description:text',

            [
                'label'=>'Created at',
                'value' => function($model) {
                    return  date("Y-m-d H:i:s", $model->created_at);
                },
            ],

            [
                'label'=>'Updated at',
                'value' => function($model) {
                    return  date("Y-m-d H:i:s", $model->updated_at);
                },
            ],

            'quantity',

            [
                'label'=>'Price',
                'value' => function($model) {
                    return  $model->price/100;
                },
            ],

            [
                'label'=>'Number of photos',
                'value' => function($model) {
                    return Html::encode($model->getImages()->count());
                }
            ],

//            [
//                'label'=> '',
//                'format' => 'raw',
//                'value' => function($model) {
////                    return Html::button('Find images', ['id' => $model->id, 'class' => 'show-images-button btn btn-default']);
//                    return Html::a('Find images', Url::to(['image/index-filtered', 'product_id' => $model->id]), ['class' => 'btn btn-success']);
//
//                },
//            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
