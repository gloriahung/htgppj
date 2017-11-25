<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\LinkPager;
$this->title = 'Homepage';
?>
<link href="/web/css/admin.css?<?=time()?>" rel="stylesheet"> 
<div class="site-index">

    <div class="body-content">

        hello <?=\Yii::$app->user->identity->role;?>

    </div>
</div>
