<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model humhub\modules\certified\models\ProfileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'firstname') ?>

    <?= $form->field($model, 'lastname') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'street') ?>

    <?php // echo $form->field($model, 'zip') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'birthday_hide_year') ?>

    <?php // echo $form->field($model, 'birthday') ?>

    <?php // echo $form->field($model, 'about') ?>

    <?php // echo $form->field($model, 'phone_private') ?>

    <?php // echo $form->field($model, 'phone_work') ?>

    <?php // echo $form->field($model, 'mobile') ?>

    <?php // echo $form->field($model, 'fax') ?>

    <?php // echo $form->field($model, 'im_skype') ?>

    <?php // echo $form->field($model, 'im_msn') ?>

    <?php // echo $form->field($model, 'im_xmpp') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'url_facebook') ?>

    <?php // echo $form->field($model, 'url_linkedin') ?>

    <?php // echo $form->field($model, 'url_xing') ?>

    <?php // echo $form->field($model, 'url_youtube') ?>

    <?php // echo $form->field($model, 'url_vimeo') ?>

    <?php // echo $form->field($model, 'url_flickr') ?>

    <?php // echo $form->field($model, 'url_myspace') ?>

    <?php // echo $form->field($model, 'url_googleplus') ?>

    <?php // echo $form->field($model, 'url_twitter') ?>

    <?php // echo $form->field($model, 'awaiting_certification') ?>

    <?php // echo $form->field($model, 'certified') ?>

    <?php // echo $form->field($model, 'certified_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
