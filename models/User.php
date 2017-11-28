<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $authKey
 * @property integer $active
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'active'], 'required'],
            [['id', 'active'], 'integer'],
            [['username', 'password'], 'string', 'max' => 30],
            [['email'], 'string', 'max' => 40],
            [['authKey'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'authKey' => 'Auth Key',
            'active' => 'Active',
            'role' => 'Role',
        ];
    }

    public function getAuthKey(){
        return $this->authKey;
    }

    public function getRole(){
        return $this->role;
    }

    public function getId(){
        return $this->id;
    }

    public function validateAuthKey($authKey){
        return $this->authKey === $authKey;
    }

    public static function findIdentity($id){
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null){
        throw new \yii\base\NotSupportedException();
    }

    public static function findByUsername($username){
        return self::findOne(['username'=>$username]);
    }

    public function validatePassword($password){
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
        // return $this->password === $password;
    }

    public function validateRole($role){
        return $this->role === $role;
    }
}
