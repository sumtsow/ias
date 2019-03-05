<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Image */
/* @var $form yii\bootstrap\ActiveForm */
?>
<script>
    function disableFile() {
        this.document.getElementById('uploadform-imagefile').value = '';
        this.document.getElementById('uploadform-imagefile').readonly = 1;
        this.document.getElementById('url').readonly = 0;
    }
    function disableUrl() {
        this.document.getElementById('url').value = '';
        this.document.getElementById('url').readonly = 1;
        this.document.getElementById('uploadform-imagefile').readonly = 0;
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
        <?= $form->field($model, 'imageSize', ['inputOptions' => ['name' => 'MAX_FILE_SIZE', 'value' => '8000000', 'class' => 'form-control-file d-none']])->hiddenInput()->label('', ['hidden' => 'hidden', 'for' => null]) ?>    
        <?= $form->field($model, 'imageFile',['inputOptions' => ['class' => 'form-control-file border rounded text-lg', 'onClick' => 'disableUrl();']])->fileInput()->label('Select image file', ['class' => 'font-weight-bold']) ?>
  
        </div>
        <div class="col pt-3">    
        <?= $form->field($model, 'imageFile',['inputOptions' => ['class' => 'form-control p-0', 'id' => 'url', 'onClick' => 'disableFile();']])->textInput()->label('or enter its URL:', ['class' => 'font-weight-bold']) ?>
        </div>
    </div>    
    <div class="row">
        <div class="col">
            <button class="btn btn-primary">Upload</button>      
        </div>
    </div>     
<?php ActiveForm::end() ?>
</div>
