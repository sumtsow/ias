<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Category;

$this->registerCssFile('https://use.fontawesome.com/releases/v5.5.0/css/all.css', [
    'integrity' => 'sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU',
    'crossorigin' => 'anonymous',
    'rel' => 'stylesheet',
    ]);
$this->title = 'Image Categories';
if(Yii::$app->user->can('admin')) {
    $this->params['breadcrumbs'][] = ['label' => 'Dashboard', 'url' => ['/dashboard']];
}
$this->params['breadcrumbs'][] = ['label' => 'Categories'];

?>
<h1><?= Html::encode($this->title) ?></h1> 
<div class="card-columns mb-3">
<?php foreach($models as $category) : ?>
    <div class="card border-info">
        <?php if(Yii::$app->user->can('admin')) : ?>
        <div class="card-header text-right">
            <a href="<?= Url::to(['/category/view', 'id' => $category->getId()] ); ?>" class="badge badge-info" title="View"><span class="fa fa-eye"></span></a>
            <a href="<?= Url::to(['/category/update', 'id' => $category->getId()] ); ?>" class="badge badge-info" title="Update"><span class="fa fa-edit"></span></a>
            <a href="<?= Url::to(['/category/delete', 'id' => $category->getId()] ); ?>" class="badge badge-info" title="Delete"><span class="fa fa-trash"></span></a>
        </div>
        <?php endif; ?>
        <div class="card-body"><a class="card-title" href="<?= Url::to(['/image/'.$category->getId()] ); ?>"><?= $category->name; ?></a></div>
        <div class="card-footer"><span class="badge badge-info"><?= $category->getImagesCount(); ?> images</span></div>
    </div>
<?php endforeach ?>
</div>
<?php if(Yii::$app->user->can('admin')) : ?>
<div class="row mt-3">
    <div class="col-md-6"><a href="<?= Url::to('/category/create'); ?>" class="btn btn-primary">Create Category</a></div>
</div>
<?php endif; ?>
