<?php

namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\Product;
use app\models\search\ProductSearch;
use app\models\Tag;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CatalogController extends Controller
{
    public $layout = 'catalog';

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
     * @param $id
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionProduct($id)
    {
        $product = $this->findProductModel($id);

        $dataProvider = new ActiveDataProvider([
            'query' => Product::find()->orderBy(['id' => SORT_ASC]),
        ]);

        return $this->render('product', [
            'product' => $product,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $model = $this->findProductModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Buying an existing Product model.
     * If buying is successful, the browser will be redirected to the 'index' page.
     *
     * @return mixed
     * @throws NotFoundHttpException
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionBuy()
    {
        $id = Yii::$app->user->identity->getId();
        $model = $this->findProductModel($id);

        if ($id !== $model->created_by && !Yii::$app->user->isGuest) {
            $model->buy();
            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'You can\'t buy from yourself!');
            return $this->redirect(['index']);
        }
    }

    /**
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findProductModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
