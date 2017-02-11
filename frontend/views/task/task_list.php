<?php


use common\models\user\Users;
use common\models\user\User;
use common\models\user\UserSearch;
use common\models\task\TaskSubmit;
use kartik\grid\GridView;
use yii\helpers\Html;


$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <?php
    foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
        echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
    }
    ?>
    <h1>Course: <?= $course->name ?></h1>
    <h2>Assigments</h2>

    <?php

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        //'columns' => $gridColumns,
        'responsive' => true,
        'hover' => true,
        'columns' => [

            [
                'attribute' => 'name',

            ],
            [
                'attribute' => 'publish_date',

            ],
            [
                'label' => 'Задание',
                'format' => 'raw',
                'value' => function ($model) {
                    $path = \yii\helpers\Url::Base() . $model->upload;
                    if  (empty($model->upload)) {
                        return 'Файла нет';
                    }
                    return Html::a('PDF', $path);
                },
            ],
            [
                'label' => 'Задание',
                'format' => 'raw',
                'value' => function ($model) {
                    $user = User::getUserFromIdentity();
                    $submit = TaskSubmit::find()->where(['user_id' => $user->id, 'parent_id' => $model->id])->one();
                    if ($submit == NULL) {
                        return '<i class="fa fa-check-square-o" aria-hidden="true"></i>';
                    }
                    $isDone = $submit->done;
                    if ($isDone) {
                        return '<i class="fa fa-check-square-o" aria-hidden="true"></i>';
                    } else {
                        return Html::a('Сдать задание <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', ['task/complete-task', 'id' => $submit->id]);
                    }

                },
            ]

        ]

    ]);
    ?>
</div>
