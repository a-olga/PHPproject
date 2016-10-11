<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\CategorySearch;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class CategoryController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex($id = 0)
    {
        $this->view->title = 'Category List';
        return $this->render('index', ['categoryId' => $id]);
    }
}