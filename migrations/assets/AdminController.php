<?php

namespace humhub\modules\certified\controllers;

use humhub\components\ActiveRecord;
use humhub\libs\Helpers;
use humhub\modules\certified\permissions\CertifiedAdmin;
use humhub\modules\user\components\User;
use Yii;
use humhub\modules\certified\permissions\ManageCertifications;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;
use humhub\modules\certified\models\AwaitingCertification;
use humhub\modules\certified\models\AwaitingCertificationSearch;
use humhub\components\behaviors\AccessControl;
use humhub\modules\certified\models\Profile;
use humhub\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use humhub\modules\certified\libs\CertifiedHelper;

/**
 * AdminController implements the CRUD actions for AwaitingCertification model.
 */
class AdminController extends Controller
{
    protected $helper;
    /**
     * Get group permissions to allow groups to mange certification of users.
     *
     * @return array
     */
    public static function getAccessRules()
    {
        return [
            ['permissions' => ManageCertifications::className()],
            ['permissions' => CertifiedAdmin::className()],

        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'approveCertification' => ['POST'],
                    'deleteCertification' => ['POST'],
                    'config' => ['GET'],
                ],
            ],
            'acl' => [
                'class' => AccessControl::className(),
                'rules' => [
                  ['permissions' => ManageCertifications::className()],
                  ['permissions' => CertifiedAdmin::className(), 'actions' => ['config']],
                ],
            ],

        ];
    }


    /**
     * Lists all AwaitingCertification models.
     * @return mixed
     */
    public function actionIndex()
    {

        $model = AwaitingCertification::find()->all();

        return $this->render('approve', [
            'model' => $model,
        ]);
    }


    /**
     * Finds the AwaitingCertification model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AwaitingCertification the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AwaitingCertification::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }




    public function actionDenyCertification($id)
    {

    }

    public function actionConfig()
    {
        $searchModel = new AwaitingCertificationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$this->subLayout = '@certified/views/layouts/config';
        $this->render('config', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider]);
    }


}
