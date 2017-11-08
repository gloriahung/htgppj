<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = 'Profile - cook';

?>
<div class="text-center">
  <div class="row">
    <br><br>
    <div class="col-md-5">
      <div class="profilepic" >
        <img src="../img/userIcon/<?= $userInfo->userIcon ?>" class="img-rounded" alt="Profile picture" title="Profile picture">
      </div>
     </div>
  <div class="col-md-7 text-left">
     <h1><?= $userInfo->username ?></h1>
      <div id ="followandscription_font">
        <a href = "../profile/followsub?userId=<?= $userInfo->id ?>">following&nbsp;&nbsp;: <?= $numOfFol ?>&nbsp;&nbsp;subscription  : <?= $numOfSub ?>
        </a>
        &nbsp&nbsp<button type="button" class="btn btn-default btn-sm">follow</button>
        <br>
        post&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $numOfPost ?>
        <br>
      </div>
      <p contenteditable="true"><?= $userInfo->userIntro ?></p> 
      <br>
    </div>
    
  </div>
  <hr>
 <div id="masonry-rows">
            <div class="row recipe-index">
            <?php foreach ($recipes as $recipe): 
                $avgRating = $recipe->rating / $recipe->numOfRate;
            ?>
                <div class="col-sm-6 col-md-4 each-recipe">
                    <a href="recipe/index?recipeId=<?= $recipe->recipeId ?>">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <img src="../img/recipeImg/<?= $recipe->imageLink ?>" class="_2di5p" alt="recipe image" title="recipe image">
                                <br>
                            </div>    
                            <div class="panel-footer">
                            <h4><?= $recipe->recipeTitle ?></h4>
                                <div class="rating">
                                    <?php 
                                    $intRating = floor($avgRating);
                                    $fraction = $avgRating - $intRating; 
                                    $remainingRating = 5 - $intRating;
                                    if($fraction>0) $remainingRating --;
                                    for ($i=0; $i < $intRating ; $i++): ?>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    <?php endfor;
                                    if($fraction>=0.5):?>
                                    <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                    <?php elseif($fraction != 0): $remainingRating ++; endif;
                                    for ($i=0; $i < $remainingRating ; $i++): ?>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <?php endfor;?>
                                </div>
                                <p class="description">
                                    <?= $recipe->description ?>
                                </p>
                                <p class="info">
                                    By <a href="profile/index?userId=<?= $recipe->userId ?>"> <?= $userInfo->username ?> </a>
                                    <?php foreach($tag[$recipe->recipeId] as $tagId => $tagName): ?>
                                        <a href="?tagId=<?= $tagId ?>"><span class="label label-default">#<?= $tagName ?></span></a>
                                    <?php endforeach;?>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
  
</div>
