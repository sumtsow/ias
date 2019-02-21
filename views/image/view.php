<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Image */

$this->title = 'View file';
$this->params['breadcrumbs'][] = ['label' => 'Images', 'url' => ['/image']];
$this->params['breadcrumbs'][] = $this->title;
file_put_contents ('img/'.$model->filename, $model->content);
?>
<h1><?= Html::encode($this->title) ?></h1>
<h2><?= Html::encode($message) ?></h2>
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
    <div class="card-body"><img src="/img/<?= $model->filename; ?>" alt="<?= $model->filename; ?>" /></div>
    <div class="card-header bg-info text-light">
        Source: <?= Html::encode($model->source) ?><br />
        Size: <?= Html::encode($model->size) ?> bytes<br />
        Owner: <?= Html::encode($owner) ?><br />        
        MD-5 hash: <?= Html::encode($model->hash) ?><br />
        Uploaded: <?= Yii::$app->formatter->asDatetime($model->created_at, 'long');?>       
    </div>    
</div>
