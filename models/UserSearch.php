<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'role_id'], 'integer'],
            [['name', 'email', 'password', 'created_at', 'updated_at', 'auth_key', 'reset_token'], 'safe'],
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
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        $user = User::find()->where(['id' => \Yii::$app->user->id])->one();
        if ($user->role->name !== Role::ADMINISTRATOR) {
            $con_ids = [];
            foreach ($user->connection as $con) {
                $con_ids[] = $con->patient_id;
            }
            if (empty($con_ids)) {
                $con_ids[0] = 0;
            }
            $query->andFilterWhere(['IN', 'id', $con_ids]);
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'role_id' => $this->role_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'reset_token', $this->reset_token]);

        return $dataProvider;
    }
}
