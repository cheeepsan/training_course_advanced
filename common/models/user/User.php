<?php

namespace common\models\user;

use Yii;

/**
 * This is the model class for table "tbl_user_user".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $surname
 * @property integer $weight
 * @property string $date_of_birth
 * @property string $groups
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_user_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['weight'], 'number'],
            [['active'], 'boolean'],
            [['date_of_birth'], 'safe'],
            [['groups'], 'string'],
            [['name', 'surname'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'weight' => 'Weight',
            'date_of_birth' => 'Date Of Birth',
            'groups' => 'Groups',
        ];
    }
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
    /**
     * @inheritdoc
     */
    public function getUsers()
    {
      return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    public function getCourseUser() {

        return $this->hasMany(CourseUserMap::className(), ['user_id' => 'id']);
    }
    /**
     * FIND PARENT IDENTITY
     */
    public static function findParent($id)
    {
        return static::findOne(Users::className(), ['parent_id' => $id]);
    }
    /**
     * FIND BY PARENT
     */
    public static function findByParent($id)
    {
        return static::findOne(['user_id' => $id]);
    }
    public static function getUserFromIdentity() {
        return static::findOne(['user_id' =>  Yii::$app->user->identity->id]);
    }
}
