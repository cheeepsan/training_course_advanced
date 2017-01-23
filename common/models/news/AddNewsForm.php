<?php

namespace common\models\news;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class AddNewsForm extends Model
{
    public $name;
    public $description;
    public $status;
    public $create_date;
    public $publish_date;




    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [

            [['description', 'parent_id'], 'safe'],
            [['name', 'status'], 'required'],
            [['create_date', 'publish_date'], 'date'],

        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tile',
            'description' => 'Text',
            'status' => 'Status',
            'create_date' => 'Create date',
            'publish_date' => 'Publish date',

        ];
    }
    public function addNewNews() {
      $news = new News();



          $news->name = $this->name;
          $news->description = $this->description;
          $news->status = $this->status;
          $news->create_date = $this->create_date;
          $news->publish_date = $this->publish_date;

          return $news->save();
    }

}
