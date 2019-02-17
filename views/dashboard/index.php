<?php
/* @var $this yii\web\View */

use yii\bootstrap\Nav;
use yii\helpers\Url;
use yii\helpers\Html;

    $this->title = 'Dashboard';
    $this->params['breadcrumbs'][] = ['label' => 'Dashboard'];
    $params = ['options' => ['class' => 'nav flex-column col-sm-2']];
    $params['items'] = [['label' => 'My Profile', 'url' => [Url::to(['/user/view', 'id' => Yii::$app->user->getID()])], 'class' => 'nav-item active']];
    if(Yii::$app->user->can('admin')) {
        array_push($params['items'], ['label' => 'Users', 'url' => Url::to(['/users']), 'class' => 'nav-item']);        
        array_push($params['items'], ['label' => 'Image Categories', 'url' => Url::to(['/category']), 'class' => 'nav-item']);
        array_push($params['items'], ['label' => 'Images', 'url' => Url::to(['/image']), 'class' => 'nav-item']);
    }
    else {
        array_push($params['items'], ['label' => 'My Images', 'url' => Url::to(['/image']), 'class' => 'nav-item']);
    }
?>
<h1><?= Html::encode($this->title) ?></h1> 
<?php
    echo Nav::widget($params);
?>

