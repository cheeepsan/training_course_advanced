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
echo Html::a('New task', ['task/new-task-from-parent', 'parent_id' => $model->id], ['class' => 'btn btn-success']);
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
      'heading' => $model->name . ' ' . $model->start_date . ' - ' . $model->end_date,
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
                'attribute'=>'start_date',
                'format'=>'date',
                 'type'=>DetailView::INPUT_DATE,
                 'widgetOptions' => [
                     'pluginOptions'=>['format'=>'yyyy-mm-dd']
                 ],
                 'valueColOptions'=>['style'=>'width:30%']
            ],
            [
                'attribute'=>'end_date',
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
            [
                'label'=>'Participants',
                'format' => 'raw',
              //  'type' => DetailView::INPUT_SELECT2,
                'value' => Select2::widget([
                            'id' => 'userselect',

                            'value' => $initialData,
                            'name' => 'Participants',
                            'data' => $nameIdMap,
                            'options' => ['placeholder' => 'Select users...', 'multiple' => true,],
                            'pluginOptions' => [
                                'allowClear' => true,

                            ],
                        ]),
                'valueColOptions'=>['class'=>'select-users ']
            ],
    ],
]);

  echo Yii::$app->controller->renderPartial('_task_course_list', [
    'taskSearch' => $taskSearch,
    'taskDataProvider' => $taskDataProvider
  ]);
?>
