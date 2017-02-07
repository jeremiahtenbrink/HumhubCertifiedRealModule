<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model humhub\modules\certified\models\AwaitingCertification */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Awaiting Certifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="awaiting-certification-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_at',
            'his_picture_url:url',
            'her_picture_url:url',
        ],
    ]) ?>

</div>
