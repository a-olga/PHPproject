<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\helpers\HtmlPurifier;
use yii\widgets\DetailView;
use common\widgets\Slider;
use common\models\Image;
?>

<?php

    /* @var $this yii\web\View */
    /* @var $model common\models\Product */

    $this->title = $model->title;
    $this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1 class = "item-title"><?= Html::encode($this->title) ?></h1>
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

    <?php
    function getImagesForSlider($model){
        if($model->getImages()->all()){
            $itemArray = [];
            foreach ($model->getImages()->all() as $image) {
                array_push($itemArray, ['content' => Html::img($image->link)]);
            }
            return $itemArray;
        } else {
            return [['content' => Html::img(Image::NO_IMAGE_URL)]];
        }
    }
    ?>


    <?= Slider::widget([
        'items'=>  getImagesForSlider($model),
        'options' => [
            'data-interval' => true,
            ],
        ]);
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'description:text',
        ]
    ])
    ?>
</div>


