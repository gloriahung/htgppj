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
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
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

        return $this->render('index', [
            'tag' => $recipesTagArray,
            'userInfo' => $userInfo,
            'recipes' => $recipes,
            'numOfPost'=>$numOfPost,
            'numOfSub'=>$numOfSub,
            'numOfFol'=>$numOfFol
        ]);
    }


    public function actionFollowsub(){
         if(isset($_GET['userId'])&& !empty($_GET['userId'])){
            $userId = htmlspecialchars($_GET['userId']);
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


		$tagIdArray = explode(",", $userInfo->subscribeTagId);
        $numOfSub = 0;
            foreach ($tagIdArray as $tagId) {
                $tag = Tag::findBySql('SELECT tag FROM tag WHERE tagId = '.$tagId)->one();
                $tagArray[$tagId] = $tag->tag;
                $numOfSub++;
            }

        return $this->render('followsub',['userIcon'=>$userIcon, 'username'=>$username, 'followingArray'=>$followingArray, 'tagArray'=>$tagArray, 'numOfSub'=>$numOfSub, 'numOfFol'=>$numOfFol]);
    }

    public function actionFollowing(){

        if(isset($_GET['userId'])&& !empty($_GET['userId'])){
            $userId = htmlspecialchars($_GET['userId']);
        }


        $userInfo = User::findBySql('SELECT * FROM user WHERE id ='.$userId)->one();

        $numOfFol = 0;
;
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

        return $this->render('following',[
        'user' => $recipesUserArray,
        'tag' => $recipesTagArray,
        'recipes' => $recipes,
        'numOfFol'=>$numOfFol   
        ]);
    }

    public function actionSubscription(){
        if(isset($_GET['userId'])&& !empty($_GET['userId'])){
            $userId = htmlspecialchars($_GET['userId']);
        }
        

        $userInfo = User::findBySql('SELECT * FROM user WHERE id ='.$userId)->one();

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

        return $this->render('subscription',[
        'user' => $recipesUserArray,
        'tag' => $recipesTagArray,
        'recipes' => $recipes,
        'numOfSub'=>$numOfSub  
        ]);
    }
    
}

    

    

