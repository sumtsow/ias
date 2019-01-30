<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // добавляем разрешение "createImage"
        $createImage = $auth->createPermission('createImage');
        $createImage->description = 'Create an image';
        $auth->add($createImage);

        // добавляем разрешение "updateImage"
        $updateImage = $auth->createPermission('updateImage');
        $updateImage->description = 'Update image';
        $auth->add($updateImage);

        // добавляем роль "user" и даём роли разрешение "createImage"
        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $createImage);

        // добавляем роль "admin" и даём роли разрешение "updateImage"
        // а также все разрешения роли "user"
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updateImage);
        $auth->addChild($admin, $user);

        // Назначение ролей пользователям. 1 и 2 это IDs возвращаемые IdentityInterface::getId()
        // обычно реализуемый в модели User.
        $auth->assign($user, 2);
        $auth->assign($admin, 1);
    }
}