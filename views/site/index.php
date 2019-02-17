<?php

use yii\widgets\ActiveForm;

$this->title = 'Пошук зображень';
?>
<div class="content">
    <div class="card">
        <div class="card-header">
            <h1>Image search</h1>
        </div>
        <div class="card-body">
            <p class="card-title"><a href="/category">Image Categories</a></p>
            <p class="card-title">Upload Image</p>
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
            <?= $form->field($model, 'imageFile')->fileInput() ?>
            <button>Submit</button>
            <?php ActiveForm::end() ?>
        </div>        
    </div>
</div>
