<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Image;
use yii\filters\AccessControl;

class ImageController extends Controller
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
                            return ['category' => Image::findOne(Yii::$app->request->get('id'))];
                        },
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['?','@'],
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
        
        $models = Image::find()->orderBy('id')->all();
        return $this->render('index', [
            'models' => $models,
        ]);
    }

    public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                // file is uploaded successfully
                return;
            }
        }
        return $this->render('upload', ['model' => $model]);
    }
}
