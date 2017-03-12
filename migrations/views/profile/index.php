<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel humhub\modules\certified\models\ProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Profile', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user_id',
            'firstname',
            'lastname',
            'title',
            'gender',
            // 'street',
            // 'zip',
            // 'city',
            // 'country',
            // 'state',
            // 'birthday_hide_year',
            // 'birthday',
            // 'about:ntext',
            // 'phone_private',
            // 'phone_work',
            // 'mobile',
            // 'fax',
            // 'im_skype',
            // 'im_msn',
            // 'im_xmpp',
            // 'url:url',
            // 'url_facebook:url',
            // 'url_linkedin:url',
            // 'url_xing:url',
            // 'url_youtube:url',
            // 'url_vimeo:url',
            // 'url_flickr:url',
            // 'url_myspace:url',
            // 'url_googleplus:url',
            // 'url_twitter:url',
            // 'awaiting_certification',
            // 'certified',
            // 'certified_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
