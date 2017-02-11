<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */
use yii\widgets\ListView;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = 'News';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>



<div class="row news-row">

<div class="col-md-12">
<?=
ListView::widget([
    'dataProvider' => $dataProvider,
    'summary'=>'',
    'options' => [
        'tag' => 'div',
        'class' => 'list-wrapper',
        'id' => 'list-wrapper',
    ],
    'itemView' => function ($model) {
        return $this->render('_news_item',['model' => $model]);

    },
]);
?>
</div>
</div>
</div>
