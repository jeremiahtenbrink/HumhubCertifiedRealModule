<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model humhub\modules\certified\models\Profile */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->user_id], [
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
            'user_id',
            'firstname',
            'lastname',
            'title',
            'gender',
            'street',
            'zip',
            'city',
            'country',
            'state',
            'birthday_hide_year',
            'birthday',
            'about:ntext',
            'phone_private',
            'phone_work',
            'mobile',
            'fax',
            'im_skype',
            'im_msn',
            'im_xmpp',
            'url:url',
            'url_facebook:url',
            'url_linkedin:url',
            'url_xing:url',
            'url_youtube:url',
            'url_vimeo:url',
            'url_flickr:url',
            'url_myspace:url',
            'url_googleplus:url',
            'url_twitter:url',
            'awaiting_certification',
            'certified',
            'certified_by',
        ],
    ]) ?>

</div>
