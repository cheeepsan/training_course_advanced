<?php

namespace frontend\controllers;

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

class SiteController extends \common\controllers\MainController
{
    /**
     * @inheritdoc
     */
   // public function beforeAction($action)
   // {
//
   //     if (parent::beforeAction($action)) {
//
   //         if (!\Yii::$app->user->can($action->id)) {
//
   //             throw new ForbiddenHttpException('Access denied');
   //         }
   //         return true;
   //     } else {
   //         return false;
   //     }
   // }

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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()//
    {
        if (\Yii::$app->getUser()->isGuest) {

            return $this->redirect(['site/login']);
        }
        $events = array();
        $course = NULL;
        $user = User::findByParent(Yii::$app->user->id);
        $course = Course::findIdentity($user->current_course);
        if ($course != NULL) {

            $tasks = Task::getAllByParentId($course);
            foreach ($tasks as $task) {
                if ($task->publish_date == null) continue;
                $event = new \yii2fullcalendar\models\Event();
                $event->id = $task->id;
                $event->title = $task->name;
                $event->description = $task->description;
                $event->start = $task->publish_date;
                $events[] = $event;
            }
        } else {
            $events = NULL;

        }
        return $this->render('index', ['course' => $course, 'events' => $events]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {

        if (!Yii::$app->user->isGuest) {

            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //  echo '<pre>';var_dump(Yii::$app->user);
            //  die();
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['site/login']);
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionTest()
    {
        $this->goHome();
        die();
    }
}
