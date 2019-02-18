<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    public $content;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, gif'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->content = file_get_contents($this->imageFile->tempName);
            return true;
        } else {
            return false;
        }
    }
}

