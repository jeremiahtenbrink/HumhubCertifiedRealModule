<?php
/**
 * Created by PhpStorm.
 * User: jerem
 * Date: 2/19/2017
 * Time: 3:14 PM
 */

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\certified\permissions;

use humhub\libs\BasePermission;
use humhub\modules\user\models\User;
use humhub\modules\space\models\Space;
use Yii;

/**
 * Send Mail Permission
 */
class ManageCertifications extends BasePermission
{
    //protected $defaultState = self::STATE_ALLOW;
    /**
     * @inheritdoc
     */
    protected $moduleId = 'certified';

    protected $defaultState = self::STATE_DENY;

    public function __construct($config = array())
    {
        parent::__construct($config);
        $this->title = 'Manage Certifications';
        $this->description = 'Users with permissions to manage user certifications.';
    }

    /**
     * @inheritdoc
     */
    public function getDefaultState($groupId)
    {
        return parent::getDefaultState($groupId);

    }

    /**
     * A list of groupIds which allowed per default.
     *
     * @var array default allowed groups
     */
    protected $defaultAllowedGroups = [
        Space::USERGROUP_ADMIN,
    ];

}
