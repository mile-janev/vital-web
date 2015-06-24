<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Medication;

/**
 * MedicationSearch represents the model behind the search form about `app\models\Medication`.
 */
class MedicationSearch extends Medication
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'strength', 'patient_id', 'prescribed_by_id'], 'integer'],
            [['rx_number', 'name', 'strength_measure', 'schedule', 'note'], 'safe'],
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

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Medication::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'strength' => $this->strength,
            'patient_id' => $this->patient_id,
            'prescribed_by_id' => $this->prescribed_by_id,
        ]);

        $query->andFilterWhere(['like', 'rx_number', $this->rx_number])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'strength_measure', $this->strength_measure])
            ->andFilterWhere(['like', 'schedule', $this->schedule])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
