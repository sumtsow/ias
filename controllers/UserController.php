<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\User;

class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index','update'],
                        'roles' => ['updateOwnProfile'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['?'],
                    ],                    
                ],
            ],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * {@inheritdoc}
     */    
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

    /**
     * {@inheritdoc}
     */        
    public function actionUpdate($id)
    {
        $model = User::findIdentity($id);
        if (isset($model)) {
            if ($model->load(Yii::$app->request->post()))
            {
                if ($model->validate()) {
                    $model->hashPassword($model->password);
                    $model->save(false);
            }
            
            }
        return $this->render('update', [
            'model' => $model,
        ]);            
        }
        return $this->goBack();        
    }
}
