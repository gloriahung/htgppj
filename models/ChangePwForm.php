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

    public function rules()
    {
        return [
            [['old_password', 'password', 'comfirm_password'], 'required'],
            'password' => [['password'], 'string', 'max' => 60],
            // validates if the value of "password" attribute equals to that of "comfirm_password"
            ['comfirm_password', 'compare', 'compareAttribute' => 'password'],
        ];
    }


    public function changepw()
    {
        if ($this->validate()) {
            try{
            	$id = Yii::$app->user->identity->id;
            	$user = User::findBySql('SELECT * FROM user WHERE id ='.$id)->one();
            	if ($user->password!= $this->old_password){
            		 Yii::$app->session->setFlash('IncorrectPassword');
            		return false;
            	}
                Yii::$app->db->createCommand()->update('user', ['password' => $this->password], 'id = "'.$id.'" and password = "'.$this->old_password.'"')->execute();
                return true;
            }
            catch(Exception $e){
                 echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }
        return false;
    }
}

