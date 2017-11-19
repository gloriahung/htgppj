<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\LinkPager;
$this->title = 'Homepage';
?>
<div class="site-index">

    <div class="body-content">


        <?php if (Yii::$app->session->hasFlash('isSearch')):

           echo '<div class="row hashtagRow">';
            // echo file_get_contents('http://'.$_SERVER['HTTP_HOST'].'/web/site/getsubscriblebtn?userId=2&tagIds=1,2');
            echo file_get_contents('http://'.$_SERVER['HTTP_HOST'].'/web/site/getsubscriblebtn?userId='.Yii::$app->user->identity->id.'&tagIds='.$displayTagId);
            // include Html::encode($_SERVER['HTTP_HOST'].'/web/site/getsubscriblebtn?userId=2&tagIds=1,2');
            echo '</div>';

         endif; ?>


        <div id="masonry-rows">
            <div class="row recipe-index">
            <?php foreach ($recipes as $recipe): 
                if($recipe->numOfRate!=0)
                $avgRating = $recipe->rating / $recipe->numOfRate;
                else
                $avgRating = 0;

            
            ?>


                <div class="col-sm-6 col-md-4 each-recipe">
                    <a href="/web/recipe/index?recipeId=<?= $recipe->recipeId ?>">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <img src="/web/img/recipeImg/<?= $recipe->imageLink ?>" class="_2di5p" alt="recipe image" title="recipe image">
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
                                    By <a href="/web/profile/index?userId=<?= $recipe->userId ?>"> <?= $user[$recipe->recipeId] ?> </a>
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
    <?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.2/masonry.pkgd.js"></script>
<script type='text/javascript'>
var container = document.querySelector('.recipe-index');
var msnry = new Masonry( container, {
   itemSelector: '.each-recipe'
});          

</script>
<script src="/web/js/subscribe.js?t=<?=time();?>"></script>