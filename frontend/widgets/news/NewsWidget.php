<?php
namespace frontend\widgets\news;

use yii\base\Widget;
use yii\helpers\Html;
use common\models\news\NewsSearch;

class NewsWidget extends Widget {
        public function init()
        {
            parent::init();
        }

        public function run()
        {
            $searchModel = new NewsSearch();
            $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
            
            return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
        }
}