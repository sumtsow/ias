<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Image */
/* @var $form yii\bootstrap\ActiveForm */
?>
<script>
    function clearInput() {
        this.document.getElementById('url').value = '';
    }
</script>
    
<div class="form-group">

<?php $form = ActiveForm::begin([
    'action' => '/image/upload',    
    'options' => [
        'enctype' => 'multipart/form-data',
        ],
    ]) ?>
    <div class="row">
        <div class="col">
        <?= $form->field($model, 'imageSize', ['inputOptions' => ['name' => 'MAX_FILE_SIZE', 'value' => '8000000', 'class' => 'form-control-file d-none']])->hiddenInput()->label('', ['class'=> 'd-none']) ?>    
        <?= $form->field($model, 'imageFile',['inputOptions' => ['class' => 'form-control-file border rounded text-lg', 'onClick' => 'clearInput();']])->fileInput()->label('Select image file', ['class' => 'font-weight-bold']) ?>
  
        </div>
        <div class="col pt-3">    
        <?= $form->field($model, 'imageFile',['inputOptions' => ['class' => 'form-control p-0', 'style' => 'height: 27px;', 'id' => 'url']])->textInput()->label('or enter its URL:', ['class' => 'font-weight-bold']) ?>
        </div>
    </div>    
    <div class="row">
        <div class="col">
            <button class="btn btn-primary">Upload</button>      
        </div>
    </div>     
<?php ActiveForm::end() ?>
</div>
