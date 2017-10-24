<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "recipe".
 *
 * @property integer $recipeId
 * @property integer $userId
 * @property string $recipeTitle
 * @property string $imageLinks
 * @property string $description
 * @property string $ingredient
 * @property string $direction
 * @property string $tagIds
 * @property integer $rating
 * @property integer $numOfRate
 * @property string $time
 */
class Recipe extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'recipe';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'recipeTitle', 'imageLinks', 'description', 'ingredient', 'direction', 'tagIds', 'rating', 'numOfRate', 'time'], 'required'],
            [['userId', 'rating', 'numOfRate'], 'integer'],
            [['time'], 'safe'],
            [['recipeTitle'], 'string', 'max' => 100],
            [['imageLinks'], 'string', 'max' => 200],
            [['description', 'ingredient', 'tagIds'], 'string', 'max' => 1000],
            [['direction'], 'string', 'max' => 20000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'recipeId' => 'Recipe ID',
            'userId' => 'User ID',
            'recipeTitle' => 'Recipe Title',
            'imageLinks' => 'Image Links',
            'description' => 'Description',
            'ingredient' => 'Ingredient',
            'direction' => 'Direction',
            'tagIds' => 'Tag Ids',
            'rating' => 'Rating',
            'numOfRate' => 'Num Of Rate',
            'time' => 'Time',
        ];
    }
}
