<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $lastname
 * @property string $firstname
 * @property string $email
 * @property string $password
 * @property tinyint $enabled
 * @property string $auth_key
 * @property string $access_token
 * @property string $created_at
 *
 * @property Image[] $images
 */
class User extends ActiveRecord implements IdentityInterface
{
    //public $id;
    //public $username;
    //public $password;
    //public $authKey;
    //public $accessToken;
    
    public $role;    
    public $password_repeat;

    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        $this->role = 'user';
        $auth = Yii::$app->authManager;
        if($this->id) {
                $this->role = $auth->getAssignments($this->id);
        }
        return true;
    }    

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    
    /**
     * {@inheritdoc}
     */
    public function generateAuthKey()
    {
        //return $this->__set('auth_key', random_bytes(64));
        return $this->__set('auth_key', \Yii::$app->security->generateRandomString());
    }    
    
    /**
     * {@inheritdoc}
     */
    public function generateAccessToken()
    {
        return $this->__set('access_token', \Yii::$app->security->generateRandomString());
    }
    
    /**
     * Hash password
     *
     * @param string $password password to hash
     * @return true
     */
    public function hashPassword($password)
    {
        $this->password = Yii::$app->getSecurity()->generatePasswordHash($password);
        return true;
    }
    
    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }
    
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
            [['lastname', 'firstname', 'email', 'password', 'password_repeat'], 'required'],
            [['created_at'], 'safe'],
            [['lastname', 'firstname', 'email'], 'string', 'max' => 256],
            [['auth_key', 'access_token'], 'string', 'max' => 128],            
            [['password','password_repeat'], 'string', 'max' => 64],
            ['password', 'compare'],
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
            'enabled' => 'Enabled',         
            'role' => 'Role',
            'auth_key' => 'AuthKey',
            'access_token' => 'Access Token',            
            'created_at' => 'Created at',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['user_id' => 'id']);
    }
    
    /**
     * 
     */    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->generateAuthKey();
                $this->generateAccessToken();
                $this->created_at = date("Y-m-d H:i:s");;
            }
            return true;
        }
        return false;
    }
    
        
    /**
     * 
     */    
    public function sendRegistrationMail()
    {
        $sender = Yii::$app->params['adminEmail'];
        return Yii::$app->mailer->compose()
            ->setFrom($sender)
            ->setTo($this->email)
            ->setSubject('Registration on NURE IRS Service')
            ->setHtmlBody('<p>Click here to confirm registration on <a href="irs?access_token='.$this->access_token.'">NURE IRS</a></p>')
            ->send();
    }
}
