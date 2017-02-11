<?php 
use yii\helpers\Html;
use yii\helpers\Url;

$path = Url::to('@web/images/assigment.jpg');
?>
    <div class="assigndiv">
       <?= Html::a(' <h3>Latest assigment: '. $task->name . ' </h3>', ['task/view-task', 'id' => $task->id]) ?>
        <div>
        <?= Html::a('<div class="assigment-pic background" style="background: url('. $path .' ) no-repeat center top;"></div>', ['task/view-task', 'id' => $task->id]) ?>

        </div>
        
        <?= Html::a('Read more <i class="fa fa-chevron-right" aria-hidden="true"></i>', ['task/view-task', 'id' => $task->id], ['class' => 'btn-front-page']); ?>
    </div>