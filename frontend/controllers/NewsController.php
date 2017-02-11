<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\news\AddNewsForm;
use common\models\news\NewsSearch;
use common\models\news\News;
use yii\helpers\ArrayHelper;

class NewsController extends \common\controllers\MainController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [


        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],

        ];
    }

    public function actionListNews() {
      $searchModel = new NewsSearch();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

      return $this->render('news_list', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
      ]);


    }

    public function actionNewArticle() {
      $model = new AddNewsForm();
      if ($model->load(Yii::$app->request->post()) && $model->addNewNews()) {
            Yii::$app->session->setFlash('success', 'Article created');

      }
        return $this->render('addNews', [
          'model' => $model,
        ]);
    }

    /**
     * Displays users
     *
     * @return mixed
     */
     public function actionViewNews($id) {

       $model = News::findIdentity($id);


       if ($model->load(Yii::$app->request->post())) {

       }


       return $this->render('news_view', [
           'model' => $model,
       ]);
     }
    public function actionView($id) {
        $model = News::findIdentity($id);
            
        return $this->render('view', [
           'model' => $model,
       ]);
    }

}
