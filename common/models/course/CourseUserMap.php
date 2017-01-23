<?php

namespace common\models\course;
use Yii;

/**
 * This is the model class for table "tbl_course_user_map".
 *
 * @property integer $id
 * @property integer $course_id
 * @property integer $user_id
 * @property integer $permission_read
 * @property integer $permission_write
 */
class CourseUserMap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_course_user_map';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_id', 'user_id', 'permission_read', 'permission_write'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'course_id' => 'Course ID',
            'user_id' => 'User ID',
            'permission_read' => 'Permission Read',
            'permission_write' => 'Permission Write',
        ];
    }

    public function findByUserId($id) {
      return CourseUserMap::find()->where(['id' => id])->one();
    }
    public static function findAllByUserId($id) {
      
      return CourseUserMap::find()->where(['user_id' => $id])->all();
    }
    public static function findByCourseId($id) {
      return CourseUserMap::find()->where(['course_id' => $id])->orderBy('id')->all();
    }
    public static function findByCourseUserId($course_id, $user_id) {
      return CourseUserMap::find()->where(['course_id' => $course_id, 'user_id' => $user_id])->one();
    }
}
