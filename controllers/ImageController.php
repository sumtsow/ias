<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use app\models\Image;
use app\models\Category;
use app\models\User;
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
                'only' => ['own', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['own', 'update', 'delete'],
                        'roles' => ['admin'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['own', 'update', 'delete'],
                        'roles' => ['updateImage'],
                        'roleParams' => function($rule) {
                            $id = (Yii::$app->request->get('user_id')) ? Yii::$app->request->get('user_id') : Yii::$app->request->get('id');
                            return ['image' => Image::findOne($id)];
                        },
                    ],                                
                ],
            ],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function actionIndex($category_id = null)
    {
        $models = array();
        if($category_id) {
            $category = Category::findOne($category_id);
            if($category) {
                foreach($category->images as $image) {
                    $models[] = Image::findOne($image->id);
                }
            }
            
        }
        else {
            $models = Image::find()->orderBy('id')->all();
            $category = null;
        }
        return $this->render('index', [
            'models' => $models,
            'category' => $category,
        ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function actionOwn($user_id = null)
    {
        if($user_id) {
            return $this->render('index', [
            'models' => Image::findAll(['user_id' => $user_id]),
        ]);
        }
        return $this->redirect('/image');
    }
    
    /**
     * {@inheritdoc}
     */
    public function actionView($id)
    {
        $model = Image::findOne($id);
        $user = User::findOne($model->user_id);
        $message = Yii::$app->request->get('message');
        $owner = $user->lastname.' '.$user->firstname;
        return $this->render('view', [
            'model' => $model,
            'owner' => $owner,
            'message' => $message,
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
                    $category_id = Yii::$app->request->post('Image')['categories'];
                    if ($category_id) {
                        $model->addCategory($category_id);
                    }
                    $model->save(false);
                    return $this->redirect(['/image/update', 'id' => $id]);
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
                $image->hash = Image::toHash($model->content);                
                $image->user_id = Yii::$app->user->getId();
                $image->filename = $model->imageFile->name;
                $image->source = 'local';
                $image->size = $model->imageFile->size;
                $image->content = $model->content;
                $image->created_at = date('Y-m-d H:i:s');
                $result = Image::searchMd5($image->hash);
                if($result) {
                    return $this->redirect(['/image/'.$result->id, 'message' => 'Image aready exist in database!']);
                }
                else {
                    $image->save(false);
                    $image->addCategory(1);
                    return $this->redirect('/image');
                }
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
     
    /**
     * {@inheritdoc}
     */        
    public function actionRmcat($category_id, $id)
    {
        if($category_id != 1) {
            $image = Image::findOne($id);
            if ($image)
            {
                $image->removeCategory($category_id);
            }
        }
        return $this->redirect('/image/update?id='.$id);       
    }
}
