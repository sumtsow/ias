<?php

namespace app\controllers;

class ImageController extends \yii\web\Controller
{
    public function actionIndex()
    {
    //return $this->render('index');
        
        $model = new \app\models\Image();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                return;
            }
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

}
