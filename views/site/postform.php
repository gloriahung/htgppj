<?php

/* @var $this yii\web\View */

$this->title = 'Post a Recipe - BornToCook';
?>
<div class="container-fluid" style='width:80%'>
  <h1>Posting a new recipe</h1>
  
  <form action="/action_page.php">
    <div class="row">
    
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="add-photo">
                <label class="icon--picture gray">
                    <input type="file" name="PhotoUploadFile" id="photoUpload">
                </label>
                <span class="note_for_user">(no smaller than 960 X 960)</span>
            </div>
        
            <div class="form-group">
                <label for="title">Recipe Title</label>
                <input type="input" class="form-control" id="title" placeholder="Add a title for your recipe." name="title">
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea rows="5" class="form-control" id="description" placeholder="Write few words about your recipe." name="description"></textarea>
            </div>
        </div>
    
    
    
        <div class="col-xs-0 col-sm-8 col-md-8 col-lg-8">
            <div class="form-group">
                <label for="ingredient">Ingredients</label>
                <textarea rows="6" class="form-control" id="ingredient" placeholder="Put each ingredient on its own lines." name="ingredient"></textarea>
            </div>
            
            <div class="form-group">
                <label for="direction">Directions</label>
                <textarea rows="8" class="form-control" id="direction" placeholder="Put each step on its own lines." name="direction"></textarea>
            </div>
            
            <div class="form-group">
                <label for="hashtag">Hashtags</label>
                <input type="text" class="form-control" id="hashtag" placeholder="Press Enter to add a tag." name="hashtag" data-role="tagsinput">
            </div>
            
            <button type="button" class="btn btn-success btn-lg">Post</button>
            <button type="button" class="btn btn btn-lg">Cancel</button>
        </div>
        
    </div>
  </form>
  
  
</div>