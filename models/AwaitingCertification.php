<?php

namespace humhub\modules\certified\models;

use humhub\components\ActiveRecord;
use Yii;
use yii\db\ActiveQuery;
use humhub\modules\user\models\User;
use humhub\modules\user\models\Profile;

/**
 * This is the model class for table "awaiting_certification".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $his_picture_url
 * @property string $her_picture_url
 * @property integer $user_id
 */
class AwaitingCertification extends \humhub\components\ActiveRecord
{
    public $file_her;
    public $file_him;

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
            [['created_at'], 'safe'],
            [['user_id'], 'integer'],
            [['his_picture_url', 'her_picture_url'], 'string', 'max' => 255],
            [['file_her', 'file_him'],'file'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'his_picture_url' => 'His Picture Url',
            'her_picture_url' => 'Her Picture Url',
            'user_id' => 'User ID',
            'file_her' => 'Her Picture',
            'file_him' => 'His Picture',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        $this->hasOne(Profile::className(), ['user_id' => 'user_id']);

    }

}
