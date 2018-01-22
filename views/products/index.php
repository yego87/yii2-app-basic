<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add product', ['create'], ['class' => 'btn btn-success']) ?>
        <?=  $model->id ? DetailView::widget([
            'model' => $model,
            'attributes' => [
                'content',
                'price',
                [
                    'attribute' => 'image',
                    'value' => Yii::$app->homeUrl . 'images/' . $model->imageFile,
                    'format' => ['image',['width'=>'100','height'=>'100']],
                ],
            ]
        ]) : 'You have not active products in sail'?>
    </p>
</div>
