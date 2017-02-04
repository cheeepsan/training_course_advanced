<?php

namespace common\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\user\LoginForm;
use common\models\ChangePasswordForm;
use common\models\user\User;
use common\models\user\Users;
use common\models\ContactForm;
use common\models\user\AddUserForm;
use common\models\user\UserSearch;
use common\models\course\CourseUserMap;
use common\models\course\Course;
use yii\helpers\ArrayHelper;
use common\models\task\Task;
use yii\web\ForbiddenHttpException;

class MainController extends Controller
{
    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {

        if (parent::beforeAction($action)) {


            if (!\Yii::$app->user->can($action->id)) {

                throw new ForbiddenHttpException('Access denied');
            }
            if (\Yii::$app->user->identity != NULL && \Yii::$app->id == 1 && \Yii::$app->user->identity->group !== 'admin' ) {

                throw new ForbiddenHttpException('User has access only to frontend');
            }
            return true;
        } else {
            return false;
        }
    }

    public function behaviors()
    {
        return [
            //'access' => [
            //    'class' => AccessControl::className(),
            //    'only' => ['logout', 'login', 'index'],
            //    'rules' => [
            //        [
            //            'actions' => ['logout', 'index'],
            //            'allow' => true,
            //            'roles' => ['@'],
            //        ],
            //        [
            //            'actions' => ['login'],
            //            'allow' => true,
            //            'roles' => ['?'],
            //        ],
            //    ],
            //],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

}
