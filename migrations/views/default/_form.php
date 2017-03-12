<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model humhub\modules\certified\models\AwaitingCertification */
/* @var $form yii\widgets\ActiveForm */
/* @var $profileType  */
?>

<div class="awaiting-certification-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php
    if ($profileType == 'male' ) {
       echo $form->field($model, 'file_him')->fileInput();
    }else if ($profileType == 'female') {
       echo $form->field($model, 'file_her')->fileInput();
    }else {
      echo  $form->field($model, 'file_him')->fileInput();
      echo  $form->field($model, 'file_her')->fileInput();
    }
    ?>

    <div class="form-group">
        <?php ?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
