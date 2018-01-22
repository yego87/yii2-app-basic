<?php

use app\widgets\ProductsWidget;

/* @var $this \yii\web\View */

/* @var $content string */

?>
<?php $this->beginContent('@app/views/layouts/layout.php'); ?>
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-8">
            <?= $content ?>
        </div>
    </div>
<?php $this->endContent() ?>
