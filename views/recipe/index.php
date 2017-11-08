<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */

$this->title = $recipe->recipeTitle.' - '.$recipeUser->username.' - BornToCook';
?>

<div class="container-fluid" style='width:80%'>
  <h1> <?=$recipe->recipeTitle?> </h1>
  
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="recipe-photo">
                <img src="../img/recipeImg/<?= $recipe->imageLink ?>"  alt="<?=$recipe->recipeTitle ?>" title="<?=$recipe->recipeTitle ?>">
            </div>
        
            <div class="rating">
                
                <?php
                $avgRating = $recipe->rating / $recipe->numOfRate;
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
                <img src="../userIcon/<?= $recipeUser->userIcon ?>" alt="<?=$recipeUser->username ?>" title="<?=$recipeUser->username ?>">
                By <a href="../profile/index?userId=<?=$recipe->userId?>">   <?=$recipeUser->username?>      </a>
            </div>
            
            <div class="button">
                <button type="button" class="btn btn-info">Follow Author</button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#reportform">Report Post</button>
            </div>
            
            <div id="reportform" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h2 class="modal-title">Report Form</h2>
                        </div>
                      
                        <div class="modal-body">
                            <p>Tell us your concern about this content so that we can review it to determine whether there has been a violation of terms of service. (Abuse of this feature is violation of terms of services.)</p>
                            <hr>
                            <form action="/action_page.php">
                                <div class="form-group">
                                    <label for="reportuser">Report User</label>
                                    <input type="input" class="form-control" id="reportuser" value="<?=$recipeUser->username?>" name="reportuser">
                                </div>
                                <div class="form-group">
                                    <label for="reportrecipe">Report Recipe</label>
                                    <input type="input" class="form-control" id="reportrecipe" value="<?=$recipe->recipeTitle?>" name="reportrecipe">
                                </div>
                            
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea rows="6" class="form-control" id="description" placeholder="Describe the problem or idea." name="description"></textarea>
                                </div>
                            </form>
                        </div>
                          
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default">summit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    
    
        <div class="col-xs-0 col-sm-0 col-md-8 col-lg-8">
            <div class="hashtag">
				<?php foreach($recipeTagArray as $tagId => $tagName): ?>
					<a href ="../tagId?=<?=$tagId?>"> <span class="label label-warning"> #<?=$tagName?></span> </a>
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
                            <?php $ingredientArray = explode(",", $recipe->ingredient);
									foreach ($ingredientArray as $ingredient):
							?>
							<li><?= $ingredient?></li>
							<?php endforeach; ?>
                        </ul>
                    </div>
                </div>  
                <div class="col-xs-0 col-sm-0 col-md-7 col-lg-7">
                    <div class="direction">
                        <h2>Directions</h2>
                        <ol type="number" style='word-wrap: break-word'>
                            <?php $directionArray = explode(",", $recipe->direction);
                                    foreach ($directionArray as $direction):
                            ?>
                            <li><?= $direction?></li>
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

        <?php foreach ($comment as $value): ?>
        <div class="media-left">
            <img src="../userIcon/<?= $commentUserArray[$value->userId]['userIcon'] ?>" alt="<?=$commentUserArray[$value->userId]['username']?>" title="<?=$commentUserArray[$value->userId]['username']?>">
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
    </div>
    
    <hr>
    
    <div class="writecomment" id="rate">
        <h2>What's your rating?</h2>
            <div class="media-left">
                <img src="http://placehold.it/36x36" alt="<?=\Yii::$app->user->identity->username;?>" title="<?=\Yii::$app->user->identity->username;?>">
            </div>

            <div class="media-body">
                <div class="rate">
                    <span class="glyphicon glyphicon-star-empty"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                </div>
                <textarea rows="3" class="form-control" id="commentbox" placeholder="Write Your comment." name="commentbox"></textarea>
            </div>
        <button type="button" class="btn btn-default pull-right">Post</button>

    </div>
  
</div>
