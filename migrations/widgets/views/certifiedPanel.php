<?php

use yii\helpers\Url;

/* @var $profileType string */
/* @var $this yii\web\View */
/* @var $model humhub\modules\certified\models\AwaitingCertification */

$this->title = 'Certification';
?>
<div class="panel panel-default panel-tour" id="Certified Panel">

    <!-- Display panel menu widget -->
    <?php echo \humhub\widgets\PanelMenu::widget(array('id' => 'getting-started-panel')); ?>

    <div class="panel-heading">
        <?php echo '<strong>Get</strong> Certified'; ?>
    </div>
    <div class="panel-body">
        <p>
            <?php echo 'You need to get certified as a real person in order to unlock some great features like email and picture gallery.
            Just upload a picture of yourself holding a sign with your screen name and the site name on it for every person in your profile. This is done as
            a security measure to protect our users identities as well as yours. No one will see the picture/pictures except for administrative personal, and will 
            be deleted after verification has been approved. This is done to protect our users identities as well as yours.'; ?>
        </p>
        <?= $this->render('_form', [
            'model' => $model,
            'profileType' => $profileType,
        ]) ?>
        

    </div>
</div>

