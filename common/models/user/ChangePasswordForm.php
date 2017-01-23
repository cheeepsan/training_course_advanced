<?php

namespace common\models\user;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class ChangePasswordForm extends Model
{

    public $password;
    //public $userName;
    //public $userSurname;
    //public $userWeight;
    //public $userDateOfBirth;
    //public $userGroups;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            // username and password are both required
            [['password'], 'required'],
            // rememberMe must be a boolean value
          //  ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
          //  ['password', 'validatePassword'],
        ];
    }

    public function changePassword($id) {
      $authUser = Users::findIdentity($id);
      //var_dump($authUser->password);
      $authUser->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
      //echo $this->password;
      //echo $authUser->password;
      //echo $authUser->validatePassword($this->password);

      return $authUser->save();


    }

}
