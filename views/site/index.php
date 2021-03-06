<?php

use app\models\UploadForm;

$this->title = 'Пошук зображень';
?>
<div class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Upload Image</h3>
        </div>
        <div class="card-body">
            <?= $this->render('/image/_uploadform', [
                'model' => new UploadForm(),
            ]) ?>
        </div>
        <?= ($errors) ? '<h4>'.$errors.'</h4>' : '' ?>
    </div>
</div>
