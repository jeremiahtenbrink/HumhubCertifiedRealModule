<?php

namespace humhub\modules\certified\controllers;

use Yii;
use yii\db\ActiveRecord;
use humhub\modules\user\models\User;
use humhub\modules\certified\models\AwaitingCertification;
use humhub\modules\certified\models\Profile;
use humhub\modules\certified\models\AwaitingCertificationSearch;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class DefaultController extends \yii\web\Controller
{

    /**
     * Lists all AwaitingCertificatoin models.
     *
     * @return mixed
     */
    public function actionIndex()
    {

        $user = Yii::$app->user->getIdentity();

        $model = new AwaitingCertification();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {


            $model->file_her = UploadedFile::getInstance($model,'file_her');
            $model->file_him = UploadedFile::getInstance($model, 'file_him');
            $imageName = Yii::$app->getSecurity()->generateRandomString(10);
            $model->file_him->saveAs('uploads/awaitingCertification/'. $imageName. '.' .$model->file_him->extension );
            $model->his_picture_url = 'uploads/awaitingCertification/'. $imageName. '.' .$model->file_him->extension;
            $imageName = Yii::$app->getSecurity()->generateRandomString(10);
            $model->file_her->saveAs('uploads/awaitingCertification/'. $imageName. '.' .$model->file_her->extension );
            $model->her_picture_url = 'uploads/awaitingCertification/'. $imageName. '.' .$model->file_her->extension;
            $model->user_id = $user->getId();
            $model->save();
            $updated = $this->changeAwaitingCertification($user->getId());

            if ($updated === true){
                $message = 'Thanks for getting certified!';
            }else {
                $message = 'Something went wrong';
            }

            return $this->redirect(['view', 'message' => $message]);
        } else {
            return $this->render('_form', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Displays a single AwaitingCertification model.
     * @param $message
     * @return mixed
     * @internal param int $id
     */
    public function actionView($message)
    {
        return $this->render('view', [
            'message' => $message,
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

    /**
     * Finds the Profile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Profile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findProfileModel($id)
    {
        if (($model = Profile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    /**
     * @param $id
     * @return bool
     * @throws NotFoundHttpException
     */
    public function changeAwaitingCertification($id)
    {
        if(($model = $this->findProfileModel($id)) !== null){
            $model->awaiting_certification = 1;
            return $model->save() ? true : false;

        }
        else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }


    }


}

