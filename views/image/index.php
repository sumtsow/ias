<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Image */
/* @var $form ActiveForm */
$this->title = 'Images';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['/category']];
?>
<h1><?= Html::encode($this->title) ?></h1> 
<div class="card-columns mb-3">
<?php foreach($models as $image) : ?>
    <div class="card">
        <?php if(Yii::$app->user->can('admin')) : ?>
        <div class="card-header text-right">
            <a href="<?= Url::to(['/image/view', 'id' => $image->getId()] ); ?>" class="badge" title="View"><span class="fa fa-eye"></span></a>
            <a href="<?= Url::to(['/image/update', 'id' => $image->getId()] ); ?>" class="badge" title="Update"><span class="fa fa-edit"></span></a>
            <a href="<?= Url::to(['/image/delete', 'id' => $image->getId()] ); ?>" class="badge" title="Delete"><span class="fa fa-trash"></span></a>
        </div>
        <?php endif; ?>
        <div class="card-body"><a href="<?= Url::to(['/image/'.$image->getId()] ); ?>"><?= $image->filename; ?></a></div>
        <div class="card-footer text-right"><span class="badge badge-primary"><?= $image->size; ?> bytes</span></div>
    </div>
<?php endforeach ?>
</div>
<?php if(Yii::$app->user->can('admin')) : ?>
<div class="row mt-3">
    <div class="col-md-6"><a href="<?= Url::to('/image/create'); ?>" class="btn btn-primary">Create Image</a></div>
</div>
<?php endif; ?>
