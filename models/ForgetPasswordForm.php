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
            return true;
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
