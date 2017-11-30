<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Tag;
use yii\web\UploadedFile;

class EditRecipeForm extends Model{
	
	public $recipeId;
	public $recipeTitle;
	public $recipePhoto;
	public $description;
	public $ingredient;
	public $direction;
	public $hashtags;



	public function rules()
	{
		return [

			[['recipeTitle','hashtags'], 'string', 'max' => 100],

			[['recipePhoto'], 'file', 'skipOnEmpty' => true, 'extensions'=>'png, jpg, gif'],

			[['description','ingredient'], 'string', 'max' => 1000],

			['direction', 'string', 'max' => 20000],


		];

	}

	public function edit()
	{
		if($this->validate()) {
			$tagIdArray = array();
			$tagArray = explode(",", $this->hashtags);
			foreach($tagArray as $value) {
				$tag = Tag::findBySql('SELECT* FROM tag WHERE tag ="'.$value.'"')->one();
				if(empty($tag)){
					Yii::$app->db->createCommand()->insert('tag',['tag' => $value])->execute();
					$tag = Tag::findBySql('SELECT* FROM tag WHERE tag ='.$value)->one();
				}
				$tagIdArray[] = $tag->tagId;
			}
				$tagIds = implode(",", $tagIdArray);
				
			try{

				Yii::$app->db->createCommand()->update('recipe', [
					'recipeTitle' => $this->recipeTitle, 
					'description' => $this->description, 
					'ingredient' => $this->ingredient, 
					'direction' => $this->direction, 
					'tagIds' => $tagIds,
				], 'recipeId = '.htmlspecialchars($_GET['recipeId']))->execute();	

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