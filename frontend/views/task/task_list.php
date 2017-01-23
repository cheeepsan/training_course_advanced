<?php


use app\controllers\SiteController;
use common\models\Users;
use common\models\UserSearch;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;




$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1>Course: <?= </h1>
    <h2><?= Html::encode('Tasks') ?></h2>

<?php

echo GridView::widget([
    'dataProvider'=> $dataProvider,
    'filterModel' => $searchModel,
    //'columns' => $gridColumns,
    'responsive'=>true,
    'hover'=>true,
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
      [
        'label'  => 'link',
        'format' => 'raw',
        'value'  =>  function ($model) {
                         return Html::a('view', ['task/view-task', 'id' => $model->id]);
                     },
      ]

    ]

]);
?>
</div>
