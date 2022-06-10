<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Person;

/**
 * PersonSearch represents the model behind the search form of `app\models\Person`.
 */
class PersonSearch extends Person
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nation_id', 'user_id'], 'integer'],
            [['fname', 'lname', 'mname', 'bdate', 'sex', 'created_at', 'updated_at', 'image'], 'safe'],
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
        $query = Person::find();

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
            'bdate' => $this->bdate,
            'nation_id' => $this->nation_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['ilike', 'fname', $this->fname])
            ->andFilterWhere(['ilike', 'lname', $this->lname])
            ->andFilterWhere(['ilike', 'mname', $this->mname])
            ->andFilterWhere(['ilike', 'sex', $this->sex])
            ->andFilterWhere(['ilike', 'image', $this->image]);

        return $dataProvider;
    }
}
