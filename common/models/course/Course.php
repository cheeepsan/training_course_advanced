<?php

namespace common\models\course;

use Yii;
use common\models\task\Task;
use common\models\course\CourseUserMap;
/**
 * This is the model class for table "tbl_course".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $status
 * @property string $start_date
 * @property string $end_date
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_course';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['status'], 'integer'],
            [['start_date', 'end_date'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',

        ];
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            $tasks = Task::getAllByParentId($this->id);

            foreach ($tasks as $task) {
                if (!$task->delete()) {
                    return false;
                }
            }
            $map = CourseUserMap::findByCourseId($this->id);
            foreach ($map as $m) {
                if (!$m->delete()) {
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public static function findById($id)
    {
        return Course::find()->where(['id' => id])->one();
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourseUser()
    {

        return $this->hasMany(CourseUserMap::className(), ['course_id' => 'id']);
    }
}
