<?php

namespace backend\controllers;


use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\task\AddTaskForm;
use common\models\task\Task;
use common\models\task\TaskSearch;
use yii\web\UploadedFile;
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
    public function actionDelete($id) {
        $model = $this->findModel($id);
        $course_id = $model->parent_id;
        if ($model->delete()) {
            $this->redirect(['course/view', 'id' => $course_id]);
        } else {
            $this->redirect(['course/view', 'id' => $course_id]);
        }
    }
    public function actionListTasks($course)
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('task_list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);


    }

    public function actionListAllTasks()
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('task_list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) {
            $model->files = UploadedFile::getInstance($model, 'files');
            if ($model->upload()) {
                $model->save();
                Yii::$app->session->setFlash('success', 'Task updated');
            }
        }
        return $this->render('updateTask', [
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
    public function actionView($id)
    {
        $nameIdMap = array();
        $initialData = array();

        $model = Task::findIdentity($id);

        return $this->render('task_view', [
            'model' => $model,
        ]);
    }
    private function findModel($id) {
        return Task::findOne(['id' => $id]);
    }

}
