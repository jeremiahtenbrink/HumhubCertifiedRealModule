<?php

namespace humhub\modules\certified\controllers;

use humhub\components\behaviors\AccessControl;
use humhub\modules\certified\models\Profile;
use humhub\modules\user\models\Group;
use humhub\modules\user\models\GroupUser;
use humhub\modules\user\models\User;
use Yii;
use humhub\modules\certified\models\AwaitingCertification;
use humhub\modules\certified\models\AwaitingCertificationSearch;
use humhub\modules\certified\permissions\CertifiedAdmin;
use humhub\modules\certified\permissions\ManageCertifications;
use humhub\components\ActiveRecord;
use humhub\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use humhub\modules\certified\libs\CertifiedHelper;

/**
 * AdminController implements the CRUD actions for AwaitingCertification model.
 */
class AdminController extends Controller
{
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
        $model = AwaitingCertification::find()->where(['status' => 'Awaiting approval'])->all();


        return $this->render('approve', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single AwaitingCertification model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AwaitingCertification model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AwaitingCertification();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AwaitingCertification model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }

    }

    /**
     * Deletes an existing AwaitingCertification model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDenyCertification ($id)
    {
        $record = $this->findModel($id);
        $user = Profile::find()->where(['user_id' => $record->user_id])->one();
        $user->certified = 0;
        $record->status = 'Needs Admin Approval';
        $record->save();
        $helper = CertifiedHelper::singleton();
        $certifyAfterSubmit = $helper->checkAfterSubmit();
        if ($certifyAfterSubmit == true) {
            $changeUserGroup = $helper->changeGroups($record->user_id);
            if (!($changeUserGroup == 'Moved from Certified Group')) {
                Yii::warning('Something is wrong with the change user groups function in certified module');

            }
        }

        $model = AwaitingCertification::find()->where(['status' => 'Awaiting approval'])->all();

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

    public function actionConfig()
    {
        $searchModel = new AwaitingCertificationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $this->subLayout = '/layouts/config';
       return $this->render('config', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider]);
    }

    public function actionApproveCertification($id)
    {
        $awaitingCertification = AwaitingCertification::find()->where(['id' => $id])->one();
        $userProfile = Profile::find()->where(['user_id' => $awaitingCertification->user_id])->one();
        $userProfile->certified_by = yii::$app->user->id;
        $userProfile->save();
        $awaitingCertification->delete();

        $model = AwaitingCertification::find()->where(['status' => 'Awaiting approval'])->all();

        return $this->render('approve', [
            'model' => $model,
        ]);

    }
}
