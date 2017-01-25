<?php

namespace frontend\controllers;


use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\task\AddTaskForm;
use common\models\task\Task;
use common\models\task\TaskSearch;
use common\models\course\Course;
use common\models\user\User;
use common\models\course\CourseUserMap;
use yii\helpers\ArrayHelper;
use common\models\task\TaskSubmit;
class TaskController extends Controller
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

    public function actionListAllTasks()
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $user = User::findByParent(Yii::$app->user->id);
        $courseUserMapArray = CourseUserMap::findAllByUserId($user->id);
        foreach ($courseUserMapArray as $courseUserMap) {
            $courseArray[] = Course::findIdentity($courseUserMap->course_id);

        }
        //IMAGINE THAT LATEST COURSE IS PICKED

        $course = $courseArray[0];

        return $this->render('task_list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'course' => $course,
        ]);
    }


    public function actionNewTask()
    {
        $model = new AddTaskForm();
        if ($model->load(Yii::$app->request->post()) && $model->addNewTask()) {
            Yii::$app->session->setFlash('success', 'Task created');

        }
        return $this->render('addTask', [
            'model' => $model,
        ]);
    }

    public function actionNewTaskFromParent($parent_id)
    {
        $model = new AddTaskForm();
        $model->parent_id = $parent_id;
        if ($model->load(Yii::$app->request->post()) && $model->addNewTask()) {
            Yii::$app->session->setFlash('success', 'Task created');


        }
        return $this->render('addTask', [
            'model' => $model,
        ]);
    }

    /**
     * Displays users
     *
     * @return mixed
     */
    public function actionViewTask($id)
    {
        $nameIdMap = array();
        $initialData = array();

        $model = Task::findIdentity($id);

        return $this->render('task_view', [
            'model' => $model,
        ]);
    }

    public function actionIndex()
    {


    }

    public function actionCompleteTask($id = NULL) {
        //if ($id == NULL) {

        //}
        $model = TaskSubmit::findIdentity($id);
        $task = Task::findIdentity($model->parent_id);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->done = 1;
            $model->done_date = Yii::$app->formatter->asDate('now');
            if ($model->save()) {

            } else {
                var_dump($model->getErrors()); die();
                Yii::$app->session->setFlash('danger', 'Task not saved');
                return $this->redirect(['task/list-all-tasks']);
            }
            Yii::$app->session->setFlash('success', 'Task completed');
            return $this->redirect(['task/list-all-tasks']);

        }
        return $this->render('complete', ['model' => $model, 'task' => $task]);

    }
    public function actionSaveTask() {

        $model = TaskSubmit::findIdentity(Yii::$app->request->post()['TaskSubmit']['id']);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->done = 1;
            $model->done_date = Yii::$app->formatter->asDate('now');
            if ($model->save()) {

            } else {
                var_dump($model->getErrors()); die();
                Yii::$app->session->setFlash('danger', 'Task not saved');
                return $this->redirect(['task/list-all-tasks']);
            }
            Yii::$app->session->setFlash('success', 'Task completed');
            return $this->redirect(['task/list-all-tasks']);

        }
        Yii::$app->session->setFlash('danger', 'Task not saved');
        return $this->redirect(['task/list-all-tasks']);
    }
}
