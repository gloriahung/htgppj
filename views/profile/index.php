<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = 'Profile - cook';

?><!-- 
<script src = "../js/aJaxtesting.js"></script> --><!-- 
<script src="/dev3/web/assets/a8f6f288/jquery.js"></script> -->

<div class="text-center">

  <div class="row">
    <br><br>
    <div class="col-md-5">
      <?php if($userInfo->userIcon != null): ?>
      <div class="profilepic" >
        <img src="../img/userIcon/<?= $userInfo->userIcon ?>" class="img-rounded" alt="Profile picture" title="Profile picture">
      </div>
    <?php else: ?>
      <div class="profilepic" >
        <img src="../img/userIcon/default.jpg" class="img-rounded" alt="Profile picture" title="Profile picture">
      </div>
    <?php endif; ?>
     </div>
  <div class="col-md-7 text-left">
     <h1><?= Html::encode($userInfo->username) ?>&nbsp&nbsp 
            <?php if ($followed == 0): ?>
              <button type="button" id="afollowbutton" class="follow btn btn-default btn-sm" onClick ="fnBookmark(<?= $userInfo->id ?>,<?= $usinguserId?>)">follow</button> 
            <?php else: ?>
              <?php if($followed == 1): ?>
                   <button type="button" id="afollowbutton" class="unfollow btn btn-default btn-sm" onClick ="fnBookmark(<?= $userInfo->id ?>,<?= $usinguserId?>)">unfollow</button>
                <?php else: ?>
                  <?php if($followed == 2): ?>
                    <a href ="../profile/edit"><img src="../img/profileImg/editbutton.png" class="img-rounded" alt="edit button" title="edit button" width="20px" height="20px"  style="filter:alpha(opacity=50); opacity:.50; "></a>
                  <?php else: ?>
                <?php endif; ?>
            <?php endif; ?>
          <?php endif; ?>
        
            </h1>
      <div id ="followandscription_font">
        <a href = "../profile/followsub?userId=<?= $userInfo->id ?>" style="text-decoration: none">following&nbsp;&nbsp;: <?= $numOfFol ?>&nbsp;&nbsp;subscription  : <?= $numOfSub ?>
        </a>
        <br>
        post&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $numOfPost ?>
        <br>
      </div>
      <br>
      <p><?= Html::encode($userInfo->userIntro) ?></p>
      <br>
    </div>
    
  </div>
  <hr>
 <div id="masonry-rows">
            <div class="row recipe-index">
            <?php foreach ($recipes as $recipe):
                if($recipe->numOfRate == 0){
                  $avgRating = 0;
                }else{
                $avgRating = $recipe->rating / $recipe->numOfRate;
              }
            ?>
                <div class="col-sm-6 col-md-4 each-recipe">
                    <a href="/web/recipe/index?recipeId=<?= $recipe->recipeId ?>">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <img src="../img/recipeImg/<?= $recipe->imageLink ?>" class="_2di5p" alt="recipe image" title="recipe image">
                                <br>
                            </div>    
                            <div class="panel-footer">
                            <h4><?= Html::encode($recipe->recipeTitle) ?></h4>
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
                                    <?= Html::encode($recipe->description) ?>
                                </p>
                                <p class="info">
                                    By <a href="index?userId=<?= $recipe->userId ?>"> <?= Html::encode($userInfo->username) ?> </a> 
                                    <div class="row hashtagRow"> 
                                    <?php foreach($tag[$recipe->recipeId] as $tagId => $tagName): ?>
                              
                                      <?php if(Yii::$app->user->isGuest)
                                                echo file_get_contents('http://'.$_SERVER['HTTP_HOST'].'/web/site/getsubscriblebtn?tagIds='.$tagId);
                                            else
                                                echo file_get_contents('http://'.$_SERVER['HTTP_HOST'].'/web/site/getsubscriblebtn?userId='.Yii::$app->user->identity->id.'&tagIds='.$tagId);    
                                       ?>
                                       <!--  <a href="?tagId=<?= $tagId ?>"><span class="label label-default">#<?= $tagName ?></span></a> -->
                                    <?php endforeach;?>
                                    </div>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div>


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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.2/masonry.pkgd.js"></script>
<script type='text/javascript'>
var container = document.querySelector('.recipe-index');
var msnry = new Masonry( container, {
   itemSelector: '.each-recipe'
});          

</script>
<script src="/web/js/subscribe.js?t=<?=time();?>"></script>

