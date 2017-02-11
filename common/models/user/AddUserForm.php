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
class AddUserForm extends Model
{
    public $username;
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
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            ['username', 'email'],
            // rememberMe must be a boolean value
          //  ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
          //  ['password', 'validatePassword'],
        ];
    }

    public function addNewUser() {
      $authUser = new Users();

      if(Users::findByUsername($this->username) == NULL) {

          $authUser->username = $this->username;
          $authUser->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
          $authUser->authKey = \Yii::$app->security->generateRandomString();
          $authUser->accessToken = \Yii::$app->security->generateRandomString();
          $authUser->signup = Yii::$app->formatter->asDate('now', 'yyyy-MM-dd');

          return $authUser->save();
      }

      return false;

    }

}
