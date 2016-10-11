<?php

use yii\helpers\Html;
use common\models\Category;
use yii\helpers\Url;

//echo $categoryId;
$categoryList = Category::getList();

foreach ($categoryList[$categoryId] as $categoryItem){
    if(Category::isParent($categoryItem['id'])){
        echo '<div class = "col-md-4 category-menu-item">'
            . Html::a($categoryItem['name'], [
                'category/index', 'id' => $categoryItem['id']])
            . '</div>';
    } else {
        echo '<div class = "col-md-4 category-menu-item">'
            . Html::a($categoryItem['name'], Url::to([
                'product/index',
                "ProductSearch" =>
                    ['category_id' => $categoryItem['id']]

            ]))
            . '</div>';
    }
}