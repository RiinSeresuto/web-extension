<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ConnectedAgencies;

/**
 * ConnectedAgenciesSearch represents the model behind the search form of `app\models\ConnectedAgencies`.
 */
class ConnectedAgenciesSearch extends ConnectedAgencies
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'agency_type_id', 'agency_order', 'status_id', 'logo', 'user_id', 'user_update_id'], 'integer'],
            [['label', 'link', 'date_created', 'date_updated'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
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
        $query = ConnectedAgencies::find();

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
            'agency_type_id' => $this->agency_type_id,
            'agency_order' => $this->agency_order,
            'status_id' => $this->status_id,
            'logo' => $this->logo,
            'user_id' => $this->user_id,
            'user_update_id' => $this->user_update_id,
            'date_created' => $this->date_created,
            'date_updated' => $this->date_updated,
        ]);

        $query->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'link', $this->link]);

        return $dataProvider;
    }
}
