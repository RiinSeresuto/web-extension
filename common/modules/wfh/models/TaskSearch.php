<?php

namespace common\modules\wfh\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\wfh\models\Task;
use kartik\daterange\DateRangeBehavior;

/**
 * TaskSearch represents the model behind the search form of `common\modules\wfh\models\Task`.
 */
class TaskSearch extends Task
{
	public $start_date_range;
	public $start_date_range_start;
	public $start_date_range_end;
	public $end_date_range;
	public $end_date_range_start;
	public $end_date_range_end;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'encoded_by'], 'integer'],
            [['user_id', 'start_date', 'end_date', 'status', 'description', 'reason', 'start_date_range', 'end_date_range'], 'safe'],
        ];
    }
	
	public function behaviors()
	{
		return [
            [
                'class' => DateRangeBehavior::className(),
                'attribute' => 'start_date_range',
                'dateStartAttribute' => 'start_date_range_start',
                'dateEndAttribute' => 'start_date_range_end',
            ],
            [
                'class' => DateRangeBehavior::className(),
                'attribute' => 'end_date_range',
                'dateStartAttribute' => 'end_date_range_start',
                'dateEndAttribute' => 'end_date_range_end',
            ],
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
        $query = Task::find()->joinWith(['user', 'encodedBy', 'user.userinfo', 'encodedBy.userinfo']);

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

		if($this->start_date_range_start && $this->start_date_range_end){
			$query->andFilterWhere(['and',
				['>=', 'start_date', date('Y-m-d 00:00:00', $this->start_date_range_start)],
				['<=', 'start_date', date('Y-m-d 23:59:59', $this->start_date_range_end)],
			]);
		}
		
		if($this->end_date_range_start && $this->end_date_range_end){
			$query->andFilterWhere(['and',
				['>=', 'end_date', date('Y-m-d 00:00:00', $this->end_date_range_start)],
				['<=', 'end_date', date('Y-m-d 23:59:59', $this->end_date_range_end)],
			]);
		}

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            Task::tableName().'.user_id' => $this->user_id,
            'encoded_by' => $this->encoded_by,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
			'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'reason', $this->reason]);

        return $dataProvider;
    }
}
