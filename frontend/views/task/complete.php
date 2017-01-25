<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\ckeditor\CKEditor;
?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1><?= $task->name ?></h1>
            <?php $form = ActiveForm::begin([
                'id' => 'complete-task-form',
                'action' => ['task/save-task'],
                'options' => ['class' => 'form-horizontal'],

            ]);

            ?>
            <?= $form->field($model, 'comment')->widget(CKEditor::className(), [
                'options' => ['rows' => 6],
                'preset' => 'Full-All'
            ]) ?>
            <?= $form->field($model, 'id')->hiddenInput(['value'=> $model->id])->label(false); ?>

                    <?= Html::submitButton('Complete task', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

            <?php ActiveForm::end(); ?>
    </div>
</div>