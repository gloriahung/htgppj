<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use app\models\Recipe;
use app\models\User;
use app\models\Tag;
use app\models\ChangePwForm;
use app\models\EditForm;
use yii\web\UploadedFile;

class ProfileController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return  [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['following','followsub','subscription','edit','changepw'],
                'rules' => [
                    [
                        'actions' => ['following','followsub','subscription','edit','changepw'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(isset($_GET['userId'])&& !empty($_GET['userId'])){
            $userId = htmlspecialchars($_GET['userId']);
        }
        else{
            throw new \yii\web\HttpException(404, 'The requested Item could not be found.');
        }

        $userInfo = User::findBySql('SELECT * FROM user WHERE id ='.$userId)->one();

        $numOfPost = 0;
        // $postedRecipeIdArray = explode(",", $userInfo->postedRecipeId);
        // foreach ($postedRecipeIdArray as $postedRecipeId) {
        //         $postedInfo = User::findBySql('SELECT postedRecipeId FROM user ')->where(['id'=>$postedRecipeId])->one();
        //         $postedIdArray[$postedRecipeId] = $postedInfo->postedRecipeId;
        //         $numOfPost += 1;
        //     }

        // $recipes = Recipe::findBySql('SELECT * FROM recipe')->where('recipeId'==$postedIdArray)->all();
        // $recipes = Recipe::findBySql('SELECT * FROM recipe')->where(['userId'=>$userInfo->id])->all();
        $recipes = Recipe::findBySql('SELECT * FROM recipe WHERE userId ='.$userInfo->id)->all();

        // get tag name used for each recipe
        $recipesTagArray = array();
        foreach ($recipes as $key => $recipe) {
            $tagIdArray = explode(",", $recipe->tagIds);
            foreach ($tagIdArray as $tagId) {
                $tag = Tag::findBySql('SELECT tag FROM tag WHERE tagId = '.$tagId)->one();
                $recipesTagArray[$recipe->recipeId][$tagId] = $tag->tag;
            }
            $numOfPost++;
        }

       
        $numOfFol = 0;
        $followingUserIdArray = explode(",", $userInfo->followingUserId);
        foreach ($followingUserIdArray as $followingId) {
                $numOfFol += 1;
            }
        $tagIdArray = explode(",", $userInfo->subscribeTagId);
        $numOfSub = 0;
            foreach ($tagIdArray as $tagId) {
                $numOfSub += 1;
            }

        if ($userInfo->followingUserId == null ){
            $numOfFol = 0;
        } 
        if($userInfo->subscribeTagId == null){
            $numOfSub = 0;
        }


        $followed = 3;

        $usinguserId = null;

        if(isset(Yii::$app->user->identity->id)){
            $usinguserId = Yii::$app->user->identity->id;
            $usinguser = User::findBySql('SELECT * FROM user WHERE id ='.$usinguserId)->one();
        

        $followingUsinguserIdArray = explode(",", $usinguser->followingUserId);


        $followed = 0;

        foreach($followingUsinguserIdArray as $followingUsinguser){
            if($followingUsinguser == $userInfo->id){
                $followed = 1;
            }
                
        }
        if($userInfo->id == $usinguserId){
                    $followed = 2;
                }

         if($usinguser->followingUserId != null || $usinguser->followingUserId != ""){
            $addfollowingUserId = $usinguser->followingUserId .",".$userInfo->id;
         }else{
             $addfollowingUserId = $userInfo->id;
         }

        $deletedfollowing = array();
        
        foreach ($followingUsinguserIdArray as $followingUsinguserB) {
                if($followingUsinguserB == $userInfo->id){
                    continue;
                }
                else{
                    $deletedfollowing[]=$followingUsinguserB;
                }
            }
            
        $newfollowing = implode(",",$deletedfollowing);
        }

        // $delupdatefollowing = Yii::$app->db->createCommand()->update('user' , ['followingUserId' => $newfollowing],'id = "'.$usinguserId.'"')->execute();

        // $updatefollowing =Yii::$app->db->createCommand()->update('user' , ['followingUserId' => $addfollowingUserId],'id = "'.$usinguserId.'"')->execute();;     

    //     if($_GET['followed'] == "0")
    //     {
    //         // this has the value MSN89
    //         $sql = "UPDATE User
    //                 SET followingUser='$id'
    //                 WHERE User_Id=3";

    // //then execute the query


    //     }
    //     if($_GET['followed'] == "1")
    //     { 
    //         $sql = "Yii::$app->db->createCommand()->update('user' , ['followingUserId' => $newfollowing],'id = "'$usinguserId'"')->execute();";

    // //then execute the query

    //     }

        

        return $this->render('index', [
            'tag' => $recipesTagArray,
            'userInfo' => $userInfo,
            'recipes' => $recipes,
            'numOfPost'=>$numOfPost,
            'numOfSub'=>$numOfSub,
            'numOfFol'=>$numOfFol,
            'followed'=>$followed,
            // 'updatefollowing'=>$updatefollowing,
            // 'addfollowingUserId'=>$addfollowingUserId,
            'usinguserId'=>$usinguserId

        ]);
    }

    // /**
    //  * Displays homepage.
    //  *
    //  * @return string
    //  */
    // public function actionIndexedit()
    // {
    //     if(isset($_GET['userId'])&& !empty($_GET['userId'])){
    //         $userId = htmlspecialchars($_GET['userId']);
    //     }

    //     $userInfo = User::findBySql('SELECT * FROM user WHERE id ='.$userId)->one();

    //     $numOfPost = 0;
    //     // $postedRecipeIdArray = explode(",", $userInfo->postedRecipeId);
    //     // foreach ($postedRecipeIdArray as $postedRecipeId) {
    //     //         $postedInfo = User::findBySql('SELECT postedRecipeId FROM user ')->where(['id'=>$postedRecipeId])->one();
    //     //         $postedIdArray[$postedRecipeId] = $postedInfo->postedRecipeId;
    //     //         $numOfPost += 1;
    //     //     }

    //     // $recipes = Recipe::findBySql('SELECT * FROM recipe')->where('recipeId'==$postedIdArray)->all();
    //     // $recipes = Recipe::findBySql('SELECT * FROM recipe')->where(['userId'=>$userInfo->id])->all();
    //     $recipes = Recipe::findBySql('SELECT * FROM recipe WHERE userId ='.$userInfo->id)->all();

    //     // get tag name used for each recipe
    //     $recipesTagArray = array();
    //     foreach ($recipes as $key => $recipe) {
    //         $tagIdArray = explode(",", $recipe->tagIds);
    //         foreach ($tagIdArray as $tagId) {
    //             $tag = Tag::findBySql('SELECT tag FROM tag WHERE tagId = '.$tagId)->one();
    //             $recipesTagArray[$recipe->recipeId][$tagId] = $tag->tag;
    //         }
    //         $numOfPost++;
    //     }

       
    //     $numOfFol = 0;
    //     $followingUserIdArray = explode(",", $userInfo->followingUserId);
    //     foreach ($followingUserIdArray as $followingId) {
    //             $numOfFol += 1;
    //         }
    //     $tagIdArray = explode(",", $userInfo->subscribeTagId);
    //     $numOfSub = 0;
    //         foreach ($tagIdArray as $tagId) {
    //             $numOfSub += 1;
    //         }

    //     if ($userInfo->followingUserId == null ){
    //         $numOfFol = 0;
    //     } 
    //     if($userInfo->subscribeTagId == null){
    //         $numOfSub = 0;
    //     }


    //     return $this->render('indexedit', [
    //         'tag' => $recipesTagArray,
    //         'userInfo' => $userInfo,
    //         'recipes' => $recipes,
    //         'numOfPost'=>$numOfPost,
    //         'numOfSub'=>$numOfSub,
    //         'numOfFol'=>$numOfFol
    //     ]);
    // }


    public function actionFollowsub(){
         if(isset($_GET['userId'])&& !empty($_GET['userId'])){
            $userId = htmlspecialchars($_GET['userId']);
        }else{
            throw new \yii\web\HttpException(404, 'The requested Item could not be found.');
        }

        $userInfo = User::findBySql('SELECT * FROM user WHERE id ='.$userId)->one();

        $numOfFol = 0;

        $followingUserIdArray = explode(",", $userInfo->followingUserId);
        foreach ($followingUserIdArray as $followingId) {
                $followingInfo = User::findBySql('SELECT * FROM user where id = '.$followingId)->one();
                $followingArray[$followingId] = $followingInfo->followingUserId;

                $userIcon[$followingId] = $followingInfo->userIcon;

                $username[$followingId] = $followingInfo->username;

                $numOfFol++;
            }
        $numOfSub = 0;
        if ($userInfo->subscribeTagId!= null){
        $tagIdArray = explode(",", $userInfo->subscribeTagId);
            foreach ($tagIdArray as $tagId) {
                $tag = Tag::findBySql('SELECT tag FROM tag WHERE tagId ='.$tagId)->one();
                $tagArray[$tagId] = $tag->tag;
                $numOfSub++;
            }
        }
        if ($userInfo->followingUserId == null ){
            $numOfFol = 0;
            $followingArray[] = null; 
        } 
        if($userInfo->subscribeTagId == null){
            $numOfSub = 0;
            $tagArray[] = null;
        }

        return $this->render('followsub',['userIcon'=>$userIcon, 'username'=>$username, 'followingArray'=>$followingArray, 'tagArray'=>$tagArray, 'numOfSub'=>$numOfSub, 'numOfFol'=>$numOfFol]);
    }


    public function actionFollowing(){

        $id = Yii::$app->user->identity->id;
        
        $userInfo = User::findBySql('SELECT * FROM user WHERE id ='.$id)->one();

        

        $numOfFol = 0;

        $followingUserIdArray = explode(",", $userInfo->followingUserId);
        foreach ($followingUserIdArray as $followingId) {
                $numOfFol++;
            }

        $follow = implode(" OR userId = ",$followingUserIdArray);
        $recipes = Recipe::findBySql('SELECT * FROM recipe where userId = '.$follow)->orderBy('recipeId')->all();

        $recipesTagArray = array();
        foreach ($recipes as $key => $recipe) {
            $tagIdArray = explode(",", $recipe->tagIds);
            foreach ($tagIdArray as $tagId) {
                $tag = Tag::findBySql('SELECT tag FROM tag WHERE tagId = '.$tagId)->one();
                $recipesTagArray[$recipe->recipeId][$tagId] = $tag->tag;
            }
        }

        $recipesUserArray = array();
        foreach ($recipes as $key => $recipe) {
            $user = User::findBySql('SELECT username FROM user WHERE id = '.$recipe->userId)->one();
            $recipesUserArray[$recipe->recipeId] = $user->username;
        }

        if ($userInfo->followingUserId == null ){
            $numOfFol = 0;

        } 

        return $this->render('following',[
        'user' => $recipesUserArray,
        'tag' => $recipesTagArray,
        'recipes' => $recipes,
        'numOfFol'=> $numOfFol   
        ]);
    }

    public function actionSubscription(){
        $id = Yii::$app->user->identity->id;
        
        $userInfo = User::findBySql('SELECT * FROM user WHERE id ='.$id)->one();

        $numOfSub = 0;

        $whereArray = Array();

         $tagIdArray = explode(",", $userInfo->subscribeTagId);
        foreach ($tagIdArray as $includingTagId) {
            $whereArray[] = 'FIND_IN_SET("'.$includingTagId.'", tagIds) > 0';
            $numOfSub++;
        }
                

        $where = implode(" OR ",$whereArray);

        $query = Recipe::find();

        $recipes = $query
            ->where($where)
            ->orderBy('recipeId')
            ->all();


        // $tagIdArray = explode(",", $userInfo->subscribeTagId);
        // $numOfSub = 0;
        //     foreach ($tagIdArray as $tagId) {
        //         $tag = Tag::findBySql('SELECT tag FROM tag WHERE tagId = '.$tagId)->one();
        //         $tagArray[$tagId] = $tag->tag;
        //         $numOfSub++;
        //     }
        // $recipeInfo = Recipe::findBySql('SELECT * FROM recipe')->all();

        // $sub = implode(" OR tagIds = ",$tagIdArray);

        // $recipes = Recipe::findBySql('SELECT * FROM recipe where tagIds = '.$sub)->orderBy('recipeId')->all();

        $recipesTagArray = array();
        foreach ($recipes as $key => $recipe) {
            $tagIdArray = explode(",", $recipe->tagIds);
            foreach ($tagIdArray as $tagId) {
                $tag = Tag::findBySql('SELECT tag FROM tag WHERE tagId = '.$tagId)->one();
                $recipesTagArray[$recipe->recipeId][$tagId] = $tag->tag;
            }
        }

        $recipesUserArray = array();
        foreach ($recipes as $key => $recipe) {
            $user = User::findBySql('SELECT username FROM user WHERE id = '.$recipe->userId)->one();
            $recipesUserArray[$recipe->recipeId] = $user->username;
        }

         
        if($userInfo->subscribeTagId == null){
            $numOfSub = 0;
        }

        return $this->render('subscription',[
        'user' => $recipesUserArray,
        'tag' => $recipesTagArray,
        'recipes' => $recipes,
        'numOfSub'=>$numOfSub  
        ]);
    }
    
    public function actionChangepw(){
        if(isset($_GET['userId'])&& !empty($_GET['userId'])){
            $userId = htmlspecialchars($_GET['userId']);
        }
        
        $model = new ChangePwForm();
        if ($model->load(Yii::$app->request->post()) && $model->changepw()){
            Yii::$app->session->setFlash('changePwFormSubmitted');
            return $this->refresh();
        }
        return $this->render('changepw', [
            'model' => $model
        ]);
    }

     public function actionEdit(){
        $model = new EditForm();
        $id = Yii::$app->user->identity->id;
        $user = User::findBySql('SELECT * FROM user WHERE id ='.$id)->one();

        if ($model->load(Yii::$app->request->post())){
            if(isset($model->icon)){
                $icon = UploadedFile::getInstance($model, 'icon');
                if(!empty($icon->extension)&&!empty($icon->baseName)){
                    $model->icon = $id.'.'.$icon->extension;
                }
            }


                if ($model->edit()) { 
                    if(isset($icon)){
                        $icon->saveAs('/var/www/html/project.julab.hk/web/img/userIcon/'.$model->icon);
                        Yii::$app->db->createCommand()->update('user', ['userIcon' => $model->icon], 'id = "'.$id.'"')->execute();
                        // file is uploaded successfully
                    }
                }
            
            Yii::$app->session->setFlash('editFormSubmitted');
            return $this->refresh();
            
        }
        return $this->render('edit', [
            'model' => $model,
            'user' => $user
        ]);
    }

    public function actionFollow(){
            if(isset($_GET['userid'])&& !empty($_GET['userid'])){
            $userId = htmlspecialchars($_GET['userid']);
        }
            if(isset($_GET['usinguserid'])&& !empty($_GET['usinguserid'])){
            $usinguserId = htmlspecialchars($_GET['usinguserid']);
        }


        $usinguser = User::findBySql('SELECT * FROM user WHERE id ='.$usinguserId)->one();

        $followingUsinguserIdArray = explode(",", $usinguser->followingUserId);

        
        if(in_array($userId, $followingUsinguserIdArray)){
            $followed = 1;

            if (($deleted = array_search($userId, $followingUsinguserIdArray)) !== false) {
                unset($followingUsinguserIdArray[$deleted]);
            }

            $newfollowing = implode(",",$followingUsinguserIdArray);

            $updatefollowing =Yii::$app->db->createCommand()->update('user' , ['followingUserId' => $newfollowing],'id = "'.$usinguserId.'"')->execute();
        }
        else{
            if(!(in_array($userId, $followingUsinguserIdArray))){
                $followed = 0;

                if($usinguser->followingUserId != null || $usinguser->followingUserId != ""){
                    $addfollowingUserId = $usinguser->followingUserId .",".$userId;
                    }else{
                    $addfollowingUserId = $userId;
                    }

                $updatefollowing =Yii::$app->db->createCommand()->update('user' , ['followingUserId' => $addfollowingUserId],'id = "'.$usinguserId.'"')->execute();   
            }

        } 

        echo $followed;
    }



}

    

    

