<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model humhub\modules\certified\models\AwaitingCertification */

$this->title = 'Update Awaiting Certification: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Awaiting Certifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="awaiting-certification-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
