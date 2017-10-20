<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\FoegetpasswordForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
$this->title = 'Forget Password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-forgetpassword col-md-12">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('forgetpasswordFormSubmitted')): ?>

        <div class="alert alert-success">
            A new password have been sent to your mail box,
            please login with the new password
            You are advised to reset your password immediately after login.
        </div>

    <?php else: ?>

    <div class="col-md-12">
        <p>please enter your username or email address, a new password will be sent to your mail box</p>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?php $form = ActiveForm::begin(['id' => 'forgetpassword-form']); ?>

                    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'email') ?>


                    <div class="form-group">
                        <?= Html::submitButton('Retrieve Password', ['class' => 'btn btn-primary', 'name' => 'forgetpassword-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    <?php endif; ?>
</div>