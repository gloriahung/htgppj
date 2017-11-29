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
    <link href="/web/css/typeahead.css"  rel="stylesheet" />
    <link href="/web/css/bootstrap-tagsinput.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <nav id="w0" class="navbar-fixed-top navbar" role="navigation">
        <div class="container">
            <div class="navbar-header navbar-left"><button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#w0-collapse" aria-expanded="false"><span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>

                <span class="icon-bar"></span></button><a class="navbar-brand" href="/web/">BornToCOOK</a>


                <!-- <div class="dropdown" id="search-dropdown" >
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
                </div> -->

                <!-- Trigger the modal with a button -->
                <button type="button" id="searchBtn" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Search <i class="fa fa-search" aria-hidden="true"></i></button>

                <!-- Modal -->
                <div id="myModal" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Search <i class="fa fa-search" aria-hidden="true"></i></h3>
                      </div>
                      <div class="modal-body">
                        <h4>Search Including Tags <i class="fa fa-plus-square" aria-hidden="true"></i></h4>
                        <span>
                            <div class="bgcolor navbar-center" id="search-included">
                                <select type="text" value="" id="tags-input" data-role="tagsinput" multiple></select>
                            </div>
                        </span>
                        <hr>
                        <h4>Search Excluding Tags <i class="fa fa-minus-square" aria-hidden="true"></i></h4>
                        <span>
                            <div class="bgcolor navbar-center" id="search-excluded">
                                <select type="text" value="" id="xtags-input" data-role="xtagsinput" multiple></select>
                            </div>
                        </span>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-success" type="button" onclick="gotosearch()">Start Searching</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>

                  </div>
                </div>

            </div>

            
            <!-- <div class="bgcolor navbar-center" id="search-included">
                <select type="text" value="" id="tags-input" data-role="tagsinput" multiple></select>
            </div> -->

            <?php if(Yii::$app->user->isGuest): ?>
            <div id="w0-collapse" class="collapse navbar-collapse navbar-right" >
                <ul id="w1" class="navbar-nav navbar-right nav">
                    <li><a href="/web/site/signup">Sign up</a></li>
                    <li class="active"><a href="/web/site/login">Login</a></li>
                    <li>
                        <div class="dropdown">
                        <button class="btn2 btn-success dropdown-toggle" type="button" data-toggle="dropdown" id="dropdown2"><i class="fa fa-bars" aria-hidden="true"></i><span class="caret"></span></button>
                        <div class="dropdown-menu panel " id="panel1">                                

<<<<<<< HEAD
                            <button class="btn1 btn-success" type="button" onclick="location.href='/web/'">Home</button>
=======
                            <button class="btn1 btn-success" type="button" onclick="location.href='h/web/'">Home</button>
>>>>>>> 2fcf9bbaf1fbcf7a0f96b1945046d86d52bba2f8

                            <button class="btn1 btn-success" type="button" onclick="location.href='/web/site/faq'" >FAQ</button>

                        </div>
                        </div>
                    </li>


                </ul>

                 <ul id="w2" class="navbar-nav navbar-right nav">
                <li>
                    <button class="btn1 btn-success" type="button" onclick="location.href='/web/site/signup'">Sign up</button>
                    <button class="btn1 btn-success" type="button" onclick="location.href='/web/site/login'">Login</button>
                    <button class="btn1 btn-success" type="button" onclick="location.href='/web/'">Home</button>
                    <button class="btn1 btn-success" type="button" onclick="location.href='/web/site/faq'">Q&A</button>
                </li>
              

                </ul>
               
            </div>
           <?php else: ?>
            <div id="w0-collapse" class="collapse navbar-collapse" style = "float:right">
                <ul id="w1" class="navbar-nav navbar-right nav">
                    <li>
                         <button class="btn1 btn-success" id="profilebutton" type="button" onclick="location.href='/web/profile/index?userId=<?=\Yii::$app->user->identity->id;?>'" >User profile</button>
                        
                    </li>
                    <li>
                        <div class="dropdown">
                        <button class="btn2 btn-success dropdown-toggle" type="button" data-toggle="dropdown"> <i class="fa fa-bars" aria-hidden="true"></i><span class="caret"></span></button>
                        <div class="dropdown-menu panel" id="panel1" >                                
                            <button class="btn1 btn-success" type="button" onclick="location.href='/web/'" >Home</button>
                           
                            <button class="btn1 btn-success" type="button" onclick="location.href='/web/profile/changepw'" >Change password</button>
                            <button class="btn1 btn-success" type="button" onclick="location.href='/web/profile/subscription'" >Subscribed tag</button>
                            <button class="btn1 btn-success" type="button" onclick="location.href='/web/profile/following'" >Following</button>
                            <button class="btn1 btn-success" type="button" onclick="location.href='/web/site/faq'" >FAQ</button>

                            <?php if(Yii::$app->user->identity->role=="admin"): ?>
                            <button class="adminBtn btn1 btn-success" type="button" onclick="location.href='/web/admin/index'" >Report List
                        </button>
                            <button class="adminBtn btn1 btn-success" type="button" onclick="location.href='/web/admin/resolved'" >Resolved Report List</button>
                        <?php endif ?>


                            <?php echo
                        Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            'Logout (' . Yii::$app->user->identity->username . ')',
                            ['class' => 'btn1 btn-success',
                                'id'=> 'logoutbutton']
                        )
                        . Html::endForm()
                        ?>

