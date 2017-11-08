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
    
    <?php foreach($followingArray as $id => $following): ?>
        <div class="col-xs-4">
        <img src="../img/userIcon/<?= $userIcon[$id] ?>" alt="<?= $username[$id] ?>" title="<?= $username[$id] ?>">
        <a href="index?userId=<?= $id ?>">
          <?= $username[$id] ?></a>
          </div>
        <?php endforeach;?>

        </div>
    </div>
    </div>

  <div class="col-md-6">
  <h1>Subscription: <?= $numOfSub ?></h1>
  <hr>

    <div class="col-xs-12">
    <div class="hashtag">


    <?php foreach($tagArray as $tagId => $tag): ?>
      <div class="col-xs-4">
        <a href="../index?tagId=<?= $tagId ?>"><span class="label label-default">#<?= $tag ?></span></a>
        </div>
    <?php endforeach;?>

    
    </div>
  </div>
 </div>
</div>