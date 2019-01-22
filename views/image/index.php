<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Image */
/* @var $form ActiveForm */
?>
<div class="site-image-index">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'user_id') ?>
        <?= $form->field($model, 'filename') ?>
        <?= $form->field($model, 'source') ?>
        <?= $form->field($model, 'size') ?>
        <?= $form->field($model, 'content') ?>
        <?= $form->field($model, 'hash') ?>
        <?= $form->field($model, 'created_at') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-image-index -->
