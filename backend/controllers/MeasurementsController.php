<?php

namespace backend\controllers;


use common\controllers\MainController;
use common\models\measurements\Measurements;
use common\models\user\User;
use Yii;


class MeasurementsController extends MainController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [


        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],

        ];
    }

    public function actionCreate($id)
    {
        $model = new Measurements();
        $model->user_id = $id;
        $user = User::findOne(['id' => $id]);
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {

                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Measurements saved');
                } else {
                    Yii::$app->session->setFlash('danger', 'Measurements not saved');
                    var_dump($model->getErrors()); die();
                }
            $this->redirect(['user/view', 'id' => $id]);
        }
        $model->time_created = Yii::$app->formatter->asDate(date('Y-m-d'));
       // var_dump($model->time_created); die();
        return $this->render('createMeasurements', [
            'model' => $model,
            'user' => $user,
        ]);

    }
    public function actionUpdate($id)
    {
        $model = Measurements::findIdentity($id);
        $user = User::findIdentity($model->user_id);

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Measurements updated');
            } else {
                Yii::$app->session->setFlash('danger', 'Measurements not updated');
                var_dump($model->getErrors()); die();
            }
            $this->redirect(['user/view', 'id' => $user->id]);
        }

        // var_dump($model->time_created); die();
        return $this->render('createMeasurements', [
            'model' => $model,
            'user' => $user,
        ]);

    }
    public function actionDelete($id)
    {
        $model = Measurements::findIdentity($id);
        $user = User::findIdentity($model->user_id);



            if ($model->delete()) {
                Yii::$app->session->setFlash('success', 'Measurements deleted');
            } else {
                Yii::$app->session->setFlash('danger', 'Measurements not deleted');
                var_dump($model->getErrors()); die();
            }
            $this->redirect(['user/view', 'id' => $user->id]);


    }
    public function actionBulkCreate()
    {


    }
    public function actionBulkUpdate()
    {


    }



    private function findModel($id)
    {
        return Measurements::findOne(['id' => $id]);
    }

}
