<?php

namespace common\models\measurements;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class AddMeasurementsForm extends Model
{
    public $name;
    public $description;
    public $status;
    public $start_date;
    public $end_date;



    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['description'], 'safe'],
            [['name', 'status'], 'required'],
            [['start_date', 'end_date'], 'date'],
            // rememberMe must be a boolean value
          //  ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
          //  ['password', 'validatePassword'],
        ];
    }

    public function addNewCourse() {
      $course = new Course();

    //  if(Course::findById($this->id) == NULL) {

          $course->name = $this->name;
          $course->description = $this->description;
          $course->status = $this->status;
          $course->start_date = $this->start_date;
          $course->end_date = $this->end_date;


        //  echo '<pre>';var_dump($course); die();
          return $course->save();
    //  }

    //  return false;

    }

}
