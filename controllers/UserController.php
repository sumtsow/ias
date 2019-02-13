<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Request;
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
                'only' => ['index', 'view', 'create', 'update', 'password', 'switch', 'role', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['update', 'view', 'password'],
                        'roles' => ['updateOwnProfile', 'admin'],
                        'roleParams' => function($rule) {
                            return ['user' => User::findOne(Yii::$app->request->get('id'))];
                        },
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'create', 'switch', 'role', 'delete'],
                        'roles' => ['admin'],
                        'roleParams' => function($rule) {
                            return ['user' => User::findOne(Yii::$app->request->get('id'))];
                        },
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
        $users = User::find()->orderBy('id')->all();
        return $this->render('index', [
            'users' => $users,
        ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function actionView($id)
    {
        $user = User::findOne($id);
        return $this->render('view', [
            'user' => $user,
        ]);
    }
    
    /**
     * {@inheritdoc}
     */    
    public function actionCreate()
    {
        $user = new User();
        if ($user->load(Yii::$app->request->post())) {
            if ($user->validate()) {
                $user->hashPassword($user->password);
                $auth = Yii::$app->authManager;
                $auth->assign($auth->getRole('user'), $user->getId());
                $user->sendRegistrationMail();
                $user->save(false);                
            }
            return $this->goHome();            
        }
        
        return $this->render('create', [
            'user' => $user,
        ]);
    }

    /**
     * {@inheritdoc}
     */        
    public function actionUpdate($id)
    {
        $user = User::findIdentity($id);
        if (isset($user)) {
            $post = Yii::$app->request->post();
            if ($user->load(Yii::$app->request->post()))
            {
                if ($user->validate()) {
                    $user->save(false);
                    return $this->redirect('/users');
                }
            }
        }
        return $this->render('update', [
            'user' => $user,
        ]);        
    }
    
    /**
     * {@inheritdoc}
     */        
    public function actionPassword($id)
    {
        $user = User::findIdentity($id);
        if (isset($user)) {
            $post = Yii::$app->request->post();
            if ($user->load(Yii::$app->request->post()))
            {
                if ($user->validate()) {
                    $user->hashPassword($user->password);
                    $user->save(false);
                    return $this->redirect('/users');
                }
            }
        return $this->render('password', [
            'user' => $user,
        ]);            
        }
        return $this->goBack();        
    }
        
    /**
     * {@inheritdoc}
     */        
    public function actionSwitch($id)
    {
        $user = User::findOne($id);
        if ($user)
        {
            $user->enabled = !$user->enabled;
            $user->save(false);
            return $this->redirect('/users'); 
        }
        return $this->goBack();       
    }
        
    /**
     * {@inheritdoc}
     */        
    public function actionRole($id)
    {
        $user = User::findOne($id);
        if ($user)
        {
            ($user->role == 'user') ? $user->setRole('admin') : $user->setRole('user');
            return $this->redirect('/users'); 
        }
        return $this->goBack();       
    }
    
    /**
     * {@inheritdoc}
     */        
    public function actionDelete($id)
    {
        $user = User::findOne($id);
        if ($user)
        {
            $user->delete();
            return $this->redirect('/users'); 
        }
        return $this->goBack();       
    }
}
