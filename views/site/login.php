<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login col-md-6 col-md-offset-3">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <div>
        <div class="col-xs-12">
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "{label}\n<div>{input}</div>\n<div>{error}</div>",
                    'labelOptions' => ['class' => 'control-label'],
                ],
            ]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <div class="col-lg-3 rememberMe">
                        <input type="hidden" name="LoginForm[rememberMe]" value="0">
                        <input type="checkbox" id="loginform-rememberme" name="LoginForm[rememberMe]" value="1" checked="">
                        <label for="loginform-rememberme">Remember Me</label>
                    </div>
                    <div class="col-lg-3 forgetpassword">
                        <a href="../site/forgetpassword">Forget Password</a>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-offset-1 col-lg-11">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
