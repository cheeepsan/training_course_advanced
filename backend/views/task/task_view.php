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
use kartik\grid\GridView;
use common\models\user\User;
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1><?= Html::encode($this->title) ?></h1>

            <?php

            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'responsive' => true,
                'hover' => true,
                'columns' => [

                    [
                        'label' => 'User',
                        'format' => 'raw',
                        'value' => function ($model) {
                            $user =  User::findIdentity($model->user_id);
                            return $user->name . ' ' . $user->surname;
                        },
                    ],


                    [
                        'label' => 'Completed',
                        'format' => 'html',
                        'value' => function ($model) {

                            $isDone = $model->done;
                            if ($isDone) {

                                return '<i class="fa fa-check-square-o" aria-hidden="true"></i>';
                            } else {

                                return '<i class="fa fa-square-o" aria-hidden="true"></i>';
                            }

                        },
                    ]

                ]

            ]);
            ?>
        </div>
    </div>
</div>