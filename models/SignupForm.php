<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * SignUpForm is the model behind the sign up form.
 */
class SignUpForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_repeat;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username, email, subject and body are required
            [['username', 'email', 'password', 'password_repeat'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            'password' => [['password'], 'string', 'max' => 20 ,'min' => 6],
            'username' => [['username'], 'string', 'max' => 20 ,'min' => 4],
            // validates if the value of "password" attribute equals to that of "password_repeat"
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            ['username','validateName'],
            // email is validated by validateEmail()
            ['email', 'validateEmail'],
        ];
    }

    public function validateName($attribute,$params){
        $user = User::findBySql("SELECT * FROM user WHERE username = '".$this->username."'")->one();
            if(empty($user)){
                return true;
            } 
            else{
                $this->addError($attribute, 'Username already used');
            }
    }

    public function validateEmail($attribute,$params){
        $email = User::findBySql("SELECT * FROM user WHERE email = '".$this->email."'")->one();
            if(empty($email)){
                return true;
            } 
            else{
                $this->addError($attribute, 'Email already registered');
            }
    }
    

    // save signup data to db 
    public function signup()
    {
        if ($this->validate()) {
            Yii::$app->db->createCommand()->insert('user',[
               
                'username' => $this->username,
                'email' => $this->email,
                'password' => Yii::$app->getSecurity()->generatePasswordHash($this->password),
                'authKey' => md5(openssl_random_pseudo_bytes(20)),
                'active' => 1,
            ])->execute();
                return true;
            }
        
        return false;
    }
}
