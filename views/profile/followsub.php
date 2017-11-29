<?php

/* @var $this yii\web\View */

$this->title = 'Following and Subscription';
$this->params['breadcrumbs'][] = $this->title;
?>

 <div class="row">
    <div class="col-md-6">
  <h1>Following: XX</h1>
  <hr>
    <div class="row">
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
  </div>
  </div>
  <div class="col-md-6">
  <h1>Subscription: XX</h1>
  <hr>
  <div class="row">
    <div class="col-xs-12">
    <div class="hashtag">
        <div class="col-xs-4"><a href="#">#chicken</a></div>
        <div class="col-xs-4"><a href="#">#pork</a></div>
        <div class="col-xs-4"><a href="#">#beef</a></div>
        <div class="col-xs-4"><a href="#">#rice</a></div>
        
        <div class="col-xs-4"><a href="#">#chicken</a></div>
        <div class="col-xs-4"><a href="#">#pork</a></div>
        <div class="col-xs-4"><a href="#">#beef</a></div>
        <div class="col-xs-4"><a href="#">#rice</a></div>
        <div class="col-xs-4"><a href="#">#chicken</a></div>
        <div class="col-xs-4"><a href="#">#pork</a></div>
        <div class="col-xs-4"><a href="#">#beef</a></div>
        <div class="col-xs-4"><a href="#">#rice</a></div>

    <?php if ($numOfSub != 0): ?>
    <?php foreach($tagArray as $tagId => $tag): ?>
      <div class="col-xs-4">
        <a href="../index?tagId=<?= $tagId ?>"><span class="label label-default">#<?= $tag ?></span></a>
        </div>
    <?php endforeach;?>
    <?php endif; ?>
    
    </div>
  </div>
 </div>
 </div>
 </div>
 </div>
