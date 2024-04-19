<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Pages;

/**
 * PagesSearch represents the model behind the search form of `backend\models\Pages`.
 */
class PagesSearch extends Pages
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'menu_id', 'url_type_id', 'status_id', 'type_id', 'slider_photo', 'user_id', 'user_update_id'], 'integer'],
            [['title', 'caption', 'body', 'link', 'date_created', 'date_updated'], 'safe'],
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
        $query = Pages::find();

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
            'menu_id' => $this->menu_id,
            'url_type_id' => $this->url_type_id,
            'status_id' => $this->status_id,
            'type_id' => $this->type_id,
            'slider_photo' => $this->slider_photo,
            'file_attachment' => $this->file_attachment,
            'user_id' => $this->user_id,
            'user_update_id' => $this->user_update_id,
            'date_created' => $this->date_created,
            'date_updated' => $this->date_updated,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        if (!empty($this->status)) {
            $query->andFilterWhere(['like', 'status_id', $this->status->id]);
        }

        return $dataProvider;
    }
}
