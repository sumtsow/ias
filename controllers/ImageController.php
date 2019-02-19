<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use app\models\Image;
use app\models\UploadForm;
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
    
    /**
     * {@inheritdoc}
     */
    public function actionView($id)
    {
        $model = Image::findOne($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function actionUpdate($id)
    {
        $model = Image::findOne($id);
        if (isset($model)) {
            if ($model->load(Yii::$app->request->post()))
            {
                if ($model->validate()) {
                    $model->save(false);
                    return $this->redirect(['/image/', 'id' => $id]);
                }
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }
    
    public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                // file is uploaded successfully
                $image = new Image();
                $image->user_id = Yii::$app->user->getId();
                $image->filename = $model->imageFile->name;
                $image->source = 'local';
                $image->size = $model->imageFile->size;
                $image->content = $model->content;
                $image->hash = crypt($image->content, null);
                $image->created_at = date("Y-m-d H:i:s");
                $image->save(false);
                return $this->redirect('/image');
            }
        }
        return $this->render('/', ['model' => $model]);
    }
        
    /**
     * {@inheritdoc}
     */        
    public function actionDelete($id)
    {
        $model = Image::findOne($id);
        if ($model)
        {
            $model->delete();
            return $this->redirect('/image'); 
        }
        return $this->goBack();       
    }
}
