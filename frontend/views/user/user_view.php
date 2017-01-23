<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\detail\DetailView;
use yii\helpers\Url;
$this->title = 'User view';

$this->params['breadcrumbs'][] = $this->title;
echo DetailView::widget([
    'model' => $model,
    'bootstrap' => true,
    //'attributes' => $attributes,
    'mode' => 'edit',
    //'bordered' => $bordered,
    //'striped' => $striped,
    //'condensed' => $condensed,
    //'responsive' => $responsive,
    //'hover' => $hover,
    //'hAlign'=>$hAlign,
    //'vAlign'=>$vAlign,
    //'fadeDelay'=>$fadeDelay,
    /*'deleteOptions'=>[ // your ajax delete parameters
        'params' => ['id' => 1000, 'kvdelete'=>true],
    ],*/
    'panel' => [
      'type' => 'primary',
      'heading' => 'User: ' .$model->users->username,
      'editable' => false,
    ],
    'container' => ['id'=>'kv-demo'],
    'formOptions' => ['action' => Url::current(['#' => 'save'])], // your action to delete
    'attributes' => [
            [
                'attribute'=>'name',


            ],
            [
                'attribute'=>'surname',
                'format'=>'raw',


            ],
            [
                'attribute'=>'weight',
                'format'=>'raw',


            ],
            [
                'attribute'=>'date_of_birth',
                'format'=>'date',
                 'type'=>DetailView::INPUT_DATE,
                 'widgetOptions' => [
                     'pluginOptions'=>['format'=>'yyyy-mm-dd']
                 ],
                 'valueColOptions'=>['style'=>'width:30%']
            ],
    ],
]);
  echo $this->render('_changePassword', ['model' => $modelPassword]);
  echo Html::submitButton('Delete user', ['name' => 'delete', 'class' => 'btn btn-danger', 'action' => 'site/userView']); 
?>
