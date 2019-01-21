<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $lastname
 * @property string $firstname
 * @property string $email
 * @property string $password
 * @property string $role
 * @property string $created_at
 *
 * @property Image[] $images
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lastname', 'firstname', 'email', 'password', 'role', 'created_at'], 'required'],
            [['role'], 'string'],
            [['created_at'], 'safe'],
            [['lastname', 'firstname', 'email'], 'string', 'max' => 256],
            [['password'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lastname' => 'Lastname',
            'firstname' => 'Firstname',
            'email' => 'Email',
            'password' => 'Password',
            'role' => 'Role',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['user_id' => 'id']);
    }
}
