<?php

namespace humhub\modules\certified\models;

use humhub\components\ActiveRecord;
use Yii;
use humhub\modules\file\models\File;
use humhub\modules\user\models\User;

/**
 * This is the model class for table "awaiting_certification".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $created_at
 * @property string $her_picture_guid
 * @property string $his_picture_guid
 * @property string $status
 * @property string $message
 *
 * @property string $herPictureGu
 * @property string $hisPictureGu
 * @property \yii\db\ActiveQuery $hisPictureGuid
 * @property \yii\db\ActiveQuery $herPictureGuid
 * @property User $user
 */
class AwaitingCertification extends ActiveRecord
{

    public $hisImage;
    public $herImage;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'awaiting_certification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['created_at'], 'safe'],
            [['message'], 'string'],
            [['her_picture_guid', 'his_picture_guid', 'status'], 'string', 'max' => 255],
            [['user_id'], 'unique'],
            [['her_picture_guid'], 'unique'],
            [['his_picture_guid'], 'unique'],
            [['her_picture_guid'], 'exist', 'skipOnError' => true, 'targetClass' => File::className(), 'targetAttribute' => ['her_picture_guid' => 'guid']],
            [['his_picture_guid'], 'exist', 'skipOnError' => true, 'targetClass' => File::className(), 'targetAttribute' => ['his_picture_guid' => 'guid']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['hisImage', 'herImage'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'minWidth' => 100, 'maxWidth' => 1000, 'minHeight' => 100, 'maxHeight' => 1000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'her_picture_guid' => 'Her Picture Guid',
            'his_picture_guid' => 'His Picture Guid',
            'status' => 'Status',
            'message' => 'Message',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHerPictureGuid()
    {
        return $this->hasOne(File::className(), ['guid' => 'her_picture_guid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHisPictureGuid()
    {
        return $this->hasOne(File::className(), ['guid' => 'his_picture_guid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
