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
use yii\web\ForbiddenHttpException;

class UserController extends \common\controllers\MainController
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


    /*
     * Displays users
     *
     * @return mixed
     */
    public function actionViewUser() {

        //if (\Yii::$app->user->identity->id !== (int)$id) {
        //    throw new ForbiddenHttpException('No access');
        //}
        $id = \Yii::$app->user->identity->id;
        $model = User::findByParent($id);
        $modelPassword = new ChangePasswordForm();
        if (isset($_POST['delete'])) {

        }

        if (Yii::$app->request->post() && $model->load(Yii::$app->request->post())) {

            Yii::$app->session->setFlash('kv-detail-success', 'Changes saved');
            if ($model->save()) {
                //echo '<pre>';var_dump($model);die();
            } else {
                //echo '<pre>';var_dump($model->getErrors());die();
            }
            $this->redirect(['user/view-user']);
        } else {

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
