<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\certified\assets;

use yii\web\AssetBundle;

/**
 * Asset for core content resources.
 * 
 * @since 1.2
 * @author buddha
 */
class CertifiedAsset extends AssetBundle
{
     /**
     * @inheritdoc
     */
    public $sourcePath = '@certified/resources';

     /**
     * @inheritdoc
     */
    public $js = [
        'js/humhub.certified.form.js'
    ];
    
     /**
     * @inheritdoc
     */
    public $depends = [
        'humhub\assets\CoreApiAsset'
    ];

}
