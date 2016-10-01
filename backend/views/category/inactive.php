<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

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
            'name',
            'parent_id',

            [
                'label'=> '',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::button('Restore', ['id' => $model->id, 'class' => 'restore-category-button btn btn-default']);

                },
            ],
            
            ['class' => 'yii\grid\ActionColumnForInactive'],
        ],
    ]); ?>
</div>
