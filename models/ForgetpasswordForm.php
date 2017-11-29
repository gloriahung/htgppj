<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Forget Password Form is the model behind the forget password form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class ForgetPasswordForm extends Model
{
    //public $username;
    public $email;




    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            //  email or username is required
            //   email must be a valid email
            //[['username', 'email'], 'my_required'],
            ['email', 'email'],
            ['email','required']
            
        ];
    }

    public function forgetpassword()
    {
        if($this->validate()){
<<<<<<< HEAD
            return true;
=======
            $user = User::findBySql('SELECT * FROM user WHERE email = "'.$this->email.'"')->one();

            if(empty($user))
                return false;

            $randPw = substr(md5(uniqid(mt_rand(), true)), 0, 8);

            Yii::$app->db->createCommand()->update('user', ['password' => Yii::$app->getSecurity()->generatePasswordHash($randPw)], 'id = '.$user->id)->execute();

            $body = "Dear ".$user->username.",\r\n
You have just reset your password on Borntocook.\r\n
Here's your new password.\r\n".$randPw.
"\r\nYou can now login your account with this new password.\r\n"
."http://" . $_SERVER['SERVER_NAME']."/web/site/login\r\n".
"Please reset your password immediately after you have logged in.\r\n
\r\n
Best Regards,\r\n
Borntocook";

            Yii::$app->mailer->compose()
                ->setTo($this->email)
                ->setFrom([Yii::$app->params['adminEmail']=> 'borntocook'])
                ->setSubject('Your password have been reset.')
                ->setTextBody($body)
                ->send();
                return true;


>>>>>>> 6ba8d03d2a080531175891c9e5d5d06f548cfc72
        }
        else{
            return false;
        }
    }

    //check if username or email have entered

    /*public function my_required($attribute, $params)
    {
        if (empty($this->username)
            && empty($this->email)
    ) {
        $this->addError($attribute,'At least 1 of the field must be filled up properly.');
            return false;
     
    }
            return true;
  
}

    public function forgetpassword()
    {
        if($this->validate){
            return true;
        }
        return false;

    }
    */

   
   
}