<<<<<<< HEAD
=======

>>>>>>> 2fcf9bbaf1fbcf7a0f96b1945046d86d52bba2f8

                        </div>
                        </div>
                    </li>
                </ul>

                <ul id="w2" class="navbar-nav navbar-right nav">
                    <li>
                         <?php echo
                        Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            'Logout (' . Yii::$app->user->identity->username . ')',
                            ['class' => 'btn1 btn-sucess',
                                'id'=> 'logoutbutton']
                        )
                        . Html::endForm()
                        ?>
                    </li>
                    <li>                             
                            <button class="btn1 btn-success" type="button" onclick="location.href='/web/'" >Home</button>  
                            <button class="btn1 btn-success" id="profilebutton" type="button" onclick="location.href='/web/profile/index?userId=<?=\Yii::$app->user->identity->id;?>'" >User profile</button>                         
                            <button class="btn1 btn-success" type="button" onclick="location.href='/web/profile/changepw'" >Change password</button>
                            <button class="btn1 btn-success" type="button" onclick="location.href='/web/profile/subscription'" >Subscribed tag</button>
                            <button class="btn1 btn-success" type="button" onclick="location.href='/web/profile/following'" >Following</button>
                            <button class="btn1 btn-success" type="button" onclick="location.href='/web/site/faq'" >FAQ</button>
                            <?php if(Yii::$app->user->identity->role=="admin"): ?>
                            <button class="adminBtn btn1 btn-success" type="button" onclick="location.href='/web/admin/index'" >Report List
                        </button>
                            <button class="adminBtn btn1 btn-success" type="button" onclick="location.href='/web/admin/resolved'" >Resolved Report List</button>
                        <?php endif ?>
                           
                        
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
        <div class ="row">

            <div class="col-md-1 col-xs-2" > <a href ='/web/site/aboutus'>About Us</a></div>
            <div class="col-md-1 col-xs-3" style='white-space:nowrap;'>  <a href ='/web/site/contactus'>Contact Us</a></div>
            <div class="col-md-1 col-xs-2"> <a href ='/web/site/sitemap'>Sitemap</a></div>
            <div class="col-md-2 col-xs-3"> <a href ='/web/site/terms'>Terms and Conditions</a></div>
            <div class="col-md-2 col-xs-2"> <a href ='/web/site/privacy'>Privacy Policy</a></div>

            <div class="col-md-4 col-xs-5">&copy; <?= date('Y') ?> BornToCOOK All right reserved</div>
            <div class="pull-right">By Infinite</div>
    </div>
</footer>

<?php $this->endBody() ?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
<?php $this->endPage() ?>


<!-- <script src="/web/js/subscribe.js"></script> -->
<!-- <script src="/web/js/jquery-1.11.2.min.js"></script> -->
<script src="/web/js/bootstrap3-typeahead.js"></script>
<script src="/web/js/typeahead.bundle.js"></script>
<script>
    var tags = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      prefetch: {
        // url: 'data/countries.json',
        url: '/web/site/search/',
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

    function gotosearch(){
        var includingTags = $("#tags-input").val();
        var excludingTags = $("#xtags-input").val();
        // alert("Including: "+includingTags+"<br>"+"Excluding: "+excludingTags);
        if(includingTags!=null && excludingTags!=null){
            window.location.replace("/web/site/?tag="+includingTags+"&xTag="+excludingTags);
        }else if(includingTags!=null){
            window.location.replace("/web/site/?tag="+includingTags);
        }else if(excludingTags!=null){
            window.location.replace("/web/site/?xTag="+excludingTags);
        }else{
            alert("Please enter tag to search.");
        }
        
    }

</script>
