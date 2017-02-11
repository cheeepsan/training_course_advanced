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
class TaskSubmit extends \yii\db\ActiveRecord
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_task_submit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comment'], 'string'],
            [['user_id', 'parent_id', 'done'], 'integer'],
            [['create_date', 'publish_date'], 'safe'],
            [['done_date'], 'date'],
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        
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

        return static::find()->where(['parent_id' => $parentId])->all();
    }
    public static function getByParentId($parentId)
    {

        return static::findOne(['parent_id' => $parentId]);
    }
    public static function getByUserId($userId) {
        return static::find()->where(['user_id' => $userId])->all();
    }
}
