<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * MusicAlbumSearch represents the model behind the search form of `app\modules\admin\models\MusicAlbum`.
 */
class MusicAlbumSearch extends MusicAlbum
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at', 'type'], 'integer'],
            [['name_ru', 'name_en', 'cover_ru', 'cover_en', 'links', 'description_ru', 'description_en',
                'authors_ru', 'authors_en'], 'safe'],
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
        $query = MusicAlbum::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'forcePageParam' => false,
                'pageSizeParam' => false,
                'pageSize' => 10
            ]
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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['ilike', 'name_ru', $this->name_ru])
            ->andFilterWhere(['ilike', 'name_en', $this->name_en])
            ->andFilterWhere(['ilike', 'cover_ru', $this->cover_ru])
            ->andFilterWhere(['ilike', 'cover_en', $this->cover_en])
            ->andFilterWhere(['ilike', 'links', $this->links])
            ->andFilterWhere(['ilike', 'description_ru', $this->description_ru])
            ->andFilterWhere(['ilike', 'description_en', $this->description_en])
            ->andFilterWhere(['ilike', 'authors_ru', $this->authors_ru])
            ->andFilterWhere(['ilike', 'authors_en', $this->authors_en]);

        return $dataProvider;
    }
}
