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

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'login', 'index'],
                'rules' => [
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
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
    public function actionIndex()
    {
        $events = array();

        $user = User::findByParent(Yii::$app->user->id);
        $courseUserMapArray = CourseUserMap::findAllByUserId($user->id);
        foreach ($courseUserMapArray as $courseUserMap) {
            $courseArray[] = Course::findIdentity($courseUserMap->course_id);
        }
        //IMAGINE THAT LATEST COURSE IS PICKED

        $course = ArrayHelper::toArray($courseArray[0]);
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

        return $this->goHome();
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
