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
        [['icon'], 'file', 'skipOnEmpty' => true, 'extensions'=>'png, jpg, gif'],
        'name' => [['name'], 'string', 'max' => 60]];
    }


    public function edit()
    {
        if ($this->validate()) {
            try{
            	$id = Yii::$app->user->identity->id;
            	$user = User::findBySql('SELECT * FROM user WHERE id ='.$id)->one();

                if($this->name != null){
                Yii::$app->db->createCommand()->update('user', ['username' => $this->name], 'id = "'.$id.'"')->execute();
                }
                if ($this->introduction != null){
                Yii::$app->db->createCommand()->update('user', ['userIntro' => $this->introduction], 'id = "'.$id.'"')->execute();
                }
                return true;
            }
            catch(Exception $e){
                 echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }
        return false;
    }
}

