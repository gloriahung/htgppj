<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */

$this->title = $recipe->recipeTitle;
$this->params['breadcrumbs'][] = $this->title;
?>

<?php if (Yii::$app->session->hasFlash('reportFormSubmitted')): ?>

        <div class="alert alert-success">
            Recipe reported.
        </div>
<?php else: ?>



    <div class="container-fluid" style='width:80%'>


    <h1> <?= Html::encode($this->title) ?> </h1>
        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="recipe-photo">
                <img src="../img/recipeImg/<?= $recipe->imageLink ?>"  alt="<?=$recipe->recipeTitle ?>" title="<?=$recipe->recipeTitle ?>">
            </div>
        
            <div class="rating">
                
                    <?php

                    if($recipe->numOfRate == 0){
                      $avgRating = 0;
                    }else{
                        $avgRating = $recipe->rating / $recipe->numOfRate;
                    }

                    $intRating = floor($avgRating);
                    $fraction = $avgRating - $intRating; 
                    $remainingRating = 5 - $intRating;

                    if($fraction>0) $remainingRating --;
                    for ($i=0; $i < $intRating ; $i++): ?>
                        <span class="glyphicon glyphicon-star"></span>
                    <?php endfor;
                    if($fraction>=0.5):?>
                    <i class="glyphicon glyphicon-star half" aria-hidden="true"></i>
                    <?php elseif($fraction != 0): $remainingRating ++; endif;
                    for ($i=0; $i < $remainingRating ; $i++): ?>
                        <span class="glyphicon glyphicon-star-empty"></span>
                    <?php endfor;?>

                (<?=$recipe->numOfRate?>)
                
                <a href ="#rate">Rate it</a>
            </div>
            
            <div class="Author">
                <img src="../img/userIcon/<?= $recipeUser->userIcon ?>" alt="<?=$recipeUser->username ?>" title="<?=$recipeUser->username ?>">
                By <a href="../profile/index?userId=<?=$recipe->userId?>">   <?=$recipeUser->username?>      </a>
            </div>
            
            <div class="button">
                <?php if (!Yii::$app->user->isGuest): ?>
                    <?php if (Yii::$app->user->identity->id == $recipe->userId ): ?>
                        <a href ="../recipe/editrecipe?recipeId=<?= $recipeId ?>"> <button type="button" class="btn btn-info">Edit Recipe</button> </a>
                    <?php else: ?>

                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#reportmodal">Report Post</button>
                    <?php endif; ?>


                <?php else: ?>
                <?php endif; ?>
            </div>
        <hr>



            
            <div id="reportmodal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h2 class="modal-title">Report Form</h2>
                        </div>

                        <?php $form1 = ActiveForm::begin(['id' => 'reportform','options' => ['enctype' => 'multipart/form-data']]); ?>
                        <div class="modal-body">
                            <p>Tell us your concern about this content so that we can review it to determine whether there has been a violation of terms of service. (Abuse of this feature is violation of terms of services.)</p>
                            <hr>
                                <?= $form1->field($model1, 'reportUser')->textInput(['value' => "$recipeUser->username",'readonly' => true])->label('Report User')  ?>

                                <?= $form1->field($model1, 'reportRecipe')->textInput(['value' => "$recipe->recipeTitle",'readonly' => true])->label('Report Recipe')  ?>
                            
                                <?= $form1->field($model1, 'description')->textarea(['rows' => '6','placeholder' => "Describe the problem or idea."])->label('Description')  ?>
                        </div>
                          
                        <div class="modal-footer">
                            <?= Html::submitButton('Submit', ['class' => 'btn float-right', 'name' => 'report-button']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
            


        </div>
    
    
    
        <div class="col-xs-0 col-sm-0 col-md-8 col-lg-8">
            <div class="row hashtagRow">
                <?php foreach($recipeTagArray as $tagId => $tagName): ?>
                    <?php if(Yii::$app->user->isGuest)
                        echo file_get_contents('http://'.$_SERVER['HTTP_HOST'].'/web/site/getsubscriblebtn?tagIds='.$tagId);
                    else
                        echo file_get_contents('http://'.$_SERVER['HTTP_HOST'].'/web/site/getsubscriblebtn?userId='.Yii::$app->user->identity->id.'&tagIds='.$tagId);    
                    ?>
                <?php endforeach;?>
            </div>


            
            <div class="description">
                <h2>Description</h2>
                <p style='word-wrap: break-word'> <?=$recipe->description ?> </p>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                    <div class="ingredient">
                        <h2>Ingredient</h2>
                        <ul type="bullet">
                            <?php $ingredientArray = explode("\r\n", $recipe->ingredient);
                                    foreach ($ingredientArray as $ingredient):
                            ?>
                            <li><?= $ingredient?></li>
                            <BR>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>  
                <div class="col-xs-0 col-sm-0 col-md-7 col-lg-7">
                    <div class="direction">
                        <h2>Directions</h2>
                        <ol type="number" style='word-wrap: break-word'>
                            <?php $directionArray = explode("\r\n", $recipe->direction);
                                    foreach ($directionArray as $direction):
                            ?>
                            <li><?= $direction?></li>
                            <BR>
                            <?php endforeach; ?>
                        </ol>
                    </div>      
                </div>
            </div>  
        </div>
    </div>
    <hr>
    
    <div class="comment">
        <h2>Comments &amp; Rating</h2>
        <?php if ($commentUserArray !=0 ): ?>

        <?php foreach ($comment as $value): ?>
        <div class="media-left">
            <img src="../img/userIcon/<?= $commentUserArray[$value->userId]['userIcon'] ?>" alt="<?=$commentUserArray[$value->userId]['username']?>" title="<?=$commentUserArray[$value->userId]['username']?>">
        </div>
        
        <div class="media-body">
            <a href="[link of commenter profile]"> <?=$commentUserArray[$value->userId]['username']?> </a>
            <div class="rating">
                <?php
                $rating = $value->rating;
                $remainingRating = 5 - $rating;
                
                for ($i=0; $i < $rating ; $i++): ?>
                    <span class="glyphicon glyphicon-star"></span>
                <?php endfor;
                
                for ($i=0; $i < $remainingRating ; $i++): ?>
                    <span class="glyphicon glyphicon-star-empty"></span>
                <?php endfor;?>
            </div>
            <?=$value->comment ?>
        </div>
        <hr>
        <?php endforeach; ?>

        <?php else: ?>
            No comment yet. Write the first comment down below.
        <?php endif; ?>
    </div>
    
    <hr>
    
    <?php if (Yii::$app->user->isGuest): ?>
       Comment section is not available. Please login.
    <?php else: ?>

    <div id="commentpart">
        <?php $form2 = ActiveForm::begin(['id' => 'commentform','options' => ['enctype' => 'multipart/form-data']]); ?>
        <h2 id = "rate" >What's your rating?</h2>
        
        <?= $form2->field($model2, 'recipeId')->hiddenInput(['value' => $recipeId])->label(false) ?>
        <div class="star-rating">   
                <span class="fa fa-star-o" data-rating="1"></span>
                <span class="fa fa-star-o" data-rating="2"></span>
                <span class="fa fa-star-o" data-rating="3"></span>
                <span class="fa fa-star-o" data-rating="4"></span>
                <span class="fa fa-star-o" data-rating="5"></span>
                <?= $form2->field($model2, 'rating')->hiddenInput(['value' => '','class' => 'rating-value'])->label(false) ?>
            </div>   

            <div class="media-left">
                <img src="../img/userIcon/<?= $myInfo->userIcon ?>" alt="<?=\Yii::$app->user->identity->username;?>" title="<?=\Yii::$app->user->identity->username;?>">
            </div>
            
            <div class="media-body">
                <?= $form2->field($model2, 'comment')->textarea(['rows' => '3','placeholder' => "Write your comment."])  ?>
            </div>
            
            <?= Html::submitButton('Submit', ['class' => 'btn btn-default float-right', 'name' => 'comment-button']) ?>

        <?php ActiveForm::end(); ?>
    </div>
    <?php endif; ?>




<?php endif; ?>
</div>
<script src="/web/js/starrating.js?t=<?=time();?>"></script>
<script src="/web/js/subscribe.js?t=<?=time();?>"></script>