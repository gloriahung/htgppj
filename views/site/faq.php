<?php 
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
$this->title = 'FAQ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-faq col-md-10 col-md-offset-1 panel contentPanel ">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
	    <div class="col-md-12" >
	    		 <h3>Q: How do I create an account?</h3>
	    	<img src="/web/img/site/faq1.png" class="img-responsive img-thumbnail center-block">
	    	<p>
					Click the ‘sign up’ button on the top right-hand corner
					<dl>
						<dt>Username limit</dt>
							<dd>Must be 4-20 words with number and/or characters</dd>

						<dt>Password limit</dt>
							<dd>Must be 6-20 words with number or characters</dd>
					</dl>
			</p>

			<h3>Q: How do I update my profile information?</h3>
			<img src="/web/img/site/faq2.png" class="img-responsive img-thumbnail center-block">
			<p>
				Click the ‘user profile’ button to the profile page, click the button to the edit profile page. In the edit profile page you can change your profile picture, introduction and username.
			</p>
			
			<p>
			<dl>
				<dt>Add or reset profile picture</dt>
				<img src="/web/img/site/faq3.png" class="img-responsive img-thumbnail center-block">
			
				<dd>Click the choose file button to upload photo</dd>
			
				 <dt>Change bio</dt>
				 <dd>Bio must not more than 100 characters</dd>
			
				<dt>Change username</dt>
				  <dd>Username must not more than 20 characters with numbers and/or characters</dd>
			

				 <dt>Change email</dt>
				 <dd>Email address cannot be changed after creating an account</dd>
			

				  <dt>Change password</dt>
				  <dd>Must be 6-20 words with numbers or characters</dd>
		  	</dl>
		  	</p>

			<h3>Q:  What should I do if I forgot my password?</h3>
		  	<p>
			
			  Click the forget password button
			  Type the email address of the account and press ‘retrieve password’ button. An email with new password will send to you if the email address is used for sign up
			 </p>

			<h3>Q: If I found an inappropriate recipe, how can I report it to admin?</h3>
			<p>
			
			On the page of the recipe you want to report, click the ‘report button’ and fill in the report form to report recipe.
			</p>

			<h3>Q: How can I comment on recipe? </h3>
			<p>
			Click on the recipe and scroll to the bottom.<br>
			Comment and rating can not be empty and the maximum length of comment is 500 characters.
			</p>

			<h3>Q: How to go back to home page?</h3>
			<p>
				
				Click the logo on the top left-hand corner of the website or click the menu button on the top right-hand corner, there will be a home button
			</p>


	    </div>
	</div>
        

   
</div>