<?php

namespace common\models\news;

use Yii;
use yii\data\ActiveDataProvider;
class NewsSearch extends News
{
    // add the public attributes that will be used to store the data to be search
    public $name;
    public $description;
    public $status;
    public $start_date;
    public $end_date;

    // now set the rules to make those attributes safe
    public function rules()
    {
      return [
          [['name',], 'required'],
          [['description'], 'string'],
          [['status'], 'integer'],
          [['create_date', 'publish_date'], 'safe'],
          [['name'], 'string', 'max' => 255],
      ];
    }
    public function search($params) {

      $query = News::find();

      $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'pagination' => [
            'pageSize' => 10,
        ],
        'sort' => [
            'defaultOrder' => [
                //'username' => SORT_ASC, //todo, sort by username
                'name' => SORT_ASC,
              ]
        ],
      ]);

      // No search? Then return data Provider
      if (!($this->load($params) && $this->validate())) {

          return $dataProvider;
      }

      // We have to do some search... Lets do some magic
      $query
      ->andFilterWhere(['like', 'name', $this->name])
      ->andFilterWhere(['like', 'description', $this->description])
      ->andFilterWhere(['=', 'status', $this->status]);
    
      $query->andFilterWhere(['like', 'create_date', $this->start_date])
      ->andFilterWhere(['like', 'publish_date', $this->end_date]);

      return $dataProvider;
  }
}
