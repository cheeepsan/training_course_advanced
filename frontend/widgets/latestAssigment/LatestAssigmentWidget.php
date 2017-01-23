<?php
namespace frontend\widgets\latestAssigment;

use yii\base\Widget;
use yii\helpers\Html;
use common\models\task\Task;

    class LatestAssigmentWidget extends Widget
    {
        public $course;
    
        public function init()
        {
            parent::init();
            
        }
        
        public function run()
        {
            $task = $this->latestTask();
            if ($task == null) {
                return $this->render('empty', ['task' => $task]);
            }
            return $this->render('index', ['task' => $task]);
        }
        
        protected function latestTask() {
            return Task::getLatestTask($this->course);
        }
    }