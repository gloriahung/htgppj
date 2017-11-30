<?php
namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Comment;
use app\models\User;
use app\models\Recipe;
use app\models\Tag;
use app\models\RecipeForm;
use app\models\ReportForm;
use app\models\CommentForm;
use app\models\EditRecipeForm;
use yii\web\UploadedFile;


class RecipeController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return  [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['postform'],
                'rules' => [
                    [
                        'actions' => ['postform'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'comment' => ['post'],
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
        if(isset($_GET['recipeId'])&& !empty($_GET['recipeId'])){
            $recipeId = htmlspecialchars($_GET['recipeId']);
        }else{
            throw new \yii\web\HttpException(404, 'The requested Item could not be found.');
        }

        $model1 = new ReportForm();
        if ($model1->load(Yii::$app->request->post())&&$model1->save()) {
                Yii::$app->session->setFlash('reportFormSubmitted');
                return $this->refresh(); 
        }
        
        $model2 = new CommentForm();
        if ($model2->load(Yii::$app->request->post())&&$model2->save()) {
                Yii::$app->session->setFlash('commentFormSubmitted');
                return $this->refresh();
        }

        // $comment = Comment::findBySql('SELECT*FROM comment')->where(['recipeId'=>$recipeId])->all();
        $comment = Comment::findBySql('SELECT * FROM comment WHERE recipeId = '.$recipeId)->all();
        $recipe = Recipe::findBySql('SELECT* FROM recipe WHERE recipeId= '.$recipeId)->one();
        $recipeUser = User::findBySql('SELECT* FROM user WHERE id = '.$recipe->userId)->one();
        // $commentUser = User::findBySql('SELECT*FROM user')->where(['id'=>$comment->userId])->all();
        $tagIdArray = explode(",", $recipe->tagIds);


        //$followed = 0;


        if(isset(Yii::$app->user->identity->id)){
            $id = Yii::$app->user->identity->id;
            $myInfo = User::findBySql('SELECT* FROM user WHERE id = '.$id)->one();


            // $followingUsinguserIdArray = explode(",", $myInfo->followingUserId);
            // $followed = 0;

            // foreach($followingUsinguserIdArray as $followingUsinguser){
            //     if($followingUsinguser == $recipeUser->id){
            //         $followed = 1;
            //     }
            // }

            // if($myInfo->followingUserId != null || $myInfo->followingUserId != ""){
            //     $addfollowingUserId = $myInfo->followingUserId .",".$recipeUser->id;
            // }else{
            //     $addfollowingUserId = $recipeUser->id;
            // }

            // $deletedfollowing = array();
        
            // foreach ($followingUsinguserIdArray as $followingUsinguserB) {
            //         if($followingUsinguserB == $recipeUser->id){
            //             continue;
            //         }
            //         else{
            //             $deletedfollowing[]=$followingUsinguserB;
            //         }
            // }
            
            // $newfollowing = implode(",",$deletedfollowing);

        }else{
            $myInfo = '';
        }
        

        if(isset($_GET['userId'])&& !empty($_GET['userId'])){
            $userId = htmlspecialchars($_GET['userId']);

        }
        

        

        foreach($tagIdArray as $tagId) {
            $tag = Tag::findBySql('SELECT* FROM tag WHERE tagId ='.$tagId)->one();
            $recipeTagArray[$tagId] = $tag->tag;
        }

        foreach($comment as $value) {
            $user = User::findBySql('SELECT* FROM user WHERE id ='.$value->userId)->one();
            $commentUserArray[$value->userId]['username'] = $user->username;
            $commentUserArray[$value->userId]['userIcon'] = $user->userIcon;
        }

        if(empty($comment)){
            $commentUserArray = 0;
        }



        


        // var_dump($comment);
        return $this->render('index', [
            'comment' => $comment,
            'recipe' => $recipe,
            'recipeId' => $recipeId,
            'recipeUser' => $recipeUser,
            'recipeTagArray' => $recipeTagArray,
            'commentUserArray' => $commentUserArray,
            'model1' => $model1,
            'model2' => $model2,
            'myInfo' => $myInfo,
            //'followed'=>$followed,
        ]);

        
    }
    




    public function actionPostform()
    {
        $model = new RecipeForm();
        //$recipeId = ;


        if ($model->load(Yii::$app->request->post())) {

            // get the instance of the image
            $image = UploadedFile::getInstance($model, 'recipePhoto');
            //$image->baseName = $recipeId;
            $model->recipePhoto = $image->baseName.'.'.$image->extension;
            //$model->recipePhoto = $recipeId.'.'.$image->extension;

            if($model->save()){
                $image->saveAs('/var/www/html/project.julab.hk/web/img/recipeImg/'.$model->recipePhoto);
                Yii::$app->session->setFlash('postFormSubmitted');
                return $this->refresh();
            }
            
        }
        return $this->render('postform', [
            'model' => $model,
        ]);
    }


    public function actionEditrecipe()
    {
        $model = new EditRecipeForm();
        $id = Yii::$app->user->identity->id;

        if(isset($_GET['recipeId'])&& !empty($_GET['recipeId'])){
            $recipeId = htmlspecialchars($_GET['recipeId']);
        }else{
            throw new \yii\web\HttpException(404, 'The requested Item could not be found.');
        }

        $recipe = Recipe::findBySql('SELECT* FROM recipe WHERE recipeId = '.$recipeId)->one();

        if(!isset($recipe)){
            throw new \yii\web\HttpException(404, 'The requested Item could not be found.');
        }

        $tagIdArray = explode(",", $recipe->tagIds);
        foreach($tagIdArray as $tagId) {
            $tag = Tag::findBySql('SELECT* FROM tag WHERE tagId ='.$tagId)->one();
            $recipeTagArray[$tagId] = $tag->tag;
        }
        $tagNames =implode(",", $recipeTagArray);

        if ($model->load(Yii::$app->request->post())) {
            if(isset($model->recipePhoto)){
                $image = UploadedFile::getInstance($model, 'recipePhoto');
                if(!empty($image->extension)&&!empty($image->baseName)){
                    $model->recipePhoto = $recipeId.'.'.$image->extension;
                }
            }

            if ($model->edit()) { 
                if(isset($image)){
                    $image->saveAs('/var/www/html/project.julab.hk/web/img/recipeImg/'.$model->recipePhoto);
                    Yii::$app->db->createCommand()->update('recipe', ['imageLink' => $model->recipePhoto], 'recipeId = '.$recipeId)->execute();
                        // file is uploaded successfully
                }
                Yii::$app->session->setFlash('editRecipeFormSubmitted');
                return $this->refresh();
            }

            if($model->save()){
                
            }
        }    


        return $this->render('editrecipe', [
            'model' => $model,
            'recipe' => $recipe,
            'id' => $id,
            'recipeId' => $recipeId,
            'tagNames' => $tagNames
        ]);
    }



    // public function actionFollow(){
    //         if(isset($_GET['userid'])&& !empty($_GET['userid'])){
    //         $userId = htmlspecialchars($_GET['userid']);
    //     }
    //         if(isset($_GET['usinguserid'])&& !empty($_GET['usinguserid'])){
    //         $usinguserId = htmlspecialchars($_GET['usinguserid']);
    //     }


    //     $usinguser = User::findBySql('SELECT * FROM user WHERE id ='.$usinguserId)->one();

    //     $followingUsinguserIdArray = explode(",", $usinguser->followingUserId);

        
    //     if(in_array($userId, $followingUsinguserIdArray)){
    //         $followed = 1;

    //         if (($deleted = array_search($userId, $followingUsinguserIdArray)) !== false) {
    //             unset($followingUsinguserIdArray[$deleted]);
    //         }

    //         $newfollowing = implode(",",$followingUsinguserIdArray);

    //         $updatefollowing =Yii::$app->db->createCommand()->update('user' , ['followingUserId' => $newfollowing],'id = "'.$usinguserId.'"')->execute();
    //     }
    //     else{
    //         if(!(in_array($userId, $followingUsinguserIdArray))){
    //             $followed = 0;

    //             if($usinguser->followingUserId != null || $usinguser->followingUserId != ""){
    //                 $addfollowingUserId = $usinguser->followingUserId .",".$userId;
    //                 }else{
    //                 $addfollowingUserId = $userId;
    //                 }

    //             $updatefollowing =Yii::$app->db->createCommand()->update('user' , ['followingUserId' => $addfollowingUserId],'id = "'.$usinguserId.'"')->execute();   
    //         }

    //     } 

    //     echo $followed;
    // }



    /*public function actionComment()
    
        if(isset($_POST['rating'])&& !empty($_POST['rating'])){
            $rating = $_POST['rating'];
            
       }
        if(isset($_POST['commentbox'])&& !empty($_POST['commentbox'])){
            $comment = $_POST['commentbox'];
            
        }
        if(isset($_POST['recipeId'])&& !empty($_POST['recipeId'])){
            $recipeId = $_POST['recipeId'];
            
        }
        if(isset($_POST['userId'])&& !empty($_POST['userId'])){
            $userId = $_POST['userId'];
            
        }
        Yii::$app->db->createCommand()->insert('comment' ,[
            'rating' => $rating,
            'comment' => $comment,
            'recipeId' => $recipeId,
            'userId' => $userId 
        ])->execute();   
        
        echo 'hello';
        
        return true;
        
    }*/

    
}