<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Change Password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-changePw col-md-6 col-md-offset-3">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('changePwFormSubmitted')): ?>

        <div class="alert alert-success">
            Change password succeed.
        </div>

    <?php else: ?>


        <div class="row">
            <div class="col-xs-12">

                <?php $form = ActiveForm::begin(['id' => 'changepw']); ?>

                <?php if (Yii::$app->session->hasFlash('IncorrectPassword')): ?>
                    <div class="alert alert-success">
                       Incorrect old password.
                    </div>
                <?php endif; ?>

                    <?= $form->field($model, 'old_password')->passwordInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <?= $form->field($model, 'comfirm_password')->passwordInput() ?>

                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    <?php endif; ?>
</div>
