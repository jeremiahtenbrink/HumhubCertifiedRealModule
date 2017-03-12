<?php

namespace humhub\modules\certified\models;

use humhub\components\ActiveRecord;
use Yii;
use humhub\modules\user\models\User;

/**
 * This is the model class for table "profile".
 *
 * @property integer $user_id
 * @property string $firstname
 * @property string $lastname
 * @property string $title
 * @property string $gender
 * @property string $street
 * @property string $zip
 * @property string $city
 * @property string $country
 * @property string $state
 * @property integer $birthday_hide_year
 * @property string $birthday
 * @property string $about
 * @property string $phone_private
 * @property string $phone_work
 * @property string $mobile
 * @property string $fax
 * @property string $im_skype
 * @property string $im_msn
 * @property string $im_xmpp
 * @property string $url
 * @property string $url_facebook
 * @property string $url_linkedin
 * @property string $url_xing
 * @property string $url_youtube
 * @property string $url_vimeo
 * @property string $url_flickr
 * @property string $url_myspace
 * @property string $url_googleplus
 * @property string $url_twitter
 * @property integer $needs_admin_approval
 * @property integer $certified
 * @property integer $certified_by
 *
 * @property User $user
 */
class Profile extends ActiveRecord
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
            [['user_id', 'birthday_hide_year', 'needs_admin_approval', 'certified', 'certified_by'], 'integer'],
            [['birthday'], 'safe'],
            [['about'], 'string'],
            [['firstname', 'lastname', 'title', 'gender', 'street', 'zip', 'city', 'country', 'state', 'phone_private', 'phone_work', 'mobile', 'fax', 'im_skype', 'im_msn', 'im_xmpp', 'url', 'url_facebook', 'url_linkedin', 'url_xing', 'url_youtube', 'url_vimeo', 'url_flickr', 'url_myspace', 'url_googleplus', 'url_twitter'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => false, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'title' => 'Title',
            'gender' => 'Gender',
            'street' => 'Street',
            'zip' => 'Zip',
            'city' => 'City',
            'country' => 'Country',
            'state' => 'State',
            'birthday_hide_year' => 'Birthday Hide Year',
            'birthday' => 'Birthday',
            'about' => 'About',
            'phone_private' => 'Phone Private',
            'phone_work' => 'Phone Work',
            'mobile' => 'Mobile',
            'fax' => 'Fax',
            'im_skype' => 'Im Skype',
            'im_msn' => 'Im Msn',
            'im_xmpp' => 'Im Xmpp',
            'url' => 'Url',
            'url_facebook' => 'Url Facebook',
            'url_linkedin' => 'Url Linkedin',
            'url_xing' => 'Url Xing',
            'url_youtube' => 'Url Youtube',
            'url_vimeo' => 'Url Vimeo',
            'url_flickr' => 'Url Flickr',
            'url_myspace' => 'Url Myspace',
            'url_googleplus' => 'Url Googleplus',
            'url_twitter' => 'Url Twitter',
            'needs_admin_aproval' => 'Needs admin approval to be certified',
            'certified' => 'Certified',
            'certified_by' => 'Certified By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return ProfileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProfileQuery(get_called_class());
    }

    public function needsAdminApproval()
    {
        if ($this->needs_admin_approval === 1) {
            return true;
        }
        return true;
    }
}
