<?php

namespace app\models;

use Yii;
use yii\base\Model;

class ReportForm extends Model{
	
	
	public $reportUser;
	public $reportRecipe;
	public $description;

	public function rules()
	{
		return [
			[['reportUser','reportRecipe','description'],'required'],

			['reportUser', 'string', 'max' => 30],
			['reportRecipe','string', 'max' => 100],
			['description', 'string', 'max' => 500],
		];

	}

	public function save()
	{
		if($this->validate()) {
			$reportUserId = User::findBySql('SELECT* FROM user WHERE username = "'.$this->reportUser.'"')->one();
			$recipeId = Recipe::findBySql('SELECT* FROM recipe WHERE recipeTitle= "'.$this->reportRecipe.'"')->one();
				
			Yii::$app->db->createCommand()->insert('report',[			
				'reporterId' => Yii::$app->user->identity->id,
				'reportUserId' => $reportUserId->id,
				'recipeId' => $recipeId->recipeId,
				'description' => $this->description,
			
			])->execute();
			return true;
		} else { 
			return false;
		}
	}

}

?>