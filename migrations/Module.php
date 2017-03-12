<?php

namespace humhub\modules\certified;

use humhub\components\SettingsManager;
use humhub\models\Setting;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/**
 *
 * @property mixed $configUrl
 * @property string $name
 */
class Module extends \humhub\components\Module
{

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return ('Certified');
    }

    /**
     * @inheritdoc
     */
    public function getPermissions($contentContainer = null)
    {
        return [
            new permissions\ManageCertifications(),
            new permissions\CertifiedAdmin(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getConfigUrl()
    {
        return Url::to(['/certified/admin/config']);
    }
}