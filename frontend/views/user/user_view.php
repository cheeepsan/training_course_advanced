<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\detail\DetailView;
use yii\helpers\Url;

$this->title = 'User view';

?>
<div clas="container">
    <div class="row">
       <?php /* <div class="col-md-4 sidebar">

            <ul>
                <li>Basic info</li>
                <li>Body</li>
            </ul>
        </div>^*/ ?>
        <div class="col-md-8">

            <h1><?= $model->name . ' ' . $model->surname ?></h1>
            <?php $form = ActiveForm::begin([
                'id' => 'add-course-form',

                'options' => ['class' => '', 'enctype' => 'multipart/form-data'],
                'fieldConfig' => [

                ],
                'action' => ['user/view-user', 'id' => $model->id],
            ]);

            ?>
            <div class="row">
                <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
                </div>
                <div class="col-md-6">
            <?= $form->field($model, 'surname')->textInput(['autofocus' => true]) ?>
                </div>
                <div class="col-md-6">
            <?= $form->field($model, 'sex')->dropDownList([0 => 'Male', 1 => 'Female']) ?>
                </div>
                <div class="col-md-6">
            <?= $form->field($model, 'date_of_birth')->widget(yii\jui\DatePicker::classname(), ['dateFormat' => 'yyyy-MM-dd']) ?>
                </div>
                <div class="col-md-12">
            <?= $form->field($model, 'phone')->textInput(['autofocus' => true]) ?>
                </div>
                <div class="col-md-12">
            <?= $form->field($model, 'instagram')->textInput(['autofocus' => true]) ?>
                </div>
                <div class="col-md-12">
            <?= $form->field($model, 'facebook')->textInput(['autofocus' => true]) ?>
                </div>
            </div>
            <div class="form-group">

                <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

            </div>
            <?php
            $form::end();
            ?>

        </div>
    </div>
</div>




