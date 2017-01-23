<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\LoginForm;
use common\models\user\ChangePasswordForm;
use common\models\user\User;
use common\models\user\Users;
use common\models\ContactForm;
use common\models\user\AddUserForm;
use common\models\user\UserSearch;

class UserController extends Controller
{


    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    public function actionNewUser() {
        $model = new AddUserForm();

        if ($model->load(Yii::$app->request->post()) && $model->addNewUser()) {

            return $this->goBack();
        }

        return $this->render('addUser', [
          'model' => $model,
        ]);
    }
    /**
     * Displays users
     *
     * @return mixed
     */
     public function actionListUsers() {

       $searchModel = new UserSearch();
       //$searchModel->query()->where('role <> regular');
       $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

       return $this->render('user_list', [
           'searchModel' => $searchModel,
           'dataProvider' => $dataProvider,
       ]);
     }

     /**
      * Displays users
      *
      * @return mixed
      */
      public function actionViewUser($id) {
        $model = User::findIdentity($id);
        $modelPassword = new ChangePasswordForm();
        if (isset($_POST['delete'])) {

        }

        if ($model->load(Yii::$app->request->post())) {
          Yii::$app->session->setFlash('kv-detail-success', 'Changes saved');
          $model->save();
        }

        if ($modelPassword->load(Yii::$app->request->post())) {
          if ($modelPassword->changePassword($model->users->id)) {
            Yii::$app->session->setFlash('kv-detail-success', 'Password changed');
          } else {
            Yii::$app->session->setFlash('kv-detail-error', 'Error changing Password');
          }
        }

        return $this->render('user_view', [
            'model' => $model,
            'modelPassword' => $modelPassword,
        ]);
      }

}
