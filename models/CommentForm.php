<?php

namespace app\models;

use Yii;
use yii\base\Model;
/**
 * SignUpForm is the model behind the sign up form.
 */
class CommentForm extends Model
{
    public $rate;
    public $comment;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['rate', 'comment'], 'required'],
        ];
    }

    // save signup data to db 
    public function comment()
    {
        if ($this->validate()) {
            try{
                $comment = new Comment();
                $comment->rate = $this->rate;
                $comment->comment = $this->comment;
                $comment->active = 1;
                $comment->save();
                return true;
            }
            catch(Exception $e){
                 echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }
        return false;
    }
}
