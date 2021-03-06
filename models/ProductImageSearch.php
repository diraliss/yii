<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ProductImageSearch represents the model behind the search form of `app\models\ProductImage`.
 */
class ProductImageSearch extends ProductImage
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_id'], 'integer'],
            [['url', 'is_title', 'created_at', 'updated_at'], 'safe'],
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
        $query = ProductImage::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query,
            ]
        );

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(
            [
                'id' => $this->id,
                'product_id' => $this->product_id,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ]
        );

        $query->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'is_title', $this->is_title]);

        return $dataProvider;
    }
}
