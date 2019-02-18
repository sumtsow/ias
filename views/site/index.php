<?php

use app\models\UploadForm;

$this->title = 'Пошук зображень';
?>
<div class="content">
    <div class="card">
        <div class="card-header">
            <h1>Image search</h1>
        </div>
        <div class="card-body">
            <p class="card-title"><a href="/category">Image Categories</a></p>
            <h5 class="card-title">Upload Image</h5>
            <?= $this->render('/image/_uploadform', [
                'model' => new UploadForm(),
            ]) ?>
        </div>        
    </div>
</div>
