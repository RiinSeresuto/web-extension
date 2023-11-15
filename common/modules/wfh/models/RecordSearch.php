<?php

namespace common\modules\wfh\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\wfh\models\Record;
use kartik\daterange\DateRangeBehavior;

/**
 * RecordSearch represents the model behind the search form of `common\modules\wfh\models\Record`.
 */
class RecordSearch extends Record
{
	public $time_in_range;
	public $time_in_range_start;
	public $time_in_range_end;
	public $without_time_out;
	
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'without_time_out'], 'integer'],
            [['user_id', 'time_in', 'time_out', 'time_in_range'], 'safe'],
        ];
    }
	
	public function behaviors()
	{
		return [
            [
                'class' => DateRangeBehavior::className(),
                'attribute' => 'time_in_range',
                'dateStartAttribute' => 'time_in_range_start',
                'dateEndAttribute' => 'time_in_range_end',
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
        $query = Record::find();

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
		
		if($this->time_in_range_start && $this->time_in_range_end){
			$query->andFilterWhere(['and',
				['>=', 'time_in', date('Y-m-d 00:00:00', $this->time_in_range_start)],
				['<=', 'time_in', date('Y-m-d 23:59:59', $this->time_in_range_end)],
			]);
		}
		
		if($this->without_time_out == 1){
			$query->andWhere(['IS NOT', 'time_out', null]);
		}else if($this->without_time_out == 2){
			$query->andWhere(['time_out' => null]);
		}

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'time_in' => $this->time_in,
            'time_out' => $this->time_out,
        ]);

        return $dataProvider;
    }
}
