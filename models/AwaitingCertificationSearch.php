<?php

namespace humhub\modules\certified\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use humhub\modules\certified\models\AwaitingCertification;

/**
 * AwaitingCertificationSearch represents the model behind the search form about `certified\models\AwaitingCertification`.
 */
class AwaitingCertificationSearch extends AwaitingCertification
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['created_at', 'his_picture_url', 'her_picture_url'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }



}
