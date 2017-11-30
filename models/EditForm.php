<?php

namespace app\models;
use Yii;
use yii\data\Pagination;
use yii\base\Model;
use app\models\User;
use yii\web\UploadedFile;


class EditForm extends Model{
	public $icon;
	public $username;
	public $introduction;

    public function rules()
    {
        return [
        [['username'], 'required'],
        [['icon'], 'file', 'skipOnEmpty' => true, 'extensions'=>'png, jpg, gif'],
        'username' => [['username'], 'string', 'max' => 20 ,'min' => 4],
        ['username','validateName'],
        'introduction' => [['introduction'], 'string', 'max' => 100]
        ];
    }

    public function validateName($attribute,$params){
    $user = User::findBySql("SELECT * FROM user WHERE username = '".$this->username."'")->one();
        if(empty($user)||$user->id==(Yii::$app->user->identity->id)){
            return true;
        } 
        else{
            $this->addError($attribute, 'Username already used');
        }
    }

    public function edit()
    {
        if ($this->validate()) {
            	$id = Yii::$app->user->identity->id; 
               
                Yii::$app->db->createCommand()->update('user', [
                    'username' => $this->username,
                    'userIntro' => $this->introduction
                ], 'id = "'.$id.'"')->execute();
                
                return true;
        }
        return false;
    }
}

