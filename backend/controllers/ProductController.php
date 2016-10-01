<?php

namespace backend\controllers;

use common\models\ProductSearchInactive;
use Yii;
use common\models\Product;
use common\models\ProductSearch;
use common\models\ImageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            $model->assignImages($model);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            $model->assignImages($model);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
//        $model->deleteImages($model);   // I don't know if it is necessary
        $model->safeDelete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionInactive()
    {
        $searchModel = new ProductSearchInactive();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('inactive', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionShowInactive()
    {
        return $this->redirect(['inactive']);
    }

    public function actionRestore()
    {
        if ($id = Yii::$app->request->post('id')) {
            if ($model = Product::findOne($id)) {
                return $model->restore();
            }
        } else {
            throw new NotFoundHttpException('Something went wrong.');
        }
    }

    public function actionShowImages()
    {
//        if ($id = Yii::$app->request->post('id')) {
//            if ($model = Product::findOne($id)) {
//                //$images = $model->getImages();
//                $searchModel = new ImageSearch();
//                $dataProvider = $searchModel->searchByProductId(Yii::$app->request->queryParams, $id);
////var_dump($dataProvider); exit;
//                return $this->redirect(['image/index'], [
//                    'searchModel' => $searchModel,
//                    'dataProvider' => $dataProvider,
//                ]);
//            }
//        } else {
//            throw new NotFoundHttpException('Something went wrong.');
//        }
    }

}
