<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;

$this->registerCssFile('https://use.fontawesome.com/releases/v5.5.0/css/all.css', [
    'integrity' => 'sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU',
    'crossorigin' => 'anonymous',
    'rel' => 'stylesheet',
    ]);
$this->title = 'Image Categories';
$this->params['breadcrumbs'][] = ['label' => 'Dashboard', 'url' => ['/dashboard']];
$this->params['breadcrumbs'][] = ['label' => 'Categories'];

?>
<h1><?= Html::encode($this->title) ?></h1> 
<div class="card-columns mb-3">
<?php foreach($models as $category) : ?>
    <div class="card">
        <div class="card-body"><a href="<?= Url::to(['/category/view', 'id' => $category->getId()] ); ?>"><?= $category->name; ?></a></div>
    </div>
<?php endforeach ?>
</div>
<div class="row mt-3">
    <div class="col-md-6"><a href="<?= Url::to('/category/create'); ?>" class="btn btn-primary">Create Category</a></div>
</div>
