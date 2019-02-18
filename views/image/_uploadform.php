<?php

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Image */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="image-upload-form">

<?php $form = ActiveForm::begin([
    'action' => 'image/upload',    
    'options' => ['enctype' => 'multipart/form-data',],
    ]) ?>

<?= $form->field($model, 'imageFile')->fileInput() ?>

<button>Upload</button>

<?php ActiveForm::end() ?>

</div>
