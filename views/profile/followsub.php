<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = 'Following and Subscription';
$this->params['breadcrumbs'][] = $this->title;
?>

 <div class="row">
    <div class="col-md-6">
  <h1>Following: <?= $numOfFol ?></h1>
  <hr>

    <div class="col-xs-12">
    <div class="user">
     <?php if ($numOfFol != 0): ?>
      <?php foreach($followingArray as $id => $following): ?>
        <div class="col-xs-4">
        <img src="../img/userIcon/<?= $userIcon[$id] ?>" alt="<?= $username[$id] ?>" title="<?= $username[$id] ?>">
        <a href="index?userId=<?= $id ?>">
          <?= $username[$id] ?></a>
          </div>
        <?php endforeach;?>
        <?php endif; ?>
        </div>
    </div>
    </div>

  <div class="col-md-6">
  <h1>Subscription: <?= $numOfSub ?></h1>
  <hr>

    <div class="col-xs-12">
    <div class="hashtag">

    <?php if ($numOfSub != 0): ?>
    <?php foreach($tagArray as $tagId => $tag): ?>
      <div class="col-xs-4">
        <div class="row hashtagRow">
          <?php 
            echo file_get_contents('http://'.$_SERVER['HTTP_HOST'].'/web/site/getsubscriblebtn?userId='.Yii::$app->user->identity->id.'&tagIds='.$tagId);    
          ?>
        </div>
<!--         <a href="../index?tagId=<?= $tagId ?>"><span class="label label-default">#<?= $tag ?></span></a> -->
        </div>
    <?php endforeach;?>
    <?php endif; ?>
    
    </div>
  </div>
 </div>
</div>