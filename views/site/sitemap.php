<?php 
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ForgetPasswordForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
$this->title = 'Sitemap';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-sitemap col-md-10 col-md-offset-1 panel contentPanel">
    <h1><?= Html::encode($this->title) ?></h1>

    

    <div class="col-md-12">
    	
    		<div class="col-md-12">
    			<h2>Site</h2>
    			<button class="btn1 btn-success" type="button" onclick="location.href='/web/'" >Home</button>
	    		<button type="button" id="searchBtn" class="btn1 btn-success" data-toggle="modal" data-target="#myModal">Search <i class="fa fa-search" aria-hidden="true"></i></button>
	    		<button class="btn1 btn-success" type="button" onclick="location.href='/web/site/faq'" >FAQ</button>
	        	<button class="btn1 btn-success" type="button" onclick="location.href='/web/site/aboutus'" >About Us</button>
	        	<button class="btn1 btn-success" type="button" onclick="location.href='/web/site/contactus'" >Contact Us</button>
	        	<button class="btn1 btn-success" type="button" onclick="location.href='/web/site/sitemap'" >Sitemap</button>
	        	<button class="btn1 btn-success" type="button" onclick="location.href='/web/site/terms'" >Terms and Conditions</button>
	        	<button class="btn1 btn-success" type="button" onclick="location.href='/web/site/privacy'" >Privacy Policy</button>
    	<?php if(Yii::$app->user->isGuest): ?>
            <button class="btn1 btn-success" type="button" onclick="location.href='/web/site/signup'">Sign up</button>
            <button class="btn1 btn-success" type="button" onclick="location.href='/web/site/login'">Login</button>
            </div>
		<?php else: ?>
			</div>

			<div class="col-md-6">
				<h2>Profile</h2>
				<button class="btn1 btn-success" type="button" onclick="location.href='/web/profile/index'" >View My Profile</button>
	            <button class="btn1 btn-success" type="button" onclick="location.href='/web/profile/edit'" >Edit Profile</button>
	            <button class="btn1 btn-success" type="button" onclick="location.href='/web/profile/changepw'" >Change password</button>
	            <button class="btn1 btn-success" type="button" onclick="location.href='/web/profile/subscription'" >Subscribed tag</button>
	            <button class="btn1 btn-success" type="button" onclick="location.href='/web/profile/following'" >Following</button>
            </div>

            <div class="col-md-6">
				<h2>Recipe</h2>
	            <button class="btn1 btn-success" type="button" onclick="location.href='/web/recipe/postform'" >Post recipe</button>
	            <button class="btn1 btn-success disabled" type="button" disabled>Edit recipe</button>
            </div>

            <?php if(Yii::$app->user->identity->role=="admin"): ?>
            	<div class="col-md-12">
            		<h2>Admin</h2>
	            	<button class="adminBtn btn1 btn-success" type="button" onclick="location.href='/web/admin/index'" >Report List
	        </button>
	            	<button class="adminBtn btn1 btn-success" type="button" onclick="location.href='/web/admin/resolved'" >Resolved Report List</button>
	            </div>
        	<?php endif ?>
        	
		<?php endif; ?>

    </div>

        

 
</div>