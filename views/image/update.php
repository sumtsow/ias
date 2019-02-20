<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Category;
use app\models\User;

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
    
    <div class="image-form">
    
<?php
    $user = User::findIdentity($model->user_id);
    $form = ActiveForm::begin();
?>

    <?= $form->field($model, 'filename')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'source')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'owner_name')->textInput([
        'disabled' => 'disabled',
        'value' => $user->lastname.' '.$user->firstname,
        ]) ?>
    
        <label>Categories</label>
        <div class="d-flex mb-3 p-3 border border-secondary">
    <?php foreach($model->categories as $category) : ?>
            <div class="mx-2 w-100 alert alert-warning alert-dismissible fade show" role="alert">
        <?= $category->name ?>
                <a type="button" class="close" class="text-dark" href="/image/rmcat?category_id=<?= $category->id; ?>&id=<?= $model->id; ?>">&times;</a>
            </div>
    <?php endforeach; ?>
        </div>    
    <?= $form->field($model, 'categories')->label('Add Image to Category')->dropdownList(
    Category::find()->select(['name', 'id'])->indexBy('id')->orderBy('name')->column(),
    ['prompt'=>'Select Category ...']) ?>     

    <?= $form->field($model, 'size')->textInput(['disabled' => 'disabled']) ?>

    <?= $form->field($model, 'hash')->textInput(['disabled' => 'disabled']) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

        <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

<?php ActiveForm::end(); ?>

    </div>

</div>
