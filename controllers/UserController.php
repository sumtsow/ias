<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;

class UserController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionCreate()
    {
        $model = new User();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->hashPassword($model->password);
                $model->save(false);
                $auth = Yii::$app->authManager;
                $auth->assign($auth->getRole('user'), $model->getId());
                $model->sendRegistrationMail();
            }
            return $this->goHome();            
        }
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }

}
