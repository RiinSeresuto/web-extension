<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Post;

/**
 * PostSearch represents the model behind the search form of `app\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'forms_id', 'field_id', 'status_id', 'visibility_id', 'publish_id', 'page_id', 'min_answer', 'max_answer', 'user_id', 'user_update_id'], 'integer'],
            [['tags', 'start_date_time', 'end_date_time', 'date_created', 'date_updated'], 'safe'],
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
        $query = Post::find();

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
            'forms_id' => $this->forms_id,
            'field_id' => $this->field_id,
            'status_id' => $this->status_id,
            'visibility_id' => $this->visibility_id,
            'publish_id' => $this->publish_id,
            'page_id' => $this->page_id,
            'start_date_time' => $this->start_date_time,
            'end_date_time' => $this->end_date_time,
            'min_answer' => $this->min_answer,
            'max_answer' => $this->max_answer,
            'user_id' => $this->user_id,
            'user_update_id' => $this->user_update_id,
            'date_created' => $this->date_created,
            'date_updated' => $this->date_updated,
        ]);

        $query->andFilterWhere(['like', 'tags', $this->tags]);

        return $dataProvider;
    }
}
