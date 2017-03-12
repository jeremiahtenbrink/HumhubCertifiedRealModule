<?php

namespace humhub\modules\certified\models;

use humhub\modules\content\components\ActiveQueryContent;
/**
 * This is the ActiveQuery class for [[Profile]].
 *
 * @see Profile
 */
class ProfileQuery extends ActiveQueryContent
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Profile[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Profile|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
