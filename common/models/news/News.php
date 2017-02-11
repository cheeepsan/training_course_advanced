<?php

namespace common\models\news;

use Yii;

/**
 * This is the model class for table "tbl_news".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $status
 * @property string $start_date
 * @property string $end_date
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name',], 'required'],
            [['description'], 'string'],
            [['status'], 'integer'],
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
            'name' => 'Tile',
            'description' => 'Text',
            'status' => 'Status',
            'create_date' => 'Create date',
            'publish_date' => 'Publish date',

        ];
    }

    public static function findById($id) {
      return News::find()->where(['id' => id])->one();
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }



}
