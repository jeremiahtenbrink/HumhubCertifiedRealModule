<?php

namespace humhub\modules\certified\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveQuery;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "profile".
 *
 * @property integer $user_id
 * @property integer $awaiting_certification
 * @property integer $certified
 * @property integer $certified_by
 */
class Profile extends \humhub\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['awaiting_certification', 'certified', 'certified_by'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'awaiting_certification' => 'Awaiting Certification',
            'certified' => 'Certified',
            'certified_by' => 'Certified By',
        ];
    }

}
