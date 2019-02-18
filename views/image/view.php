<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Image */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card">
    <h1  class="card-title"><?= Html::encode($this->title) ?></h1>
    <p><img src="/img/<?= $model->filename; ?>" alt="<?= $model->filename; ?>" /> </p>
</div>
