<?php

namespace common\models\task;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class AddTaskForm extends Model
{
    public $name;
    public $description;
    public $status;
    public $create_date;
    public $publish_date;
    public $parent_id;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['description', 'parent_id'], 'safe'],
            [['name', 'status'], 'required'],
            [['create_date', 'publish_date'], 'date'],
            // rememberMe must be a boolean value
            //  ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            //  ['password', 'validatePassword'],
        ];
    }

    public function addNewTask()
    {
        $task = new Task();

        //  if(Task::findById($this->id) == NULL) {

        $task->name = $this->name;
        $task->description = $this->description;
        $task->status = $this->status;
        $task->create_date = $this->create_date;
        $task->publish_date = $this->publish_date;
        $task->parent_id = $this->parent_id;


        //  echo '<pre>';var_dump($course); die();
        return $task->save();
        //  }

        //  return false;

    }

}
