<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SliderBanner;

/**
 * SliderBannerSearch represents the model behind the search form of `backend\models\SliderBanner`.
 */
class SliderBannerSearch extends SliderBanner
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'photo_upload', 'slider_banner_id', 'user_id', 'user_update_id'], 'integer'],
            [['caption', 'url', 'date_created', 'date_updated'], 'safe'],
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
        $query = SliderBanner::find();

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
            'title' => $this->title,
            'photo_upload' => $this->photo_upload,
            'url' => $this->url,
            'slider_banner_id' => $this->slider_banner_id,
            'user_id' => $this->user_id,
            'user_update_id' => $this->user_update_id,
            'date_created' => $this->date_created,
            'date_updated' => $this->date_updated,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
