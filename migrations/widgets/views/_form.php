<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $profileType string */
/* @var $model humhub\modules\certified\models\AwaitingCertification */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="awaiting-certification-form">

    <?php $form = ActiveForm::begin(['action' =>['/certified/awaiting-certification/create'], 'options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php if($profileType == 'male'){
     echo $form->field($model, 'hisImage')->fileInput();
    }else if ($profileType == 'female'){
        echo $form->field($model, 'herImage')->fileInput();
    }else {
        echo $form->field($model, 'hisImage')->fileInput();
        echo $form->field($model, 'herImage')->fileInput();
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
