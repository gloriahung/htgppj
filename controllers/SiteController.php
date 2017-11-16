<?php
namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\ForgetPasswordForm;
use yii\data\Pagination;
use app\models\Recipe;
use app\models\User;
use app\models\Tag;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
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

        if(isset($_GET['tag'])&& !empty($_GET['tag'])){
            $includingTags = htmlspecialchars($_GET['tag']);
        }
        if(isset($_GET['xTag'])&& !empty($_GET['xTag'])){
            $excludingTags = htmlspecialchars($_GET['xTag']);
        }
        if(isset($_GET['userId'])&& !empty($_GET['userId'])){
            $followingUsers = htmlspecialchars($_GET['userId']);
        }
        if(isset($_GET['tagId'])&& !empty($_GET['tagId'])){
            $includingTagIds = htmlspecialchars($_GET['tagId']);
        }

        $whereArray = array();
        if(isset($includingTags) ||isset($excludingTags) || isset($includingTagIds)){
            if(isset($includingTags)){
                $includingTagsArray = explode(",", $includingTags);
                foreach ($includingTagsArray as $includingTagName) {
                    $tag = Tag::findBySql('SELECT * FROM tag WHERE tag = "'.$includingTagName.'"')->one();
                    $whereArray[] = 'FIND_IN_SET("'.$tag->tagId.'", tagIds) > 0';
                }
            }
            if(isset($excludingTags)){
                $whereNotArray = array();
                $excludingTagsArray = explode(",", $excludingTags);
                foreach ($excludingTagsArray as $excludingTagName) {
                    $tag = Tag::findBySql('SELECT * FROM tag WHERE tag = "'.$excludingTagName.'"')->one();
                    $whereNotArray[] = 'FIND_IN_SET("'.$tag->tagId.'", tagIds) = 0';
                }
            }
            if(isset($includingTagIds)){
                $includingTagsArray = explode(",", $includingTagIds);
                foreach ($includingTagsArray as $includingTagId) {
                    $whereArray[] = 'FIND_IN_SET("'.$includingTagId.'", tagIds) > 0';
                }
            }
        }else if(isset($followingUsers)){
            $followingUsersArray = explode(",", $followingUsers);
            foreach ($followingUsersArray as $followingUserId) {
                $whereArray[] = 'FIND_IN_SET("'.$followingUserId.'", userId) > 0';
            }
        }else{
            $where = '';
        }

        $where = implode(" OR ",$whereArray);

        if(isset($whereNotArray)){
            $whereNot = implode(" AND ",$whereNotArray);
            if(!empty($where))
                $where .= " AND ".$whereNot;
            else
                $where = $whereNot;
        }

        // get recipe data
        $query = Recipe::find();

        $pagination = new Pagination([
            'defaultPageSize' => 6,
            'totalCount' => $query->count(),
        ]);

        $recipes = $query
            ->where($where)
            ->orderBy('recipeId')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $recipesObject = Recipe::findBySql('SELECT * FROM recipe')->where($where)->orderBy('recipeId')->all();


        // get user name for each recipe
        $recipesUserArray = array();
        foreach ($recipesObject as $key => $recipe) {
            $user = User::findBySql('SELECT username FROM user WHERE id = '.$recipe->userId)->one();
            $recipesUserArray[$recipe->recipeId] = $user->username;
        }

        // get tag name used for each recipe
        $recipesTagArray = array();
        foreach ($recipesObject as $key => $recipe) {
            $tagIdArray = explode(",", $recipe->tagIds);
            foreach ($tagIdArray as $tagId) {
                $tag = Tag::findBySql('SELECT tag FROM tag WHERE tagId = '.$tagId)->one();
                $recipesTagArray[$recipe->recipeId][$tagId] = $tag->tag;
            }
        }

        return $this->render('index', [
            'tag' => $recipesTagArray,
            'user' => $recipesUserArray,
            'recipes' => $recipes,
            'pagination' => $pagination,
        ]);

    }
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }
    /**
     * Displays sign up page.
     *
     * @return string
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup(Yii::$app->params['adminEmail']) /*&& $model->actionEmail()*/) {
            Yii::$app->session->setFlash('signupFormSubmitted');
            return $this->refresh();
        }
        else{
        return $this->render('signup', [
            'model' => $model,
        ]);
        }
    }

    

    /**
     * Displays forget password page.
     *
     * @return string
     */

    public function actionForgetpassword()
    {
        
        $model = new ForgetPasswordForm();
        if ($model->load(Yii::$app->request->post())){
            if($model->forgetpassword()){
                Yii::$app->session->setFlash('forgetpasswordFormSubmitted');
                return $this->refresh();
            }else{
                Yii::$app->session->setFlash('emailDoesNotExistsError');
                return $this->refresh();
            }
        }
        else{
        return $this->render('forgetpassword', [
            'model' => $model,
        ]);
    }
}

    /**
     * fetch json data from Database
     *
     * @return string
     */

    public function actionSearch()
    {
        $result = Tag::findBySql('SELECT tagId,tag FROM tag LIMIT 0,10')->all();
        foreach ($result as $key => $value) {
            $user_arr[] = $value->tagId;
            $user_arr2[] = $value->tag;
        }
        // print_r($user_arr2);
        echo json_encode($user_arr2);
    }

    public function actionAboutus()
    {
            return $this->render('aboutus');
    }

    public function actionContactus()
    {
            return $this->render('contactus');
    }

    public function actionSitemap()
    {
            return $this->render('sitemap');
    }

    public function actionTerms()
    {
            return $this->render('terms');
    }

    public function actionPrivacy()
    {
            return $this->render('privacy');
    }
}

