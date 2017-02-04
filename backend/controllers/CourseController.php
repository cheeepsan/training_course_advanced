<?php

namespace backend\controllers;


use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\course\AddCourseForm;
use common\models\course\CourseSearch;
use common\models\course\Course;
use common\models\course\CourseUserMap;
use common\models\user\UserSearch;
use yii\helpers\ArrayHelper;
use common\models\task\Task;
use common\models\task\TaskSearch;

class CourseController extends \common\controllers\MainController
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

    public function actionListCourses()
    {
        $searchModel = new CourseSearch();
        //$searchModel->query()->where('role <> regular');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('course_list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);


    }

    public function actionNewCourse()
    {
        $model = new AddCourseForm();
        if ($model->load(Yii::$app->request->post()) && $model->addNewCourse()) {
            Yii::$app->session->setFlash('success', 'Course created');

        }
        return $this->render('addCourse', [
            'model' => $model,
        ]);
    }

    /**
     * Displays users
     *
     * @return mixed
     */
    public function actionView($id)
    {
        $nameIdMap = array();
        $initialData = array();

        $model = Course::findIdentity($id);

        $taskSearch = new TaskSearch();
        $taskSearch->parent_id = $id;
        //var_dump($taskSearch); die();
        $taskDataProvider = $taskSearch->search(Yii::$app->request->queryParams, ['parent_id' => $id]);


        if ($model->load(Yii::$app->request->post())) { //TODO HANDLE DATA BETTER, NOT THIS SHIT
            $mapArray = CourseUserMap::findByCourseId($id);
            $toDelete = array();
            $toPersist = array();
            $toAdd = array();

            foreach ($mapArray as $i => $map) {
                $toDelete[$map->user_id] = $map->user_id;
            }

            if (isset($_POST['Participants'])) {
                $participants = $_POST['Participants'];


                foreach ($mapArray as $i => $map) {
                    foreach ($participants as $j => $p) {
                        if ($map->user_id == $p) {
                            $toPersist[] .= $map->user_id;
                            ArrayHelper::remove($participants, $j);
                            ArrayHelper::remove($toDelete, $map->user_id);
                        }
                    }
                }
                $toAdd = $participants;
                //delete data form map

                foreach ($toDelete as $key => $user_id) {
                    if (CourseUserMap::findByCourseUserId($id, $user_id)) {
                        CourseUserMap::findByCourseUserId($id, $user_id)->delete();
                    }
                }
                //add data

                foreach ($toAdd as $key => $user_id) {
                    if (!CourseUserMap::findByCourseUserId($id, $user_id)) {
                        $mapData = new CourseUserMap();
                        $mapData->course_id = $id;
                        $mapData->user_id = $user_id;
                        $mapData->save();
                    }
                }
                Yii::$app->session->setFlash('kv-detail-success', 'Changes saved');
                $model->save();
                //return $this->refresh();

            } else {

                foreach ($toDelete as $key => $user_id) {
                    if (CourseUserMap::findByCourseUserId($id, $user_id)) {
                        CourseUserMap::findByCourseUserId($id, $user_id)->delete();
                    }
                }

            }
        }
        $userSearch = new UserSearch();
        $dataProvider = $userSearch->search(Yii::$app->request->queryParams);

        $models = $dataProvider->getModels();
        $courseUserMap = $model->courseUser;
        $nameIdMap = ArrayHelper::map($models, 'id', 'users.username'); //getting related table

        foreach ($courseUserMap as $i => $pair) {
            if (ArrayHelper::keyExists($pair->user_id, $nameIdMap)) {
                $initialData[] .= $pair->user_id;
            }
        }


        return $this->render('course_view', [
            'model' => $model,
            'searchModel' => $userSearch,
            'dataProvider' => $dataProvider,
            'initialData' => $initialData,
            'nameIdMap' => $nameIdMap,
            'taskSearch' => $taskSearch,
            'taskDataProvider' => $taskDataProvider
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->delete()) {
            $this->redirect(['course/list-courses']);
        } else {
            $this->redirect(['course/list-courses']);
        }
    }

    private function findModel($id)
    {
        return Course::findOne(['id' => $id]);
    }

}
