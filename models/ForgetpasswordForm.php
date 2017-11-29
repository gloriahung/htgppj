<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * Forget Password Form is the model behind the forget password form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class ForgetPasswordForm extends Model
{

    public $email;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['email', 'email'],
            ['email','required']
            
        ];
    }

    public function forgetpassword()
    {
        if($this->validate()){
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


        }
        else{
            return false;
        }
    }
   
}
