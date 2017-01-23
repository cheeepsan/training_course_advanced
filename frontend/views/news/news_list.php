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
                         return Html::a('view', ['news/view', 'id' => $model->id]);
                     },
      ]

    ]

]);
?>
</div>
