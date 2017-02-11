<?php

namespace common\models\user;

use Yii;
use common\models\course\CourseUserMap;
use common\models\user\User;
use common\models\task\TaskSubmit;
/**
 * This is the model class for table "tbl_user_users".
 *
 * @property integer $id
 * @property string $password
 * @property string $signup
 * @property string $last_login
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
  public $user_id;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_user_users';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['password', 'authKey', 'accessToken', 'user_id', 'identityClass', 'identityCookie', 'group'], 'string'],
            [['signup', 'last_login'], 'safe'],

            [['enableAutoLogin'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'password' => 'Password',
            'signup' => 'Signup',
            'last_login' => 'Last Login',
            'userName' => 'Name',
            'userSurname' => 'Surname'
        ];
    }
    /**
     * @inheritdoc
     */
    public static function findByUsername($username) {
      return Users::find()->where(['username' => $username])->one();
    }

    /**
     * @inheritdoc
     */
    public function validatePassword($password) {

      if (Yii::$app->getSecurity()->validatePassword($password, $this->password)) {
          return true;
      }
      return false;
    }
    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {

        return Users::find()->where(['id' => $id])->one();
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {

        return Users::find()->where(['accessToken' => $token])->one();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function afterSave() {

      if (Users::findIdentity($this->id) != null && User::findByParent($this->id) == null) {
        $user = new User();
        $user->user_id = $this->id;
        //$user->name = $this->userName;
        //$user->surname = $this->userLastname;
        $user->save();
      }
    }
    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            $courseUserMap = CourseUserMap::findAllByUserId($this->id);
            $user = User::findIdentity($this->id);
            $taskSubmits = TaskSubmit::getByUserId($user->id);
            foreach ($taskSubmits as $taskSubmit) {
                if ($taskSubmit->delete()) {

                } else {
                    return false;
                }
            }
            foreach ($courseUserMap as $model) {
                if ($model->delete()) {

                } else {
                    return false;
                }
            }
            if ($user->delete()) {

            } else {
                return false;
            }
            return true;
        } else {
            return false;
        }
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            if ($this->isNewRecord) {
                $this->group = 'user';
            }
            return true;
        } else {
            return false;
        }
    }
    public function getUser() {
      return $this->hasOne(User::className(), ['user_id' => 'id']);
    }

    public function changePassword($id) {
      $authUser = Users::findIdentity($id);

      $authUser->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);

      return $authUser->save();
    }


}
