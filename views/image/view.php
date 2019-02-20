<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Image */

$this->title = $model->filename;
$this->params['breadcrumbs'][] = ['label' => 'Images', 'url' => ['/image']];
$this->params['breadcrumbs'][] = $this->title;
file_put_contents ('img/'.$model->filename, $model->content);
?>
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
</p>
<div class="card border-info">
    <div class="card-header bg-info text-light">HASH: <?= Html::encode($model->hash) ?></div>
    <div class="card-body"><img src="/img/<?= $model->filename; ?>" alt="<?= $model->filename; ?>" /></div>
</div>
