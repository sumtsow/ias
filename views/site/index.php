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
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="/image">Images</a>
                </li>                 
                <li class="nav-item">
                    <a class="nav-link" href="/category">Categories</a>
                </li>
            </ul>
            <h4 class="card-title">Upload Image</h4>
            <?= $this->render('/image/_uploadform', [
                'model' => new UploadForm(),
            ]) ?>
        </div>        
    </div>
</div>
