<?php

namespace humhub\modules\certified;

use humhub\modules\certified\models\AwaitingCertification;
use humhub\modules\certified\models\Profile;
use humhub\modules\certified\models\ProfileSearch;
use humhub\modules\certified\widgets\GetCertified;
use Yii;
use yii\base\Object;
use yii\helpers\Url;

class Events extends Object
{

    /**
     * Defines what to do when the top menu is initialized.
     *
     * @param $event
     */
    public static function onTopMenuInit($event)
    {
        if(yii::$app->user->can(new permissions\ManageCertifications())) {
            $event->sender->addItem(array(
                'label' => "Certified",
                'icon' => '<i class="fa fa-certificate" style="color: lightslategray;"></i>',
                'url' => Url::to(['/certified/admin/index']),
                'sortOrder' => 99999,
                'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'certified'),
            ));
        }
    }

    public static function onCertifiedSidebarInit($event)
    {
        $userProfile = Profile::find()->where(['user_id' => yii::$app->user->id])->one();
        $certified = $userProfile->certified;
        if (!($certified == 1)) {
            $event->sender->addWidget(GetCertified::className(), array(), array('sortOrder' => 1));
        }


    }



}

