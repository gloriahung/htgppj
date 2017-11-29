<?php

namespace app\models;
use Yii;
use yii\data\Pagination;
use yii\base\Model;
use app\models\User;
use yii\web\UploadedFile;


class EditForm extends Model{
	public $icon;
	public $name;
	public $introduction;

    public function rules()
    {
        return [
        [['name', 'introduction'], 'required'],
        [['icon'], 'file', 'skipOnEmpty' => true, 'extensions'=>'png, jpg, gif'],
        'name' => [['name'], 'string', 'max' => 20 ,'min' => 4],
        'introduction' => [['introduction'], 'string', 'max' => 100]];
    }


    public function edit()
    {
        if ($this->validate()) {
            try{
            	$id = Yii::$app->user->identity->id; 
               
                Yii::$app->db->createCommand()->update('user', ['username' => $this->name], 'id = "'.$id.'"')->execute();
               
             
                Yii::$app->db->createCommand()->update('user', ['userIntro' => $this->introduction], 'id = "'.$id.'"')->execute();
                
                return true;
            }
            catch(Exception $e){
                 echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }
        return false;
    }
}

