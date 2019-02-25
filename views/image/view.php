<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use app\models\Image;

/* @var $this yii\web\View */
/* @var $model app\models\Image */

$this->title = 'View file';
$this->params['breadcrumbs'][] = ['label' => 'Images', 'url' => ['/image']];
$this->params['breadcrumbs'][] = $this->title;
Image::clearDir();
$model->toFile();
?>
<h1><?= Html::encode($this->title) ?></h1>
<p>
<?php if(Yii::$app->user->can('admin')) :    
echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary mr-3']);
echo Html::a('Delete', ['delete', 'id' => $model->id], [
    'class' => 'btn btn-danger',
    'data' => [
        'confirm' => 'Are you sure you want to delete this image?',
        'method' => 'post',
    ],
]);
endif; ?>
    <span class="ml-3"><span class="font-weight-bold">Categories:</span>
    <?= implode(' | ', ArrayHelper::getColumn($model->categories, 'name')); ?>
    </span>    
</p>
<div class="card border-info">
    <div class="card-header bg-info text-light h5">
        <?= Html::encode($model->filename) ?>
    </div>
    <div class="card-body">
        <div class="d-flex bd-highlight">
            <div class="col bd-highlight">
                <img class="w-100" src="/img/<?= $model->filename; ?>" alt="<?= $model->filename; ?>" />
            </div>
            <div class="col flex-shrink-1 bd-highlight">
                <p>Source: <?= (Html::encode($model->source) !== 'local') ? '<a target="_blank" href="'.Html::encode($model->source).'">' : null ?> <?=  Html::encode($model->source) ?> <?= (Html::encode($model->source) !== 'local') ? '</a>' : null ?></p>
                <p>Size: <?= Html::encode($model->size) ?> bytes</p>
                <p>Owner: <?= Html::encode($owner) ?></p>
                <p>MD-5 hash: <?= Html::encode($model->hash) ?></p>
                <p>Uploaded: <?= Yii::$app->formatter->asDatetime($model->created_at, 'long');?></p>
            </div>  
        </div>
    </div>  
</div>
