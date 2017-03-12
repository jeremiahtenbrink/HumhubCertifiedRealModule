<?php

namespace humhub\modules\certified\controllers;

use humhub\modules\certified\controllers\ProfileController;
use humhub\modules\user\models\fieldtype\DateTime;
use MongoDB\BSON\Timestamp;
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
        $model = new AwaitingCertification();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {


            $humhubFile = new \humhub\modules\file\models\File();
            $humhubFile->file_name = $this->image->baseName . '.' . $$this->image->extension;
            $humhubFile->mime_type = $this->image->type;
            $humhubFile->size = $this->image->size;
            if ($humhubFile->save()) {
                $humhubFile->store->set($this->image);
            }
            $model->file_her = UploadedFile::getInstance($model,'file_her');
            $model->file_him = UploadedFile::getInstance($model, 'file_him');
            $imageName = Yii::$app->getSecurity()->generateRandomString(10);
            $model->file_him->saveAs('uploads/awaitingCertification/'. $imageName. '.' .$model->file_him->extension );
            $model->his_picture_url = 'uploads/awaitingCertification/'. $imageName. '.' .$model->file_him->extension;
            $imageName = Yii::$app->getSecurity()->generateRandomString(10);
            $model->file_her->saveAs('uploads/awaitingCertification/'. $imageName. '.' .$model->file_her->extension );
            $model->her_picture_url = 'uploads/awaitingCertification/'. $imageName. '.' .$model->file_her->extension;
            $model->user_id = yii::$app->user->id;
            $model->created_at = new DateTime();
            $model->save();
            $updated = $this->changeAwaitingCertification();

            if ($updated === true){
                $message = 'Thanks for getting certified!';
            }else {
                $message = 'Something went wrong';
            }

            return $this->redirect(['view', 'message' => $message]);
        } else {

            $model2 = $this->findProfileModel();
            $profileType = $model2->getAttribute('gender');

            return $this->render('_form', [
                'model' => $model,
                'profileType' => $profileType,
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
    protected function findAwaintingCertificationModel()
    {
        if (($model = AwaitingCertification::findOne(Yii::$app->user->id)) !== null) {
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
    protected function findProfileModel()
    {
        if (($model = Profile::findOne(Yii::$app->user->id)) !== null)
        {
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
    public function changeAwaitingCertification()
    {
        if(($model = $this->findProfileModel()) !== null){
            $model->awaiting_certification = 1;
            return $model->save() ? true : false;

        }
        else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function updateProfile($data )
    {
        $profileID = $data['id'];
    }



}

