<?php

namespace common\models\measurements;
use Yii;
use common\models\task\TaskSubmit;
/**
 * This is the model class for table "tbl_course_user_map".
 *
 * @property integer $id
 * @property integer $course_id
 * @property integer $user_id
 * @property integer $permission_read
 * @property integer $permission_write
 */
class UserMeasurementsMap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_user_measurements_map';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['measurements_id', 'user_id', 'permission_read', 'permission_write'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [

        ];
    }
    public function beforeDelete()
    {
        if (parent::beforeDelete()) {

            return true;
        } else {
            return false;
        }
    }
    public function findByUserId($id) {
      return self::find()->where(['id' => id])->one();
    }
    public static function findAllByUserId($id) {
      
      return self::find()->where(['user_id' => $id])->all();
    }
    public static function findByMeasurmentsId($id) {
      return self::find()->where(['measurments_id' => $id])->orderBy('id')->all();
    }
    public static function findByUserMeasurmentsId($course_id, $user_id) {
      return self::find()->where(['course_id' => $course_id, 'user_id' => $user_id])->one();
    }
}
