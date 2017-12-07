<?php

namespace app\models;

use Yii;
use yii\base\Model;

class CommentForm extends Model{
	
	public $recipeId;
	public $rating;
	public $comment;

	public function rules()
	{
		return [
			[['recipeId','rating','comment'],'required'],

			['rating', 'integer', 'max' => 10],
			['comment','string', 'max' => 500],
		];

	}

	public function save()
	{
		if($this->validate()) {
			try{

				Yii::$app->db->createCommand()->insert('comment', [
					'userId' => Yii::$app->user->identity->id,
					'recipeId' => $this->recipeId,
					'rating' => $this->rating,
					'comment' => $this->comment,
				])->execute();	

				return true;
				
			}
            catch(Exception $e){
                 echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
		} else { 
			return false;
		}
	}

}

?>