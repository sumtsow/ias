<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\rbac\Rule;

class RbacController extends Controller
{
    
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
                
        // add the rule
        $rule = new \app\rbac\OwnerRule();
        $auth->add($rule);
        
        $rule2 = new \app\rbac\ImageOwnerRule();
        $auth->add($rule2);        

        // добавляем разрешение "createImage"
        $createImage = $auth->createPermission('createImage');
        $createImage->description = 'Create an image';
        $auth->add($createImage);

        // добавляем разрешение "updateImage"
        $updateImage = $auth->createPermission('updateImage');
        $updateImage->description = 'Update image';
        $updateImage->ruleName = $rule2->name;        
        $auth->add($updateImage);
        
        // добавляем разрешение "updateOwnProfile" и привязываем к нему правило.
        $updateOwnProfile = $auth->createPermission('updateOwnProfile');
        $updateOwnProfile->description = 'Update own profile';
        $updateOwnProfile->ruleName = $rule->name;
        $auth->add($updateOwnProfile);        
        
        // добавляем роль "user" и даём роли разрешение "createImage" и "updateOwnProfile"
        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $createImage);
        $auth->addChild($user, $updateImage);
        
        // разрешаем пользователю обновлять его профиль
        $auth->addChild($user, $updateOwnProfile);        

        // добавляем роль "admin" и даём роли разрешение "updateImage"
        // а также все разрешения роли "user"
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updateImage);
        $auth->addChild($admin, $user);
        
        // Назначение ролей пользователям. 1 и 2 это IDs возвращаемые IdentityInterface::getId()
        // обычно реализуемый в модели User.
        $auth->assign($admin, 1);
        $auth->assign($user, 3);
        
    }
}