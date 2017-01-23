<?php

namespace common\models\task;

use Yii;

/**
 * This is the model class for table "tbl_Task".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $status
 * @property string $start_date
 * @property string $end_date
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_course_tasks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name',], 'required'],
            [['description'], 'string'],
            [['status', 'parent_id'], 'integer'],
            [['create_date', 'publish_date'], 'safe'],
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
            'parent_id' => 'Parent id',
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status',
            'create_date' => 'Start Date',
            'publish_date' => 'End Date',

        ];
    }

    public static function findById($id) {
      return Task::find()->where(['id' => id])->one();
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function getAllByParentId($parentId) {

        return Task::find()->where(['parent_id' => $parentId])->all();
    }
    public static function getLatestTask($parentId) {
        
        return Task::find()->where(['parent_id' => $parentId])->orderBy('publish_date DESC')->one();
    }
}
