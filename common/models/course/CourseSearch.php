<?php

namespace common\models\course;

use Yii;
use yii\data\ActiveDataProvider;
class CourseSearch extends Course
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
            // ... more stuff here
            [['name', 'description'], 'safe'],
            [['start_date', 'end_date'], 'date'],
            [['status'], 'boolean'],
            // ... more stuff here
        ];
    }

    public function search($params) {

      $query = course::find();

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
      ->andFilterWhere(['=', 'status', $this->status])
      ->andFilterWhere(['like', 'start_date', $this->start_date])
      ->andFilterWhere(['like', 'end_date', $this->end_date]);

      return $dataProvider;
  }
}
