<?php

namespace humhub\modules\certified\controllers;

use humhub\modules\certified\libs\CertifiedHelper;
use humhub\modules\certified\models\AwaitingCertificationSearch;
use humhub\modules\file\models\File;
use Yii;
use humhub\modules\certified\models\AwaitingCertification;
use humhub\components\Controller;
use yii\helpers\Url;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use humhub\modules\certified\models\Profile;
use humhub\modules\user\models\GroupUser;
use humhub\modules\user\models\Group;
use yii\web\UploadedFile;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use humhub\components\ActiveRecord;


/**
 * AwaitingCertificationsController implements the CRUD actions for AwaitingCertification model.
 */
class AwaitingCertificationController extends Controller
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
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at','updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by'
            ],
        ];
    }


    /**
     * Creates a new AwaitingCertification model.
     *
     * Creates a new AwaitingCertification model and saves the users uploaded images so
     * admin can approve or deny the user. The user is removed from group Uncertified Users and
     * placed in group Users. If neither of the two mentioned groups exist then the two groups will
     * be created.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $profile = Profile::find()->where(['user_id' => yii::$app->user->id])->one();
        $profileType = $profile->gender;

        $model = new AwaitingCertification();

        if ($model->load(Yii::$app->request->post())) {

            $records = AwaitingCertification::find()->where(['user_id' => yii::$app->user->id])->all();
            $needsApproval = false;

            foreach ($records as $record) {
                if (($record->status) == 'Needs Admin Approval') {
                    $needsApproval = true;
                }
            }
            if ($profileType == 'female') {
                $model->her_picture_guid = $this->getPictureGuid($model, 'herImage');
            } elseif ($profileType == 'male') {
                $model->his_picture_guid = $this->getPictureGuid($model, 'hisImage');
            }else {
                $model->her_picture_guid = $this->getPictureGuid($model, 'herImage');
                $model->his_picture_guid = $this->getPictureGuid($model, 'hisImage');
            }



            $helper = CertifiedHelper::singleton();
            $helper->checkGroupPermissions();
            $model->user_id = Yii::$app->user->id;
            $tempCertifyAfterSubmit = $helper->checkAfterSubmit();
            $model->status = 'Awaiting approval';
            if($needsApproval == false && $tempCertifyAfterSubmit == true) {

                $changeUserGroup = $helper->changeGroups($model->user_id);
                if (!($changeUserGroup == 'Moved from Uncertified Group')) {
                    yii::warning('Something went wrong in the certified module change user groups in AwaitingCertificationController');
                }
            }

            $profile->certified = 1;
            $profile->save();
            $model->save();

        }

        return $this->redirect(Url::toRoute('/dashboard/dashboard'));

    }

    /**
     * Saves the picture to the server and then gets the pictures Guid for return.
     * If the picture is not saved then it throws a Http Exception.
     *
     * Requires the model the pictures were uploaded to and the name of the image field.
     *
     * @param $model
     * @param $name
     * @return bool|string
     * @throws HttpException
     */
    protected function getPictureGuid($model, $name)
    {
        $pictureGuid = $this->saveImage($model, $name);
        if ($pictureGuid !== false){
            return $pictureGuid;
        } throw new HttpException('Could not save ' . $name . ' image.
        Please resubmit or notify admin.');
    }

    /**
     * This function is used by get pictureGuid. This is where a new Humhub file
     * is created and then the image is saved to the Humhub file and it returns
     * the images Guid for storage.
     *
     * @param $model
     * @param $name
     * @return bool|string
     */
    protected function saveImage($model, $name)
    {
        $image = UploadedFile::getInstance($model, $name);
        $humhubFile = new File();
        $humhubFile->file_name = $image->baseName . '.' . $image->extension;
        $humhubFile->mime_type = $image->type;
        $humhubFile->size = $image->size;
        $humhubFile->object_model = 'certified';
        $humhubFile->title = $name;
        if ($humhubFile->save()) {
            $humhubFile->store->set($image);
            return $humhubFile->guid;
        }
        return false;
    }
}
