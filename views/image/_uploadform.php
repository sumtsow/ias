<?php

use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Image */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="form-group">

<?php $form = ActiveForm::begin([
    'action' => '/image/upload',    
    'options' => [
        'enctype' => 'multipart/form-data',
        ],
    ]) ?>
    <div class="row">
        <div class="col">
        <?= $form->field($model, 'imageFile',['inputOptions' => ['class' => 'form-control-file border rounded text-lg']])->fileInput()->label('Select image file', ['class' => 'font-weight-bold']) ?>
  
        </div>
        <div class="col">    
        <?= $form->field($model, 'imageFile',['inputOptions' => ['class' => 'form-control']])->textInput(['value' => 'http://www.somehost.dom'])->label('or enter its URL:', ['class' => 'font-weight-bold']) ?>
        </div>
    </div>    
    <div class="row">
        <div class="col">
            <button class="btn btn-primary">Upload</button>      
        </div>
    </div>     
<?php ActiveForm::end() ?>
</div>
