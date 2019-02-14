<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Update User: ' . $user->id;
$this->params['breadcrumbs'][] = ['label' => 'Dashboard', 'url' => ['/dashboard']];
if(Yii::$app->user->can('admin')) {
    $this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
}
$this->params['breadcrumbs'][] = ['label' => 'View user', 'url' => ['view', 'id' => $user->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">
    <h1><?= Html::encode($this->title) ?></h1>    
    <div class="user-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($user, 'lastname')->textInput(['maxlength' => true]) ?>
    <?= $form->field($user, 'firstname')->textInput(['maxlength' => true]) ?>
    <?= $form->field($user, 'email')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <a class="btn btn-warning" href="<?= Url::to(['user/password', 'id' => $user->getID()]) ?>">Change Password</a>  
    </div>
    <?php ActiveForm::end(); ?>
    </div>
</div>
