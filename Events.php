<?php

namespace humhub\modules\certified;

use Yii;
use yii\helpers\Url;

class Events extends \yii\base\Object
{

    /**
     * Defines what to do when the top menu is initialized.
     *
     * @param $event
     */
    public static function onTopMenuInit($event)
    {
        $event->sender->addItem(array(
            'label' => "Certified",
            'icon' => '<i class="fa fa-certificate" style="color: #6fdbe8;"></i>',
            'url' => Url::to(['/certified/default']),
            'sortOrder' => 99999,
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'certified' && Yii::$app->controller->id == 'default'),
        ));
    }


    /**
     * Defines what to do if admin menu is initialized.
     *
     * @param $event
     */
    public static function onAdminMenuInit($event)
    {
        $event->sender->addItem(array(
            'label' => "Certified",
            'url' => Url::to(['/certified/admin']),
            'group' => 'manage',
            'icon' => '<i class="fa fa-certificate" style="color: #6fdbe8;"></i>',
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'certified' && Yii::$app->controller->id == 'admin'),
            'sortOrder' => 99999,
        ));
    }

}

