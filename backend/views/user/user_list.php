<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use kartik\grid\GridView;
use yii\helpers\Html;



$this->title = 'List users';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

<?php /*
    <?php $form = Html::beginForm([
        'measurements/bulkAdd',
        'options' => [


        ],
    ]); ?>
    <?= Html::input([]) ?>
    <div class="form-group">
        <?= Html::submitButton('Bulk add measurements', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php Html::endForm() */ ?>

<?php

echo GridView::widget([
    'dataProvider'=> $dataProvider,
    'filterModel' => $searchModel,
    //'columns' => $gridColumns,
    'responsive'=>true,
    'hover'=>true,
    'columns' => [
      [
        'attribute' => 'users.username',

      ],
      [
        'attribute' => 'name',

      ],
      [
        'attribute' => 'surname',

      ],

      [
        'attribute' => 'date_of_birth',

      ],
        [
            'class' => '\kartik\grid\ActionColumn',
            'deleteOptions' => [
                'label' => '<i class="glyphicon glyphicon-remove"></i>',
            ],
            'viewOptions' => [
                //'style' => 'display: none',
            ]

        ],

    ]

]);
?>
</div>
