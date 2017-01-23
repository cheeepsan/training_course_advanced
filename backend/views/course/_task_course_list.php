<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */
use backend\controllers\SiteController;
use common\models\Users;
use common\models\UserSearch;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h2><?= Html::encode('Tasks') ?></h2>

    <?php

    echo GridView::widget([
        'dataProvider' => $taskDataProvider,
        'filterModel' => $taskSearch,
        //'columns' => $gridColumns,
        'responsive' => true,
        'hover' => true,
        'toolbar' => ['{delete}',],
        'columns' => [

            [
                'attribute' => 'name',

            ],
            [
                'attribute' => 'status',

            ],
            [
                'attribute' => 'create_date',

            ],
            [
                'attribute' => 'publish_date',

            ],
            /*      [
                    'label'  => 'link',
                    'format' => 'raw',
                    'value'  =>  function ($model) {
                                     return Html::a('view', ['task/view-task', 'id' => $model->id]);
                                 },
                  ],*/
            [
                'class' => '\kartik\grid\ActionColumn',
                'controller' => 'task',
                'deleteOptions' => [
                    'label' => '<i class="glyphicon glyphicon-remove"></i>',

                ],
            ]
        ]

    ]);
    ?>
</div>
