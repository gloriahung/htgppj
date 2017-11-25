<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Edit Profile';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-changePw col-md-6 col-md-offset-3">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('editFormSubmitted')): ?>

        <div class="alert alert-success">
            Profile edit succeed.
        </div>

    <?php else: ?>


        <div class="row">
            <div class="col-xs-12">

                <?php $form = ActiveForm::begin(['id' => 'edit']); ?>

                    <?= $form->field($model, 'icon')->fileInput() ?>

                    <?= $form->field($model, 'name')->textInput(['value' => "$user->username"]) ?>    

                    <?= $form->field($model, 'introduction')->textarea(['value' => "$user->userIntro"]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'edit-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    <?php endif; ?>
</div>
