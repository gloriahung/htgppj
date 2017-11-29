<?php

namespace app\models;
use Yii;
use yii\data\Pagination;
use yii\base\Model;
use app\models\User;

class ChangePwForm extends Model{
	public $old_password;
	public $password;
	public $comfirm_password;

    private $_user = false;

    public function rules()
    {
        return [
            [['old_password', 'password', 'comfirm_password'], 'required'],
            'password' => [['password'], 'string', 'max' => 20 ,'min' => 6],
            // validates if the value of "password" attribute equals to that of "comfirm_password"
            ['comfirm_password', 'compare', 'compareAttribute' => 'password'],
            ['old_password', 'validateOldPassword'],
        ];
    }


    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateOldPassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->old_password)) {
                $this->addError($attribute, 'Incorrect old passwordd.');
            }
        }
    }

        /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findIdentity(Yii::$app->user->identity->id);
        }

        return $this->_user;
    }

    public function changepw()
    {
        if ($this->validate()) {
            try{
            	
                Yii::$app->db->createCommand()->update('user', ['password' => Yii::$app->getSecurity()->generatePasswordHash($this->password)], 'id = "'.Yii::$app->user->identity->id.'"')->execute();
                return true;
            }
            catch(Exception $e){
                 echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }
        return false;
    }
}

