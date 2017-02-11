<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */
use app\controllers\SiteController;
use app\models\Users;
use app\models\UserSearch;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = 'List courses';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

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
                'attribute' => 'status',

            ],
            [
                'attribute' => 'start_date',

            ],
            [
                'attribute' => 'end_date',

            ],
            [
                'class' => '\kartik\grid\ActionColumn',
                'deleteOptions' => [
                    'label' => '<i class="glyphicon glyphicon-remove"></i>',
                ],
                'updateOptions' => [
                        'style' => 'display: none',
                ]

            ],
        ],
    ]);
    ?>
</div>
