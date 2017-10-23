<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * SignUpForm is the model behind the sign up form.
 */
class ReportForm extends Model
{
    public $reason;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['reason'], 'required'],
        ];
    }


    public function report()
    {
        if ($this->validate()) {
            try{
                $report = new Report();
                $report->reason = $this->reason;
                $report->save();
                return true;
            }
            catch(Exception $e){
                 echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }
        return false;
    }
}
