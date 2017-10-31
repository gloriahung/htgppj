<?php

/* @var $this \yii\web\View */
/* @var $content string */


use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'BornToCOOK',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            
            // ['label' => 'Home', 'url' => ['/site/index']],
            [
            'label' => 'Sign up',
            'url' => ['/site/signup'],
            'visible' => Yii::$app->user->isGuest
            ],

            // ['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                //['label' => 'Sign Up', 'url' => ['/site/signup']]
                ['label' => 'Login', 'url' => ['/site/login']]
            

            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            ),

           
            Yii::$app->user->isGuest ? (
                //['label' => 'Sign Up', 'url' => ['/site/signup']]
               [ 'label'=> 'action', 'dropdown'=>[
                        'items'=> [
                                ['label'=> 'DropdownA','url'=>'/'],
                                ['label'=>'DropdownB','url'=>'#'],
                            ],
                        ],
                    ]

            

            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )

            
            
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class ="row">
            <div class="col-md-1 col-xs-2" > <a href ='http://project.julab.hk/dev1/web/site/aboutus'>About Us</a></div>
            <div class="col-md-1 col-xs-2" style='white-space:nowrap;'>  <a href ='http://project.julab.hk/dev1/web/site/contact'>Contact Us</a></div>
            <div class="col-md-1 col-xs-2"> <a href ='http://project.julab.hk/dev1/web/site/sitemap'>Sitemap</a></div>
            <div class="col-md-2 col-xs-3"> <a href ='http://project.julab.hk/dev1/web/site/terms'>Terms and Conditions</a></div>
            <div class="col-md-2 col-xs-2"> <a href ='http://project.julab.hk/dev1/web/site/privacy'>Privacy Policy</a></div>
            <div class="col-md-4 col-xs-5">&copy; <?= date('Y') ?> BornToCOOK All right reserved</div>
            <div class="pull-right">By Infinite</div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.2/masonry.pkgd.js"></script>
<script type='text/javascript'>
var container = document.querySelector('.recipe-index');
var msnry = new Masonry( container, {
   itemSelector: '.each-recipe'
});          
</script>
