<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = 'Profile - cook';

?><!-- 
<script src = "../js/aJaxtesting.js"></script> --><!-- 
<script src="/dev3/web/assets/a8f6f288/jquery.js"></script> -->
<script>
    function fnBookmark(userid,usinguserid){

$.ajax({
                    url:'follow?userid='+userid+'&usinguserid='+usinguserid,
                    type:'GET',
                    dataType:'json',
                    success:function(data){
                          if(data == 1)
                          {
                                  // $("#afollowbutton").attr("class", "unfollow");
                                $("#afollowbutton").text("follow");
                          }
                          else if(data == 0)
                          {
                              // $("#afollowbutton").attr("class", "follow");
                                $("#afollowbutton").text("unfollow");
                          }
                    
                    }
        });
}
    </script>
<div class="text-center">
  <div class="row">
    <br><br>
    <div class="col-md-5">
      <div class="profilepic" >
        <img src="../img/userIcon/<?= $userInfo->userIcon ?>" class="img-rounded" alt="Profile picture" title="Profile picture">
      </div>
     </div>
  <div class="col-md-7 text-left">
     <h1><?= $userInfo->username ?>&nbsp&nbsp 
            <?php if ($followed == 0): ?>
              <button type="button" id="afollowbutton" class="follow btn btn-default btn-sm" onClick ="fnBookmark(<?= $userInfo->id ?>,<?= $usinguserId?>)">follow</button> 
            <?php else: ?>
              <?php if($followed == 1): ?>
                   <button type="button" id="afollowbutton" class="unfollow btn btn-default btn-sm" onClick ="fnBookmark(<?= $userInfo->id ?>,<?= $usinguserId?>)">unfollow</button>
                <?php else: ?>
                    <a href ="../profile/edit"><img src="../img/profileImg/editbutton.png" class="img-rounded" alt="edit button" title="edit button" width="20px" height="20px"  style="filter:alpha(opacity=50); opacity:.50; "></a>
                <?php endif; ?>
            <?php endif; ?>
        
            </h1>
      <div id ="followandscription_font">
        <a href = "../profile/followsub?userId=<?= $userInfo->id ?>">following&nbsp;&nbsp;: <?= $numOfFol ?>&nbsp;&nbsp;subscription  : <?= $numOfSub ?>
        </a>
        <br>
        post&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $numOfPost ?>
        <br>
      </div>
      <br>
      <p><?= $userInfo->userIntro ?></p> 
      <br>
    </div>
    
  </div>
  <hr>
 <div id="masonry-rows">
            <div class="row recipe-index">
            <?php foreach ($recipes as $recipe): 
                if($recipe->numOfRate!=0)
                $avgRating = $recipe->rating / $recipe->numOfRate;
                else
                $avgRating = 0;
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


