<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * SignUpForm is the model behind the sign up form.
 */
class ReportForm extends Model
{
    public $report_User;
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
        ];
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
            try{
                $user = new User();
                $user->username = $this->name;
                $user->email = $this->email;
                $user->password = $this->password;
                $user->authKey = md5(openssl_random_pseudo_bytes(20));
                $user->active = 1;
                $user->save();
                return true;
            }
            catch(Exception $e){
                 echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }
        return false;
    }
}
