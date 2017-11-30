<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = 'Write a new Recipe';
?>
<div class="container-fluid" style='width:80%'>
  <h1><?= Html::encode($this->title) ?></h1>

        <?php if (Yii::$app->session->hasFlash('postFormSubmitted')): ?>

            <div class="alert alert-success">
                New recipe posted.
            </div>

        <?php else: ?>

          

            <div class="row">
            <?php $form = ActiveForm::begin(['id' => 'postform','options' => ['enctype' => 'multipart/form-data']]); ?>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <!-- <div class="uploadPhoto">
                        <label class="photoUploader">
                            

                            <span>Take a photo </span>
                            <span>(no smaller than 200 X 200)</span>
                        </label>   
                    </div> -->
                    <?= $form->field($model, 'recipePhoto')->fileInput() ?>
                    <?= $form->field($model, 'recipeTitle')->textInput(['placeholder' => "Add a title for your recipe."])->label('Recipe Title')  ?>
                    <?= $form->field($model, 'description')->textarea(['rows' => '5','placeholder' => "Write few words about your recipe."])->label('Description')  ?>
                    
                </div>
            
            
            
                <div class="col-xs-0 col-sm-8 col-md-8 col-lg-8">
                    <?= $form->field($model, 'ingredient')->textarea(['rows' => '6','placeholder' => "Seperate each ingredient with a comma."])->label('Ingredients')  ?>
                    <?= $form->field($model, 'direction')->textarea(['rows' => '8','placeholder' => "Seperate each step with a comma.."])->label('Directions')  ?>
                    <?= $form->field($model, 'hashtags')->textInput(['data-role' => "tagsinput",'placeholder' => "Press Enter-key to add a tag."])->label('Hashtags')  ?>

                    <div class="form-group">
                        <?= Html::submitButton('Post', ['class' => 'btn float-right', 'name' => 'recipe-button']) ?>
                    </div>
                        
                </div>
                    
            <?php ActiveForm::end(); ?>
                
                
            </div>
      
        <?php endif; ?>

</div>