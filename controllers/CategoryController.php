<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Category;
use yii\filters\AccessControl;

class CategoryController extends \yii\web\Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'roles' => ['admin'],
                        'roleParams' => function($rule) {
                            return ['category' => Category::findOne(Yii::$app->request->get('id'))];
                        },
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['?'],
                    ],                    
                ],
            ],
        ];
    }
    
    public function actionIndex()
    {
        $models = Category::find()->orderBy('id')->all();
        return $this->render('index', [
            'models' => $models,
        ]);
    }
    /**
     * {@inheritdoc}
     */
    public function actionView($id)
    {
        $model = Category::findOne($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }
    
    /**
     * {@inheritdoc}
     */    
    public function actionCreate()
    {
        $model = new Category();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->save(false);                
            }
            return $this->redirect('/category/view?id='.$model->getId());            
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
        $model = Category::findOne($id);
        if (isset($model)) {
            if ($model->load(Yii::$app->request->post()))
            {
                if ($model->validate()) {
                    $model->save(false);
                    return $this->redirect('/category/view?id='.$model->getId()); 
                }
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);        
    }
    
    /**
     * {@inheritdoc}
     */        
    public function actionDelete($id)
    {
        $model = Category::findOne($id);
        if ($model)
        {
            $model->delete();
            return $this->redirect('/category'); 
        }
        return $this->goBack();       
    }
}
