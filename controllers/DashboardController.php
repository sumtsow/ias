<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

class DashboardController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    /*[
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['admin'],
                    ],*/
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
    public function actionIndex()
    {
        return $this->render('index');
    }

}