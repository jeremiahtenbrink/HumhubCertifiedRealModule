<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model humhub\modules\certified\models\AwaitingCertification */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="awaiting-certification-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'his_picture_url')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'file_her' )->fileInput(); ?>

    <?= $form->field($model, 'her_picture_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_him' )->fileInput(); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
