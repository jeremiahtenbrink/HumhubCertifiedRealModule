<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model humhub\modules\certified\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'street')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birthday_hide_year')->textInput() ?>

    <?= $form->field($model, 'birthday')->textInput() ?>

    <?= $form->field($model, 'about')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'phone_private')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_work')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fax')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'im_skype')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'im_msn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'im_xmpp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url_facebook')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url_linkedin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url_xing')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url_youtube')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url_vimeo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url_flickr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url_myspace')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url_googleplus')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url_twitter')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'awaiting_certification')->textInput() ?>

    <?= $form->field($model, 'certified')->textInput() ?>

    <?= $form->field($model, 'certified_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
