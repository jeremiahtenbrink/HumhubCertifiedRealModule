<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model humhub\modules\certified\models\AwaitingCertification */

$this->title = 'Create Awaiting Certification';
$this->params['breadcrumbs'][] = ['label' => 'Awaiting Certifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="awaiting-certification-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
