<?php
/* @var $this yii\web\View */

use yii\bootstrap\Nav;
use yii\helpers\Url;

?>
<h1>Dashboard</h1>
<?php
    echo Nav::widget([
        'options' => ['class' => 'nav flex-column col-sm-2'],
        'items' => [
            ['label' => 'My Profile', 'url' => [Url::to(['user/update', 'id' => Yii::$app->user->getID()])], 'class' => 'nav-item active'],
            Yii::$app->user->can('updateImage') ? (
                    ['label' => 'Admin', 'url' => Url::to(['site/admin']), 'class' => 'nav-item']
                ) : (
                    ['label' => 'User', 'url' => Url::to(['site/user']), 'class' => 'nav-item']
            ),
        ]
    ]);
?>
