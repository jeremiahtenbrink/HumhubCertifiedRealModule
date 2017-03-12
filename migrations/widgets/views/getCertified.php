<?php
/**
 *@var $profileType
 * @var $message
 * @var $uploadButton
 * @var $uploadProgress
 */

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;



?>

<div class="panel panel-default panel-getCertified">
    <div class="panel-heading">
        <?php echo '<strong>Get</strong> Certified' ?>
    </div>
    <div>
        <div class="panel-body">

            <p>
                <?php echo $message ?>
            </p>
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
            <?php echo $uploadButton::widget();
            echo $uploadProgress::widget();
            ActiveForm::end();
            ?>

        </div>
    </div>
</div>




