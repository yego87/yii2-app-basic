<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['index']];

$crumbs = [];
?>
<div class="catalog-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-6">
            <?= DetailView::widget([
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
            ]) ?>
            <?= GridView::widget([
                'dataProvider' => new ActiveDataProvider(['query' => $model->getOwner()]),
                'layout' => "{items}\n{pager}",
                'columns' => [
                    [
                        'attribute' => 'Phone',
                        'value' => 'phone',
                    ],
                    [
                        'attribute' => 'Email',
                        'value' => 'email',
                    ],
                ],
            ]); ?>
        </div>
        <div class="form-group">
            <?= Html::a('Buy', ['buy', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to buy this item?',
                'method' => 'post',
            ],
        ]) ?>
            <?= Yii::$app->session->getFlash('error'); ?>
        </div>

        </div>
    </div>

</div>
