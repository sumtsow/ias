<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Category;

class CategoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new Category();

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
