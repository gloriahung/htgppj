<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Tag;

class RecipeForm extends Model{
	
	
	public $recipeTitle;
	public $recipePhoto;
	public $description;
	public $ingredient;
	public $direction;
	public $hashtags;



	public function rules()
	{
		return [
			[['recipeTitle','description','ingredient','direction','hashtags','recipePhoto'],'required'],

			[['recipeTitle','hashtags'], 'string', 'max' => 100],
			[['recipePhoto'],'required' , 'on' =>'update-image'],
			['recipePhoto', 'file', 'extensions' => 'png, jpg'],

			[['description','ingredient'], 'string', 'max' => 1000],

			['direction', 'string', 'max' => 20000],


		];

	}

	public function save()
	{
		if($this->validate()) {
			$tagIdArray = array();
			$tagArray = explode(",", $this->hashtags);
			foreach($tagArray as $value) {
				$tag = Tag::findBySql('SELECT* FROM tag WHERE tag ="'.$value.'"')->one();
				if(empty($tag)){
					Yii::$app->db->createCommand()->insert('tag',['tag' => $value])->execute();
					$tag = Tag::findBySql('SELECT* FROM tag WHERE tag ="'.$value.'"')->one();
				}
				$tagIdArray[] = $tag->tagId;
			}
				$tagIds = implode(",", $tagIdArray);
				
			Yii::$app->db->createCommand()->insert('recipe',[			
				'userId' => Yii::$app->user->identity->id,
				'recipeTitle' => $this->recipeTitle,
				'imageLink' => $this->recipePhoto,
				'description' => $this->description,	
				'ingredient' => $this->ingredient,
				'direction' => $this->direction,
				'tagIds' => $tagIds,
			
			
			])->execute();
			return true;
		} else { 
			return false;
		}
	}

}

?>