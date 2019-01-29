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
        $request = Yii::$app->request;
        
        if ($model->load($request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                $model->generateAuthKey();
                $model->save(false);
                $auth = Yii::$app->authManager;
                $userRole = $auth->getRole('user');
                $auth->assign($userRole, $model->getId());
            }
            return $this->redirect('?r=site/index');            
        }
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }

}
