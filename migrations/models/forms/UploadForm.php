<?php
/**
 * Created by PhpStorm.
 * User: jerem
 * Date: 2/20/2017
 * Time: 7:31 PM
 */

namespace humhub\modules\certified\Models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    public function rules()
    {
        return [
        [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 2],
    ];
    }

}