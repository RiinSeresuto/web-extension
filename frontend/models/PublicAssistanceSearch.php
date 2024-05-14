<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\PublicAssistance;

/**
 * PublicAssistanceSearch represents the model behind the search form of `frontend\models\PublicAssistance`.
 */
class PublicAssistanceSearch extends PublicAssistance
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'contact_num', 'group', 'file_attachment'], 'integer'],
            [['name', 'email', 'subject', 'message', 'date_posted'], 'safe'],
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
        $query = PublicAssistance::find();

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
            'contact_num' => $this->contact_num,
            'group' => $this->group,
            'file_attachment' => $this->file_attachment,
            'date_posted' => $this->date_posted,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'message', $this->message]);

        return $dataProvider;
    }
}
