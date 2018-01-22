<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Catalog';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-index">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?= Yii::$app->session->getFlash('error'); ?>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "{items}\n{pager}",
        'itemView' => '_item',
    ]); ?>
</div>
