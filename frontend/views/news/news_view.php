<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\detail\DetailView;
use yii\helpers\Url;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;



$this->title = 'Course view';

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
      'heading' => $model->name ,
      'editable' => false,
    ],
    'container' => ['id'=>'kv-demo'],
    'formOptions' => ['action' => Url::current(['#' => 'save'])], // your action to delete
    'attributes' => [
            [
                'attribute'=>'name',


            ],
            [
                'attribute'=>'description',
                'format'=>'text',


            ],
            [
                'attribute'=>'create_date',
                'format'=>'date',
                 'type'=>DetailView::INPUT_DATE,
                 'widgetOptions' => [
                     'pluginOptions'=>['format'=>'yyyy-mm-dd']
                 ],
                 'valueColOptions'=>['style'=>'width:30%']
            ],
            [
                'attribute'=>'publish_date',
                'format'=>'date',
                 'type'=>DetailView::INPUT_DATE,
                 'widgetOptions' => [
                     'pluginOptions'=>['format'=>'yyyy-mm-dd']
                 ],
                 'valueColOptions'=>['style'=>'width:30%']
            ],
            [
                'attribute'=>'status',
                'type'=>DetailView::INPUT_RADIO_LIST,
                'items' => [
                        '1' => 'Active',
                        '0' => 'Not active',
                ],
            ],

    ],
]);

?>
