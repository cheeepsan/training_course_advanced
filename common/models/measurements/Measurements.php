<?php

namespace common\models\measurements;

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
class Measurements extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_measurements';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'comments', 'time_created'], 'string'],
            [['weight', 'breast', 'hip', 'legs', 'hand', 'user_id'], 'number'],
            //[['time_created'], 'date', 'format' => 'php:Y-m-d']

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



    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }


}
