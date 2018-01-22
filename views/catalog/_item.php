<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <span class="pull-right"><?= $model->price ?></span>
        <?= Html::a(Html::encode($model->name), ['view', 'id' => $model->id]) ?>
    </div>
    <div class="panel-body">
        <p> <?= $model->imageFile ? Html::a(Html::img(Yii::$app->homeUrl . 'images/' . $model->imageFile,
                ['width' => '60px']), ['catalog/view', 'id' => $model->id]) : '' ?>
        <?= Yii::$app->formatter->asNtext($model->content) ?> </p>
        <div class="form-group">
            <?= Html::a('Buy', ['buy', 'id' => $model->id], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => 'Are you sure you want to buy this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>
</div>