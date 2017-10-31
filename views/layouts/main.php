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
    <link href="css/typeahead.css"  rel="stylesheet" />
    <link href="css/bootstrap-tagsinput.css" rel="stylesheet">
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <nav id="w0" class="navbar-fixed-top navbar" role="navigation">
        <div class="container">
            <div class="navbar-header navbar-left"><button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#w0-collapse" aria-expanded="false"><span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span></button><a class="navbar-brand" href="/dev1/web/">COOK</a>
            </div>

            <div class="dropdown">
                <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Search
                <span class="caret"></span></button>
                <div class="dropdown-menu panel panel-default">
                    <span class="dropdown-header">Search Including Tags</span>
                    <span>
                        <div class="bgcolor navbar-center" id="search-included">
                            <select type="text" value="" id="tags-input" data-role="tagsinput" multiple></select>
                        </div>
                    </span>
                    <span class="divider"></span>
                    <span class="dropdown-header">Search Excluding Tags</span>
                    <span>
                        <div class="bgcolor navbar-center" id="search-excluded">
                            <select type="text" value="" id="xtags-input" data-role="xtagsinput" multiple></select>
                        </div>
                    </span> 
                    <button class="btn btn-success" type="button" onclick="gotosearch()">Go</button>
                </div>
            </div>

            <!-- <div class="bgcolor navbar-center" id="search-included">
                <select type="text" value="" id="tags-input" data-role="tagsinput" multiple></select>
            </div> -->

            <?php if(Yii::$app->user->isGuest): ?>
            <div id="w0-collapse" class="collapse navbar-collapse navbar-right">
                <ul id="w1" class="navbar-nav navbar-right nav">
                    <li><a href="/dev1/web/site/signup">Sign up</a></li>
                    <li class="active"><a href="/dev1/web/site/login">Login</a></li>
                </ul>
            </div>
            <?php else: ?>
            <div id="w0-collapse" class="collapse navbar-collapse">
                <ul id="w1" class="navbar-nav navbar-right nav">
                    <li>
                        <?php echo
                        Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            'Logout (' . Yii::$app->user->identity->username . ')',
                            ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm()
                        ?>
                    </li>
                </ul>
            </div>
            <?php endif;?>
        </div>
     </nav>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; COOK <?= date('Y') ?></p>

        <p class="pull-right">By AAA</p>
    </div>
</footer>

<?php $this->endBody() ?>
<script src="/dev1/web/assets/7529bef6/js/bootstrap.js"></script>
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
    
<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/bootstrap3-typeahead.js"></script>
<script src="js/typeahead.bundle.js"></script>
<script>
    var tags = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      prefetch: {
        // url: 'data/countries.json',
        url: 'site/search/',
        filter: function(list) {
          return $.map(list, function(name) {
            return { name: name }; });
        }
      }
    });
    tags.initialize();

    $('#tags-input').tagsinput({
        maxTags: 3,
        freeInput: false,
        typeaheadjs: {
            name: 'tags',
            displayKey: 'name',
            valueKey: 'name',
            source: tags.ttAdapter()
        }
    });

    $('#xtags-input').tagsinput({
        maxTags: 3,
        freeInput: false,
        typeaheadjs: {
            name: 'tags',
            displayKey: 'name',
            valueKey: 'name',
            source: tags.ttAdapter()
        }
    });

    // jQuery('#tags-input').tagsinput({
    //     itemValue: 'value',
    //     itemText: 'text',
    //     typeahead: {
    //         displayKey: 'text',
    //         afterSelect: function(val) { this.$element.val(""); },
    //         source: function () {
    //             return jQuery.get("http://project.julab.hk/dev1/web/site/search");
    //         }
    //     }
    // });

    function gotosearch(){
        var includingTags = $("#tags-input").val();
        var excludingTags = $("#xtags-input").val();
        alert("Including: "+includingTags+"<br>"+"Excluding: "+excludingTags);
    }

</script>
