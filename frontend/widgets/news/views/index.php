<?php 
use yii\helpers\Html;
use yii\widgets\ListView;
?>
    <div class="assigndiv">
            <h3>Latest news</h3>
            <div>
            <?= ListView::widget([
                    'summary'=>'', 
                    'dataProvider' => $dataProvider,
                    'itemOptions' => ['class' => 'item'],
                    'itemView' => function ($model, $key, $index, $widget) {
                            return Html::a(Html::encode($model->name), ['news/view', 'id' => $model->id]);
                    },
            ])?>
            </div>
     </div>