<?php

namespace app\modules\admin\controllers;

use app\models\ProductImage;
use app\models\ProductImageSearch;
use app\modules\admin\models\Image;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * ProductImageController implements the CRUD actions for ProductImage model.
 */
class ProductImageController extends Controller
{
    public $layout = 'admin';

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
     * Lists all ProductImage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductImageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render(
            'index',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]
        );
    }

    /**
     * Displays a single ProductImage model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render(
            'view',
            [
                'model' => $this->findModel($id),
            ]
        );
    }

    /**
     * Finds the ProductImage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductImage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductImage::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new ProductImage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        Yii::setAlias('@img', Yii::getAlias('@webroot/img/'));
        $model = new ProductImage();
        $image = new Image();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($image, 'attachment');
            $fileName = Yii::getAlias("@img/{$model->product_id}_{$model->id}");

            $image->upload($file, $fileName);

            \yii\imagine\Image::thumbnail("{$fileName}.{$file->extension}", 100, 100)
                ->save(
                    "{$fileName}_small.{$file->extension}",
                    ['quality' => 90]
                );
            $model->url = "{$fileName}.{$file->extension}";
            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render(
            'create',
            [
                'model' => $model,
                'image' => $image,
            ]
        );
    }

    /**
     * Deletes an existing ProductImage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
}
