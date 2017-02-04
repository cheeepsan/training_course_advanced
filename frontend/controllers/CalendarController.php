<?php

namespace frontend\controllers;


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
class CalendarController extends \common\controllers\MainController {

  public function actionIndex() {
    $tasks = Task::find()->all();
    $events = array();

    foreach ($tasks as $task) {
      $event = new \yii2fullcalendar\models\Event();
      $event->id = $task->id;
      $event->title = $task->name;
      $event->description = $task->description;
      $event->start = $task->publish_date;
      $events[] = $event;
    }




    return $this->render('index', ['events' => $events]);
  }
}
