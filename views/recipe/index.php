<?php

/* @var $this yii\web\View */

$this->title = '[Recipe Title] - [Author] - BornToCook';
?>

<div class="container-fluid" style='width:80%'>
  <h1>[Recipe Title]</h1>
  
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="recipe-photo">
                <img src="http://placehold.it/200x200" alt="[Recipe Title]" title="[Recipe Title]">
            </div>
        
            <div class="rating">
                <span class="glyphicon glyphicon-star-empty"></span>
                <span class="glyphicon glyphicon-star-empty"></span>
                <span class="glyphicon glyphicon-star-empty"></span>
                <span class="glyphicon glyphicon-star-empty"></span>
                <span class="glyphicon glyphicon-star-empty"></span>
<<<<<<< HEAD
                ([no of ppl rated])
=======
                (12) 
>>>>>>> 2533fd7fc964c6381c3247d47583362610ed39a3
                <a href ="#rate">Rate it</a>
            </div>
            
            <div class="Author">
                <img src="http://placehold.it/36x36" alt="[AuthorName]" title="[AuthorName]">
                By <a href="[link of author profile]">[authorname]</a>
            </div>
            
            <div class="button">
                <button type="button" class="btn btn-info">Follow Author</button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#reportform">Report Post</button>
            </div>
            
            <div id="reportform" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h2 class="modal-title">Report Form</h2>
                      </div>
                      
                    <div class="modal-body">
                        <p>Tell us your concern about this content so that we can review it to determine whether there has been a violation of terms of service. (Abuse of this feature is violation of terms of services.)</p>
                        <hr>
                        <form action="/action_page.php">
                            <div class="form-group">
                                <label for="reportuser">Report User</label>
                                <input type="input" class="form-control" id="reportuser" value="[AuthorName]" name="reportuser">
                            </div>
                            <div class="form-group">
                                <label for="reportrecipe">Report Recipe</label>
                                <input type="input" class="form-control" id="reportrecipe" value="[RecipeTitle]" name="reportrecipe">
                            </div>
                        
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea rows="6" class="form-control" id="description" placeholder="Describe the problem or idea." name="description"></textarea>
                            </div>
                        </form>
                    </div>
                      
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default">summit</button>
                      </div>
                    </div>
                </div>
            </div>
            
            
            
        </div>
    
    
    
        <div class="col-xs-0 col-sm-0 col-md-8 col-lg-8">
            <div class="hashtag">
                    <span class="label label-warning">chicken</span>
                    <span class="label label-warning">pork</span>
                    <span class="label label-warning">beef</span>
                    <span class="label label-warning">rice</span>
                
            </div>
            
            <div class="description">
                <h2>Description</h2>
                <p style='word-wrap: break-word'>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</p>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="ingredient">
                        <h2>Ingredient</h2>
                        <ul type="bullet">
                            <li>chicken</li>
                            <li>pork</li>
                            <li>beef</li>
                            <li>rice</li>
                        </ul>
                    </div>
                </div>  
                <div class="col-xs-0 col-sm-8 col-md-8 col-lg-8">
                    <div class="direction">
                        <h2>Directions</h2>
                        <ol type="number" style='word-wrap: break-word'>
                            <li>AAAAAA</li>
                            <li>BBBBBBBBBBB</li>
                            <li>CCCCCCCCCCCCCCC</li>
                            <li>DDDDDDDDDDDDDDDDDDDDDD</li>
                            <li>EEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE</a></li>
                        </ol>
                    </div>      
                </div>
            </div>  
        </div>
    </div>
    <hr>
    
    <div class="comment">
        <h2>Comments &amp; Rating</h2>
        
        <div class="media-left">
            <img src="http://placehold.it/36x36" alt="[commenterName]" title="[commenterName]">
        </div>
        
        <div class="media-body">
            <a href="[link of commenter profile]">[commentername]</a>
            <div class="rating">
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star-empty"></span>
                <span class="glyphicon glyphicon-star-empty"></span>
            </div>
            [comment by commenter]
        </div>
        
        <hr>
        
        <div class="media-left">
            <img src="http://placehold.it/36x36" alt="[commenterName]" title="[commenterName]">
        </div>
        
        <div class="media-body">
            <a href="[link of commenter profile]">[commentername]</a>
            <div class="rating">
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star-empty"></span>
                <span class="glyphicon glyphicon-star-empty"></span>
            </div>
            [comment by commenter]
        </div>
    </div>
    
    <hr>
    
    <div class="writecomment" id="rate">
        <h2>What's your rating?</h2>
            <div class="media-left">
                <img src="http://placehold.it/36x36" alt="[commenterName]" title="[commenterName]">
            </div>
            <div class="media-body">
                <div class="rate">
                    <span class="glyphicon glyphicon-star-empty"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                </div>
                <textarea rows="3" class="form-control" id="commentbox" placeholder="Write Your comment." name="commentbox"></textarea>
            </div>
        <button type="button" class="btn btn-default pull-right">Post</button>
    </div>
  
</div>