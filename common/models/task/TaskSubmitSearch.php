<?php

namespace common\models\task;

use Yii;
use yii\data\ActiveDataProvider;

class TaskSubmitSearch extends TaskSubmit
{


    // now set the rules to make those attributes safe
    public function rules()
    {

    }

    public function search($params, $parent_id = NULL)
    {

        $query = TaskSubmit::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,

        ]);

        // No search? Then return data Provider
        //if (!($this->load($params) && $this->validate())) {
        //
        //    return $dataProvider;
        //}

        // We have to do some search... Lets do some magic

        if (isset($parent_id)) {
            $query->andFilterWhere(['=', 'parent_id', $parent_id]);
        }


        return $dataProvider;
    }
}
