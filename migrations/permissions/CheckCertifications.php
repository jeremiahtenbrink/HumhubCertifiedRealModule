<?php
/**
 * Created by PhpStorm.
 * User: jerem
 * Date: 2/20/2017
 * Time: 9:31 AM
 */

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\certified\permissions;

use humhub\modules\user\models\User;
use Yii;

/**
 * Send Mail Permission
 */
class CheckCertifications extends \humhub\libs\BasePermission
{

    /**
     * @inheritdoc
     */
    protected $moduleId = 'certified';

    public function __construct($config = array())
    {
        parent::__construct($config);
        $this->title = 'Check Certifications';
        $this->description = 'Can check certification requests from users and then officially certify them. ';
    }

    /**
     * @inheritdoc
     */
    public function getDefaultState($groupId)
    {
        return parent::getDefaultState($groupId);

    }

}
