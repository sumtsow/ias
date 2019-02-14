<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Change Password of User: ' . $user->id;
$this->params['breadcrumbs'][] = ['label' => 'Dashboard', 'url' => ['/dashboard']];
if(Yii::$app->user->can('admin')) {
    $this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
}
$this->params['breadcrumbs'][] = ['label' => 'View user', 'url' => ['view', 'id' => $user->id]];
$this->params['breadcrumbs'][] = 'Password';
?>

<div class="password-form">
    <h1><?= Html::encode($this->title) ?></h1>  
    
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($user, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($user, 'password_repeat')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::button('Cancel', [
                'class' => 'btn btn-danger',
                'onClick' => 'window.history.back();',
            ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
