<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'New measurements';

?>
<div clas="container">
    <div class="row">
        <h1>Measurements for <?= $user->name ?> <?= $user->surname ?></h1>
        <div class="col-md-8">


            <?php $form = ActiveForm::begin([
                'id' => 'add-measurements-form',

                'options' => ['class' => '', 'enctype' => 'multipart/form-data'],
                'fieldConfig' => [

                ],

            ]);

            ?>
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'time_created')->widget(yii\jui\DatePicker::classname(), ['dateFormat' => 'yyyy-MM-dd']) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'weight')->textInput(['autofocus' => true]) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'breast')->textInput(['autofocus' => true]) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'hip')->textInput(['autofocus' => true]) ?>
                </div>

                <div class="col-md-2">
                    <?= $form->field($model, 'legs')->textInput(['autofocus' => true]) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'hand')->textInput(['autofocus' => true]) ?>
                </div>

            </div>
            <div class="form-group">

                <?= Html::submitButton('Update', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

            </div>
            <?php
            $form::end();
            ?>

        </div>
    </div>
</div>
