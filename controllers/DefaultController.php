<?php

namespace humhub\modules\certified\controllers;

class DefaultController extends \yii\web\Controller
{

    /**
     * Renders the index view for the module
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

}

