<?php

namespace app\models;

use Yii;

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
            [['user_id', 'filename', 'source', 'size', 'content', 'hash', 'created_at'], 'required'],
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
    public function getImagehascategories()
    {
        return $this->hasMany(Imagehascategory::className(), ['image_id' => 'id']);
    }
}
