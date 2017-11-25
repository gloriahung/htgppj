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
        if(isset($_GET['recipeId'])&& !empty($_GET['recipeId'])){
            $recipeId = htmlspecialchars($_GET['recipeId']);
        }

        // $comment = Comment::findBySql('SELECT*FROM comment')->where(['recipeId'=>$recipeId])->all();
        $comment = Comment::findBySql('SELECT * FROM comment WHERE recipeId = '.$recipeId)->all();
		$recipe = Recipe::findBySql('SELECT* FROM recipe WHERE recipeId= '.$recipeId)->one();
		$recipeUser = User::findBySql('SELECT* FROM user WHERE id = '.$recipe->userId)->one();
		// $commentUser = User::findBySql('SELECT*FROM user')->where(['id'=>$comment->userId])->all();
		$tagIdArray = explode(",", $recipe->tagIds);

		foreach($tagIdArray as $tagId) {
			$tag = Tag::findBySql('SELECT* FROM tag WHERE tagId ='.$tagId)->one();
			$recipeTagArray[$tagId] = $tag->tag;
		}

        foreach($comment as $value) {
            $user = User::findBySql('SELECT* FROM user WHERE id ='.$value->userId)->one();
            $commentUserArray[$value->userId]['username'] = $user->username;
            $commentUserArray[$value->userId]['userIcon'] = $user->userIcon;
        }


		// var_dump($comment);
		
        return $this->render('index', [
            'comment' => $comment,
            'recipe' => $recipe,
			'recipeUser' => $recipeUser,
			'recipeTagArray' => $recipeTagArray,
            'commentUserArray' => $commentUserArray,
        ]);
    }
    
    public function actionPostform()
    {
        $model = new RecipeForm();
        if ($model->load(Yii::$app->request->post())) {

            // get the instance of the image
            $image = UploadedFile::getInstance($model, 'recipePhoto');
            $model->recipePhoto = $image->baseName.'.'.$image->extension;

            if($model->save()){
                $image->saveAs('/var/www/html/project.julab.hk/dev2/web/img/recipeImg/'.$model->recipePhoto);
                Yii::$app->session->setFlash('postFormSubmitted');
                return $this->refresh();
            }
            
        }
        return $this->render('postform', [
            'model' => $model,
        ]);
    }



    
}