<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Image;

class ImageController extends Controller
{
    public function actionIndex()
    {
        
        $model = new Image();

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
