<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $product app\models\Product */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';

$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['index']];

$crumbs = [];
$crumbs[] = ['label' => $product->name, 'url' => ['product', 'id' => $product->id]];

$this->params['breadcrumbs'] = array_merge($this->params['breadcrumbs'], array_reverse($crumbs));

$this->params['breadcrumbs'][] = $this->title;
$this->params['product'] = $product;
?>
<div class="catalog-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "{items}\n{pager}",
        'itemView' => '_item',
    ]); ?>
</div>
