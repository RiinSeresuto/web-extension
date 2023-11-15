<?php

namespace common\modules\wfh\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\wfh\models\ReportDetails;

/**
 * ReportDetailsSearch represents the model behind the search form of `common\modules\wfh\models\ReportDetails`.
 */
class ReportDetailsSearch extends ReportDetails
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['employee_position', 'approval_name', 'approval_position'], 'safe'],
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
        $query = ReportDetails::find();

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
            'user_id' => Yii::$app->user->id,
        ]);

        $query->andFilterWhere(['like', 'employee_position', $this->employee_position])
            ->andFilterWhere(['like', 'approval_name', $this->approval_name])
            ->andFilterWhere(['like', 'approval_position', $this->approval_position]);

        return $dataProvider;
    }
}
