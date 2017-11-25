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
    public $name;
    public $email;
    public $password;
    public $password_repeat;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'password', 'password_repeat'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            'password' => [['password'], 'string', 'max' => 60],
            // validates if the value of "password" attribute equals to that of "password_repeat"
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            ['name','validateName'],
        ];
    }

    public function validateName($attribute,$params){
        $user = User::findBySql("SELECT * FROM user WHERE username = '".$this->name."'")->one();
            if(empty($user)){
                return true;
            } 
            else{
                $this->addError($attribute, 'Username already used');
            }
        }
    

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    // public function signup($email)
    // {
    //     if ($this->validate()) {
    //         Yii::$app->mailer->compose()
    //             ->setTo($email)
    //             ->setFrom([$this->email => $this->name])
    //             ->setSubject("Sign Up")
    //             ->setTextBody($this->password)
    //             ->send();

    //         return true;
    //     }
    //     return false;
    // }

    // save signup data to db 
    public function signup()
    {
        if ($this->validate()) {
            Yii::$app->db->createCommand()->insert('user',[
               
                'username' => $this->name,
                'email' => $this->email,
                'password' => $this->password,
                'authKey' => md5(openssl_random_pseudo_bytes(20)),
                'active' => 1,
            ])->execute();
                return true;
            }
            /*catch(Exception $e){
                 echo 'Caught exception: ',  $e->getMessage(), "\n";
            }*/
        
        return false;
    }
}
