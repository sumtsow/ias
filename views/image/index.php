<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\i18n\Formatter;
use app\models\Image;

/* @var $this yii\web\View */
/* @var $model app\models\Image */
/* @var $form ActiveForm */
$this->title = 'Images';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['/category']];
$this->params['breadcrumbs'][] = ['label' => 'Images'];

$this->registerCssFile('https://use.fontawesome.com/releases/v5.5.0/css/all.css', [
    'integrity' => 'sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU',
    'crossorigin' => 'anonymous',
    'rel' => 'stylesheet',
    ]);
Image::clearDir();
?>
<h1>
<?= Html::encode($this->title) ?>
<?php if(Yii::$app->user->can('createImage')) : ?>
<a class="btn btn-light border-info mx-3" href="<?= Url::to('/'); ?>">Create Image</a>
<?php endif; ?>    
</h1>

<div class="card-columns mb-3">
<?php foreach($models as $image) : ?>
    <div class="card w-75 border-info">
        <div class="card-header p">
            <div class="row justify-content-between">
                <div class="col-auto mr-auto"><small><?= $image->filename ?></small></div>
                <div class="col-auto">
                    <?php if(Yii::$app->user->can('updateImage', ['image' => $image]) || Yii::$app->user->can('admin')) : ?>
                <a class="badge badge-info" href="<?= Url::to(['/image/view', 'id' => $image->getId()] ); ?>" title="View"><span class="fa fa-eye"></span></a>
                <a class="badge badge-info" href="<?= Url::to(['/image/update', 'id' => $image->getId()] ); ?>" title="Update"><span class="fa fa-edit"></span></a>
                <a class="badge badge-info" href="<?= Url::to(['/image/delete', 'id' => $image->getId()] ); ?>" title="Delete"><span class="fa fa-trash"></span></a>
                    <?php
                    endif;
                    $image->toFile();        
                    ?>                
                </div>
            </div>
        </div>

        <div class="card-body">
            <a href="<?= Url::to(['/image/'.$image->getId()] ); ?>">
                <img class="d-flex w-100" src="/img/<?= $image->filename; ?>" alt="<?= $image->filename; ?>" />
            </a>
            
        </div>
        <div class="card-footer">
            <div class="row justify-content-between">
            <div class="badge badge-light col-auto mr-auto"><?= $image->size; ?> bytes</div>
            <div class="badge badge-light col-auto"><?= Yii::$app->formatter->asDate($image->created_at, 'long'); ?></div>
            </div>
        </div>
    </div>
<?php endforeach ?>
</div>
