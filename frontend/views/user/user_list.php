<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */
use app\controllers\SiteController;
use app\models\user\Users;
use app\models\user\User;
use app\models\user\UserSearch;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = 'List users';

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
        'attribute' => 'users.username',

      ],
      [
        'attribute' => 'name',

      ],
      [
        'attribute' => 'surname',

      ],
      [
        'attribute' => 'weight',

      ],
      [
        'attribute' => 'date_of_birth',

      ],
      [
        'label'  => 'link',
        'format' => 'raw',
        'value'  =>  function ($model) {
                         return Html::a('view', ['user/view-user', 'id' => $model->id]);
                     },
      ]

    ]

]);
?>
</div>
