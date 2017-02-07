<?php

namespace humhub\modules\certified\models;

use Yii;
use yii\data\ActiveDataProvider;
use humhub\components\ActiveRecord;

/**
 * This is the model class for table "awaiting_certification".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $his_picture_url
 * @property string $her_picture_url
 */
class AwaitingCertification extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'awaiting_certification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['his_picture_url', 'her_picture_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'his_picture_url' => 'His Picture Url',
            'her_picture_url' => 'Her Picture Url',
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = AwaitingCertification::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'his_picture_url', $this->his_picture_url])
            ->andFilterWhere(['like', 'her_picture_url', $this->her_picture_url]);

        return $dataProvider;
    }
}
