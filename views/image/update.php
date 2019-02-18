<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Image */

$this->title = 'Update Image: ' . $model->filename;
$this->params['breadcrumbs'][] = ['label' => 'Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
file_put_contents ('img/'.$model->filename, $model->content);
?>
<div class="image-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="card border-info">
        <div class="card-body"><img class="w-25" src="/img/<?= $model->filename; ?>" alt="<?= $model->filename; ?>" /></div>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
