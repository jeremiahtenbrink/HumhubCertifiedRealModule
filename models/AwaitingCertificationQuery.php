<?php

namespace humhub\modules\certified\models;

/**
 * This is the ActiveQuery class for [[AwaitingCertification]].
 *
 * @see AwaitingCertification
 */
class AwaitingCertificationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return AwaitingCertification[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return AwaitingCertification|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
