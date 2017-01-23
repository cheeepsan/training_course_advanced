<?php

namespace common\models\user;

use Yii;
use yii\data\ActiveDataProvider;
class UserSearch extends User
{
    // add the public attributes that will be used to store the data to be search
    public $name;
    public $surname;
    public $username;

    // now set the rules to make those attributes safe
    public function rules()
    {
        return [
            // ... more stuff here
            [['name', 'surname', 'username'], 'safe'],
            // ... more stuff here
        ];
    }

    public function search($params) {

      $query = user::find()
      ->joinWith(['users u']);

      $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'pagination' => [
            'pageSize' => 10,
        ],
        'sort' => [
            'defaultOrder' => [
                //'username' => SORT_ASC, //todo, sort by username
                'name' => SORT_ASC,
                'surname' => SORT_ASC,
                'weight' => SORT_ASC
            ]
        ],
      ]);

      // No search? Then return data Provider
      if (!($this->load($params) && $this->validate())) {
          return $dataProvider;
      }

      // We have to do some search... Lets do some magic
      $query
      ->andFilterWhere(['like', 'username', $this->username])
      ->andFilterWhere(['like', 'name', $this->name])
      ->andFilterWhere(['like', 'surname', $this->surname])
      ->andFilterWhere(['=', 'weight', $this->weight])
      ->andFilterWhere(['=', 'active', $this->active])
      ->andFilterWhere(['like', 'date_of_birth', $this->date_of_birth]);

      return $dataProvider;
  }
}
