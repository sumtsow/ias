<?php

namespace app\models;

use Yii;
use app\models\Category;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "image".
 *
 * @property int $id
 * @property int $user_id
 * @property string $filename
 * @property string $source
 * @property string $size
 * @property string $content
 * @property string $hash
 * @property string $created_at
 *
 * @property User $user
 * @property Imagehascategory[] $imagehascategories
 */
class Image extends \yii\db\ActiveRecord
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'filename', 'source', 'size', 'content', 'hash', 'created_at'], 'required'],
            [['user_id', 'size'], 'integer'],
            [['content'], 'string'],
            [['created_at'], 'safe'],
            [['filename', 'source'], 'string', 'max' => 1024],
            [['hash'], 'string', 'max' => 64],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'filename' => 'Filename',
            'source' => 'Source',
            'size' => 'Size',
            'content' => 'Content',
            'hash' => 'Hash',
            'created_at' => 'Created At',
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->orderBy('name')
            ->viaTable('imagehascategory', ['image_id' => 'id']);
    }
    
    /**
     * @return boolean result
     */
    public function inCategory($id)
    {
        return in_array($id, ArrayHelper::getColumn($this->categories, 'id'));
    }
    
    /**
     * {@inheritdoc}
     */
    public static function toHash($str)
    {
        return md5($str);
    }

    /**
     * @return int bytes or false
     */
    public function toFile()
    {
        return file_put_contents('img/'.$this->filename, $this->content);
    }
        
    /**
     * @return boolean
     */
    public static function clearDir()
    {
        $files = glob('img/*'); //get all file names
        foreach($files as $file){
            if(is_file($file)) unlink($file); //delete file
        }
        return true;
    }
    
    /**
     * {@inheritdoc}
     */
    public static function searchMd5($hash)
    {
        return self::findOne(['hash' => $hash]);
    }

    /**
     * @return \yii\db\Command
     */
    public function addCategory($id)
    {
        if(!$this->inCategory($id)) {
            Yii::$app->db->createCommand()->insert('imagehascategory', [
                'category_id' => $id,
                'image_id' => $this->id,
            ])->execute();
        }
        return true;
    }
    
    /**
     * @return \yii\db\Command
     */
    public function removeCategory($id)
    {
        if($this->inCategory($id)) {
            Yii::$app->db->createCommand()->delete('imagehascategory', 'category_id = '.$id)->execute();
        }
        return true;
    }
    
    /**
     * 
     */    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                if(!$this->user_id) {
                    $this->user_id = 2;
                }
            }
            return true;
        }
        return false;
    }
}
