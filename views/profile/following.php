<?php

/* @var $this yii\web\View */

$this->title = 'Following';
$this->params['breadcrumbs'][] = $this->title;
?>


	<h1>Following: XX</h1>
	
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
                                    By <a href="profile/index?userId=<?= $recipe->userId ?>"> <?= $user[$recipe->recipeId]?> </a>
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
      <h5>Description</h5>
      <p>1XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</p>
    </div>
    <div class = "col-md-6 col-lg-4">
      <a href=#><img src="http://www.mimicollection.hk/image/cache/catalog/Monchhichi/241378-800x800.jpg" class="_2di5p" alt="Postpic" title="Postpic"></a>
      <br>
      <h4>[Recipe Title]</h4>
        <div class="rating">
          <span class ="glyphicon glyphicon-star-empty"></span>
          <span class ="glyphicon glyphicon-star-empty"></span>
          <span class ="glyphicon glyphicon-star-empty"></span>
          <span class ="glyphicon glyphicon-star-empty"></span>
          <span class ="glyphicon glyphicon-star-empty"></span>
        </div>
      <h5>Description</h5>
      <p>2XXXXXXXXXXXXXXXXXXXXXX</p>
    </div><div class = "col-md-6 col-lg-4">
      <a href=#><img src="http://www.mimicollection.hk/image/cache/catalog/Monchhichi/241378-800x800.jpg" class="_2di5p" alt="Postpic" title="Postpic"></a>
      <br>
      <h4>[Recipe Title]</h4>
        <div class="rating">
          <span class ="glyphicon glyphicon-star-empty"></span>
          <span class ="glyphicon glyphicon-star-empty"></span>
          <span class ="glyphicon glyphicon-star-empty"></span>
          <span class ="glyphicon glyphicon-star-empty"></span>
          <span class ="glyphicon glyphicon-star-empty"></span>
        </div>
      <h5>Description</h5>
      <p>3XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</p>
    </div>
    <div class = "col-md-6 col-lg-4">
      <a href=#><img src="http://www.mimicollection.hk/image/cache/catalog/Monchhichi/241378-800x800.jpg" class="_2di5p" alt="Postpic" title="Postpic"></a>
      <br>
      <h4>[Recipe Title]</h4>
        <div class="rating">
          <span class ="glyphicon glyphicon-star-empty"></span>
          <span class ="glyphicon glyphicon-star-empty"></span>
          <span class ="glyphicon glyphicon-star-empty"></span>
          <span class ="glyphicon glyphicon-star-empty"></span>
          <span class ="glyphicon glyphicon-star-empty"></span>
        </div>
      <h5>Description</h5>
      <p>4XXXXX</p>
    </div>
    <div class = "col-md-6 col-lg-4">
     <a href=#><img src="http://www.mimicollection.hk/image/cache/catalog/Monchhichi/241378-800x800.jpg" class="_2di5p" alt="Postpic" title="Postpic"></a>
      <br>
      <h4>[Recipe Title]</h4>
        <div class="rating">
          <span class ="glyphicon glyphicon-star-empty"></span>
          <span class ="glyphicon glyphicon-star-empty"></span>
          <span class ="glyphicon glyphicon-star-empty"></span>
          <span class ="glyphicon glyphicon-star-empty"></span>
          <span class ="glyphicon glyphicon-star-empty"></span>
        </div>
      <h5>Description</h5>
      <p>5XXXXX</p>
    </div>
    <div class = "col-md-6 col-lg-4">
     <a href=#><img src="http://www.mimicollection.hk/image/cache/catalog/Monchhichi/241378-800x800.jpg" class="_2di5p" alt="Postpic" title="Postpic"></a>
      <br>
      <h4>[Recipe Title]</h4>
        <div class="rating">
          <span class ="glyphicon glyphicon-star-empty"></span>
          <span class ="glyphicon glyphicon-star-empty"></span>
          <span class ="glyphicon glyphicon-star-empty"></span>
          <span class ="glyphicon glyphicon-star-empty"></span>
          <span class ="glyphicon glyphicon-star-empty"></span>
        </div>
      <h5>Description</h5>
      <p>6XXXXX</p>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.2/masonry.pkgd.js"></script>
<script type='text/javascript'>
var container = document.querySelector('.recipe-index');
var msnry = new Masonry( container, {
   itemSelector: '.each-recipe'
});          

</script>
<script src="/web/js/subscribe.js?t=<?=time();?>"></script>
<div class="container-fluid" style='width:80%'>
