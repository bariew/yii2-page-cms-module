<?php

namespace bariew\pageModule\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use bariew\pageModule\models\Item;

/**
 * ItemSearch represents the model behind the search form about `bariew\pageModule\models\Item`.
 */
class ItemSearch extends Item
{
    public function rules()
    {
        return [
            [['id', 'pid', 'rank', 'visible'], 'integer'],
            [['title', 'brief', 'content', 'name', 'label', 'url', 'layout', 'page_title', 'page_description', 'page_keywords'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Item::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'pid' => $this->pid,
            'rank' => $this->rank,
            'visible' => $this->visible,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'brief', $this->brief])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'layout', $this->layout])
            ->andFilterWhere(['like', 'page_title', $this->page_title])
            ->andFilterWhere(['like', 'page_description', $this->page_description])
            ->andFilterWhere(['like', 'page_keywords', $this->page_keywords]);

        return $dataProvider;
    }
}
