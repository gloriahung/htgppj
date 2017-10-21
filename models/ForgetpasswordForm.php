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
    public $username;
    public $email;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            //  email or username is required
            //   email must be a valid email
            ['username, email', 'my_required'],
            ['email', 'email'],
            
        ];
    }

    //check if username or email have entered

    public function my_required($attribute_name, $params)
{
        if (empty($this->username)
            && empty($this->email)
    ) {
        $this->addError($attribute,'At least 1 of the field must be filled up properly.');

        return false;
    }

    return true;
}
    

    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByEmail($this->username);
        }

        return $this->_user;
    }
}
