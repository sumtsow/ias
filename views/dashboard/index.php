<?php
/* @var $this yii\web\View */

use yii\bootstrap\Nav;
use yii\helpers\Url;

?>
<h1>Dashboard</h1>
<?php
    $params = ['options' => ['class' => 'nav flex-column col-sm-2']];
    $params['items'] = [['label' => 'My Profile', 'url' => [Url::to(['user/update', 'id' => Yii::$app->user->getID()])], 'class' => 'nav-item active']];
    if(Yii::$app->user->can('updateImage')) {
        array_push($params['items'], ['label' => 'Image Categories', 'url' => Url::to(['/category']), 'class' => 'nav-item']);
        array_push($params['items'], ['label' => 'Images', 'url' => Url::to(['/image']), 'class' => 'nav-item']);
        array_push($params['items'], ['label' => 'Users', 'url' => Url::to(['/users']), 'class' => 'nav-item']);            
    }
    else {
        array_push($params['items'], ['label' => 'User', 'url' => Url::to(['/user/', 'id' =>  Yii::$app->user->getID()]), 'class' => 'nav-item']);
    }
    echo Nav::widget($params);
?>
