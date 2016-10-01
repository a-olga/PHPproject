<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Images';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="alert alert-info">
        <strong>Info!</strong> Here are deleted <?=$this->title?>.
    </div>
    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success'])?>
        <?= Html::a('Show active', ['index'], ['class' => 'btn btn-primary'])?>

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
            'link',

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
            
            'product_id',
            
            [
                'label'=>'Image',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::img($model->link,['style'=>'width: 70px; height: auto']);},
            ],

            [
                'label'=> '',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::button('Restore', ['id' => $model->id, 'class' => 'restore-image-button btn btn-default']);
                },
            ],

            ['class' => 'yii\grid\ActionColumnForInactive'],
        ],
    ]); ?>
</div>
