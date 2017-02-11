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
    <h2><?= Html::encode('Measurements') ?></h2>
    <?= Html::a('New Measurements', ['measurements/create', 'id' => $model->id],['class' => 'btn btn-success']); ?>
    <?php

    echo GridView::widget([
        'dataProvider' => $measurementsDataProvider,
        'filterModel' => $measurementsSearch,
        //'columns' => $gridColumns,
        'responsive' => true,
        'hover' => true,
        'toolbar' => ['{delete}',],
        'columns' => [


            [
                'attribute' => 'time_created',

            ],
            [
                'attribute' => 'weight',

            ],
            [
                'attribute' => 'breast',

            ],
            [
                'attribute' => 'hip',

            ],
            [
                'attribute' => 'legs',

            ],
            [
                'attribute' => 'hand',

            ],

            [
                'class' => '\kartik\grid\ActionColumn',
                'controller' => 'measurements',
                'deleteOptions' => [
                    'label' => '<i class="glyphicon glyphicon-remove"></i>',

                ],
                'viewOptions' => [
                    'style' => 'display: none',

                ],
            ]
        ]

    ]);
    ?>
</div>
