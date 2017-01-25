<?php

namespace common\models\task;

use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;
use common\models\task\TaskSubmit;
use common\models\course\CourseUserMap;
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
    public $files;

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
            [['description', 'upload'], 'string'],
            [['status', 'parent_id'], 'integer'],
            [['create_date', 'publish_date'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['files'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf, png, jpg'],
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
            'publish_date' => 'Deadline',

        ];
    }

    public static function findById($id)
    {
        return Task::find()->where(['id' => id])->one();
    }

    public function upload()
    {
        if ($this->validate()) {

            $this->files = UploadedFile::getInstance($this, 'files');
            if ($this->files != null) {
                $this->files->saveAs(Yii::getAlias('@frontend') . '/web/uploads/' . $this->files->baseName . '.' . $this->files->extension);

                $this->upload = '/uploads/' . $this->files->baseName . '.' . $this->files->extension;
                $this->files = null;

            }

            return true;
        } else {
            return false;
        }
    }
    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            $submits = TaskSubmit::getAllByParentId($this->id);
            foreach ($submits as $submit) {
                $submit->delete();
            }
            return true;
        } else {
            return false;
        }
    }
    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
           $courseMap = CourseUserMap::findByCourseId($this->parent_id);
            foreach ($courseMap as $course) {
                $submitTask = new TaskSubmit(['user_id' => $course->user_id, 'parent_id' => $this->id]);
                if ($submitTask->save()) {
                    echo 'te';
                } else {
                    print_r($submitTask->getErrors());
                }

           }
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            return true;
        } else {
            return false;
        }
    }

    public function afterFind()
    {
        parent::afterFind();

    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function getAllByParentId($parentId)
    {

        return Task::find()->where(['parent_id' => $parentId])->all();
    }

    public static function getLatestTask($parentId)
    {

        return Task::find()->where(['parent_id' => $parentId])->orderBy('publish_date DESC')->one();
    }
}
