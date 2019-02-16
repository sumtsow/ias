<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

$this->beginPage()
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="container-fluid bg-info">
        <ul class="nav bg-transparent">
            <li class="nav-item active">
                <a class="nav-link text-light" href="/site/index">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="/site/about">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="/site/contact">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="/gii">Gii</a>
            </li>
            <?php if(Yii::$app->user->isGuest) : ?>
            <li class="nav-item text-light">
                <a class="nav-link" href="/site/login">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="/user/create">Register</a>
            </li>            
            <?php else : ?>
            <li class="nav-item text-light">
                <?php echo Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->lastname. ' '. Yii::$app->user->identity->firstname . ')',
                    ['class' => 'btn btn-link logout pt-2 text-light']
                )
                . Html::endForm(); ?>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="/dashboard">Dashboard</a>
            </li>             
            <?php endif; ?>
        </ul>
    </div>
    <?php
    /**NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'nav navbar-collapse'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],            
            ['label' => 'Gii', 'url' => ['/gii']],
            Yii::$app->user->isGuest ? (
                    ['label' => 'Login', 'url' => ['/site/login']]
                ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->lastname. ' '. Yii::$app->user->identity->firstname . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            ),
            Yii::$app->user->isGuest ? (['label' => 'Register', 'url' => ['/user/create']]) : 
                (['label' => 'Dashboard', 'url' => ['/dashboard']]),
        ]
    ]);
    NavBar::end();*/
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'itemTemplate' => '<li class="breadcrumb-item">{link}</li>',
            'activeItemTemplate' => '<li class="breadcrumb-item active">{link}</li>',
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; NURE <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
