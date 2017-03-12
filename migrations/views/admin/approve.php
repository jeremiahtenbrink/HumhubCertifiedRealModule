<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model humhub\modules\certified\models\AwaitingCertification */

$this->title = 'Awaiting Certifications';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="awaiting-certification-index">

    <div class="container">
        <div class="panel">
            <div class="panel-heading">
    <h1><?= Html::encode($this->title) ?></h1>
            </div>
            <div class="pandel-body">
        <!-- BEGIN: Results -->
        <?php foreach ($model as $record) : ?>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-xs-6 thumb" style="margin-bottom: 20px">
                        <img class="img-responsive" src="<?php $file = \humhub\modules\file\models\File::findOne(['guid' => $record->her_picture_guid ]);

                        $previewImage = new \humhub\modules\file\converter\PreviewImage();
                        if ($file !== null) {
                            // Can create preview of given file
                            if($previewImage->applyFile($file)) {
                                echo $previewImage->getUrl();
                            }
                        }; ?>" style="margin-bottom: 0px; " alt="His Image">
                    <?php echo 'His Image' ?>
                </div>

                <div class="col-lg-3 col-md-4 col-xs-6 thumb" style="margin-bottom: 20px">
                        <img class="img-responsive" src="<?php $file = \humhub\modules\file\models\File::findOne(['guid' => $record->his_picture_guid ]);

                        $previewImage = new \humhub\modules\file\converter\PreviewImage();
                        if ($file !== null) {
                            // Can create preview of given file
                            if($previewImage->applyFile($file)) {
                                echo $previewImage->getUrl();
                            }
                        }; ?>" style="margin-bottom: 0px; alt="">
                    <?php echo 'Her Image' ?>
                </div>

                <div class="col-lg-6 col-md-4 col-xs-12 thumb">
                    <div class="row" style="margin-bottom: 10px">
                    <?php if($record->user !== null) {
                        echo '<h4>' . $record->user->getDisplayName() . '</h4>';
                        } ?>
                    </div>
                    <div class="row" style="align-content:  center; margin-bottom: 10px;">
                    <?= Html::a('Approve Certification', ['approve-certification','id' => $record->id], ['class' => 'btn btn-success']) ?>
                    </div>
                    <div class="row" style="align-content:  center; margin-bottom: 10px;">
                        <?= Html::a('Deny Certification', ['deny-certification', 'id' => $record->id], ['class' => 'btn btn-warning']) ?>
                    </div>
                    <div class="row" style="align-content:  center; margin-bottom: 10px;">
                        <?= Html::a('Delete Account', Url::toRoute(['/admin/user/delete', 'id' => $record->user_id]), ['class' => 'btn btn-danger']) ?>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
        <!-- END: Results -->
            </div>
            </div>
    </div>