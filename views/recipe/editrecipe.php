<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Edit Recipe';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid" style='width:80%'>
  <h1><?= Html::encode($this->title) ?></h1>

        <?php if (Yii::$app->session->hasFlash('editRecipeFormSubmitted')): ?>

            <div class="alert alert-success">
                Recipe edit succeed.
                <BR>
                <a href="../recipe/index?recipeId=<?=$recipe->recipeId?>">Return to recipe.</a>
            </div>

        <?php else: ?>


        <div class="row">
            <?php $form = ActiveForm::begin(['id' => 'editrecipe','options' => ['enctype' => 'multipart/form-data']]); ?>
                <?= $form->field($model, 'recipeId')->hiddenInput(['value' => $recipeId])->label(false) ?>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <?= $form->field($model, 'recipePhoto')->fileInput() ?>
                    <?= $form->field($model, 'recipeTitle')->textInput(['value' => $recipe->recipeTitle])->label('Recipe Title')  ?>
                    <?= $form->field($model, 'description')->textarea(['rows' => '5','value' => $recipe->description ])->label('Description')  ?>
                    
                </div>
            
            
            
                <div class="col-xs-0 col-sm-8 col-md-8 col-lg-8">

                    <?= $form->field($model, 'ingredient')->textarea(['rows' => '6','value' => $recipe->ingredient])->label('Ingredients')  ?>

                    <?= $form->field($model, 'direction')->textarea(['rows' => '8','value' => $recipe->direction])->label('Directions')  ?>
                    <?= $form->field($model, 'hashtags')->textInput(['data-role' => "tagsinput",'value' => $tagNames])->label('Hashtags')  ?>

                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'edit-recipe-button']) ?>
                    </div>
                        
                </div>
                    
            <?php ActiveForm::end(); ?>
                
                
            </div>
      
        <?php endif; ?>

</div>