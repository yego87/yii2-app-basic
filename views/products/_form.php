<?php

use app\models\Category;
use app\models\Tag;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'price')->textInput() ?>

            <?= $form->field($model, 'quantity')->textInput() ?>

            <?= $form->field($model, 'imageFile')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            ]) ?>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
