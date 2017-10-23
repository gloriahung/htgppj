<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * SignUpForm is the model behind the sign up form.
 */
class RecipeForm extends Model
{
    public $recipephoto;
    public $title;
    public $description;
    public $ingredient;
    public $direction;
    public $hashtag;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['recipePhoto', 'recipeTitle', 'description', 'ingredients', 'direction','hashtags'], 'required'],
            
            [['recipePhoto'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
        {
            if ($this->validate()) {
                $this->recipePhoto->saveAs('uploads/' . $this->recipePhoto->baseName . '.' . $this->recipePhoto->extension);
                return true;
            } else {
                return false;
            }
        }




    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    // public function signup($email)
    // {
    //     if ($this->validate()) {
    //         Yii::$app->mailer->compose()
    //             ->setTo($email)
    //             ->setFrom([$this->email => $this->name])
    //             ->setSubject("Sign Up")
    //             ->setTextBody($this->password)
    //             ->send();

    //         return true;
    //     }
    //     return false;
    // }

    // save signup data to db 
    public function recipe()
    {
        if ($this->validate()) {
            try{
                $recipe = new Recipe();
                $recipe->title = $this->title;
                $recipe->photo = $this->photo;
                $recipe->description = $this->description;
                $recipe->ingredient = $this->ingredient;
                $recipe->direction = $this->direction;
                $recipe->direction = $this->hashtag;
                $recipe->save();
                return true;
            }
            catch(Exception $e){
                 echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }
        return false;
    }
}
