<?php
/**
 * Created by PhpStorm.
 * User: jerem
 * Date: 3/8/2017
 * Time: 2:11 AM
 */

namespace humhub\modules\certified\libs;

use humhub\components\SettingsManager;
use humhub\modules\certified\models\Profile;
use humhub\modules\user\components\PermissionManager;
use humhub\modules\user\models\Group;
use humhub\modules\user\models\GroupPermission;
use humhub\modules\user\models\GroupUser;
use yii\helpers\ArrayHelper;
use Yii;

class CertifiedHelper
{
    private static $instance;
    protected $uncertifiedUsersGroup = 'Uncertified Users Group';
    protected $certifiedUsersGroup = 'Users';
    protected $module;
    protected $certifiedSettingsLoaded = false;

    public function init()
    {
        $this->checkGroupPermissions();
        $this->module = yii::$app->getModule('certified');
    }

    // The singleton method
    public static function singleton()
    {

        if (!isset(self::$instance)) {
            self::$instance = new CertifiedHelper();
        }
        return self::$instance;
    }

    /**
     * @return bool
     */
    public function checkAfterSubmit()
    {
        $module = yii::$app->getModule('certified');
        $module->settings->get('Certify After Submit');
        if ($certify = $module->settings->get('Certify After Submit'))
        {
            return false;
        }
        return true;
    }

    public function checkGroupPermissions()
    {
        if (($this->certifiedSettingsLoaded) == false ) {
            $permissions = GroupPermission::find()->where(['module_id' => 'mail'])->all();
            foreach ($permissions as $permission) {
                $groupId = $permission->group_id;
                $group = $this->compareGroupId($groupId);
                if ($group == 'Certified') {
                    $permission->permission_id = 'humhub\modules\mail\permissions\SendMail';
                    $permission->state = 1;
                } elseif ($group == 'Uncertified') {
                    $permission->permission_id = 'humhub\modules\mail\permissions\SendMail';
                    $permission->state = 0;
                }
            }
        }

    }

    protected function compareGroupId($group_id)
    {
        $certifiedUsers = $this->findGroup($this->certifiedUsersGroup);
        $uncertifiedUsers = $this->findGroup($this->uncertifiedUsersGroup);
        if ($certifiedUsers == $group_id){
            return 'Certified';
        } elseif ($uncertifiedUsers == $group_id) {
            return 'Uncertified';
        } else {
            return 'unknown';
        }
    }

    protected function getModule()
    {
        $this->module = yii::$app->getModule('certified');
    }

    public function checkGroups()
    {
        $this->getModule();
        $this->uncertifiedUsersGroup = $this->module->settings->get('Uncertified Users Group');
        $this->certifiedUsersGroup = $this->module->settings->get('Certified Users Group');
        $this->groupExists($this->uncertifiedUsersGroup, 'Uncertified Group');
        $this->groupExists($this->certifiedUsersGroup, 'Certified Users Group');

    }

    protected function groupExists ($groupName, $groupDescription)
    {
        $group = $this->findGroup($groupName);
        if (!$group){
            $this->addGroup($groupName, $groupDescription);
        }
        return true;
    }

    protected function addGroup($groupName, $groupDiscription)
    {
        $newGroup = new Group();
        $newGroup->created_by = yii::$app->user->id;
        $newGroup->name = $groupName;
        $newGroup->description = $groupDiscription;
    }

    public function changeGroups($userId)
    {
        $certifiedGroupId = $this->findGroup($this->certifiedUsersGroup);
        $isInCertifiedGroup = $this->findGroupUser($certifiedGroupId, $userId);
        if ($isInCertifiedGroup == false) {
            $this->addToGroup($userId,$this->certifiedUsersGroup);
            $this->removeFromGroup($userId, $this->uncertifiedUsersGroup);
            return 'Moved from Uncertified Group';
        }
        $this->addToGroup($userId, $this->uncertifiedUsersGroup);
        $this->removeFromGroup($userId, $this->certifiedUsersGroup);
        return 'Moved from Certified Group';
    }

    protected function addToGroup($userId, $groupName)
    {
        $groupId = $this->findGroup($groupName);
        $newRecord = new GroupUser();
        $newRecord->created_by = yii::$app->user->id;
        $newRecord->group_id = $groupId;
        $newRecord->user_id = $userId;
        if($newRecord->save()){
            return true;
        }
        return false;
    }

    protected function removeFromGroup($userId, $groupName)
    {
        $groupId = $this->findGroup($groupName);
        $record = $this->findGroupUser($groupId, $userId);
        if ($record == false){
            return false;
        }
        $record->delete();
        return true;
    }

    protected function findGroupUser($groupId, $userId)
    {
        $record = GroupUser::find()->where(['user_id' => $userId])->andWhere(['group_id' => $groupId])->one();

        if($record !== null) {
            return $record;
        }
         return false;
    }

    protected function findGroup($groupName)
    {
        $group = Group::find()->where(['name' => $groupName])->one();
        if ($group !== null) {
            $groupId = $group->getGroupId();
            return $groupId;
        }
        return false;
    }
}