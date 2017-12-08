<?php
namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\AdminLoginForm;
use app\models\Report;
use app\models\User;
use app\models\Recipe;


class AdminController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','login'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['login','signup'],
                        'allow' => true,
                        'roles' => ['?'],
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
        $model = new AdminLoginForm();
        if(isset(Yii::$app->user->identity->role)){
            if(Yii::$app->user->identity->role=='admin' ||$model->load(Yii::$app->request->post()) && $model->login()){

                // list report from report table
                $report = Report::findBySql('SELECT * FROM report where resolved = 0')->orderBy('time')->all();
                $userInfo = User::findBySql('SELECT * FROM user')->all();
				
				$username = array(); 
                $active = array();
				foreach ($report as $value){ 
					$userA = User::findBySql('SELECT * FROM user where id = '.$value->reportUserId)->one();
					$username[$value->reportUserId] = $userA->username; 
                    $active[$value->reportUserId] = $userA->active;
				}
				$reporter = array();
				foreach ($report as $value){ 
					$reporterA = User::findBySql('SELECT * FROM user where id = '.$value->reporterId)->one();
					$reporter[$value->reporterId] = $reporterA->username; 
				}
               

	
				

				$recipeTitle = array();
				foreach ($report as $value){ 
					$r = Recipe::findBySql('SELECT * FROM recipe where recipeId ='.$value->recipeId)->one();
					if(empty($r)){
						$recipeTitle[$value->recipeId] = 'Recipe deleted';
					}else{
						$recipeTitle[$value->recipeId] = $r->recipeTitle; 
					}
				}
				$count = 1;
				
				
                return $this->render('index',[
                    'report' => $report,
					'count' => $count,
					'username' => $username,
					'recipeTitle' => $recipeTitle,
					'reporter' => $reporter,
                    'active' => $active,
                ]);
            }
        }
        return $this->redirect(['admin/login']);
    }
	
	    public function actionResolved()
    {

                // list report from report table
                $report = Report::findBySql('SELECT * FROM report where resolved = 1')->orderBy('time')->all();
				
				$userInfo = User::findBySql('SELECT * FROM user')->all();
                
                $username = array(); 
                $active = array();
                foreach ($report as $value){ 
                    $userA = User::findBySql('SELECT * FROM user where id = '.$value->reportUserId)->one();
                    $username[$value->reportUserId] = $userA->username; 
                    $active[$value->reportUserId] = $userA->active;
                }
                $reporter = array();
                foreach ($report as $value){ 
                    $reporterA = User::findBySql('SELECT * FROM user where id = '.$value->reporterId)->one();
                    $reporter[$value->reporterId] = $reporterA->username; 
                }
	
				

				$recipeTitle = array();
				foreach ($report as $value){ 
					$r = Recipe::findBySql('SELECT * FROM recipe where recipeId ='.$value->recipeId)->one();
					if(empty($r)){
						$recipeTitle[$value->recipeId] = 'Recipe deleted';
					}else{
						$recipeTitle[$value->recipeId] = $r->recipeTitle; 
					}
				}
				$count = 1;
				
				
                return $this->render('resolved',[
                    'report' => $report,
					'count' => $count,
					'username' => $username,
					'recipeTitle' => $recipeTitle,
					'reporter' => $reporter,
                    'active' => $active,
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
        $model = new AdminLoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['admin/index']);
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
     * Handle remove user
     *
     * @return string
     */

    
    public function actionBanuser()
    {
        if(isset($_GET['userId'])&& !empty($_GET['userId'])){
            $userId = htmlspecialchars($_GET['userId']);
        } else{
            throw new \yii\web\HttpException(404, 'The requested Item could not be found.');
        }
        // get userId to be removed

        if(!Yii::$app->user->identity->role=='admin'){
            throw new \yii\web\HttpException(403, 'You do not have permission to do this action');;
        } else {
            Yii::$app->db->createCommand()->update('user' , ['active' => 0],'id = "'.$userId.'"')->execute();
            Yii::$app->session->setFlash('user-banned successed'); 
            return $this->actionIndex();
        }
        // check if userId not exists throw error 
            // 404, 'The requested Item could not be found.'

        // else check if current user is not admin throw error 
            // 403, You don't have permission to do this action

        // else delete user

        // return to admin/index with successful msg


        // HINT: use 
        // Yii::$app->session->setFlash(''); 
        // to successful error msg

        // HINT: use 
        // throw new \yii\web\HttpException(404, 'The requested Item could not be found.');
        // to show error msg
    }


            /**
     * Handle remove recipe
     *
     * @return string
     */

    public function actionRemoverecipe()
    {
        if(isset($_GET['recipeId'])&& !empty($_GET['recipeId'])){
            $recipe = htmlspecialchars($_GET['recipeId']);
        } else{
            throw new \yii\web\HttpException(404, 'The requested Item could not be found.');
        }

        if(!Yii::$app->user->identity->role=='admin'){
            throw new \yii\web\HttpException(403, 'You do not have permission to do this action');;
        } else {
            Yii::$app->db->createCommand()->delete('recipe' , 'recipeId = "'.$recipe.'"')->execute();
            Yii::$app->session->setFlash('recipe deleted'); 
            return $this->actionIndex();
        }
        // get recipeId to be removed

        // check if recipeId not exists throw error 
            // 404, 'The requested Item could not be found.'

        // else check if current user is not admin throw error
            // 403, You don't have permission to do this action 

        // else delete recipe

        // return to admin/index with successful msg


        // HINT: use 
        // Yii::$app->session->setFlash(''); 
        // to successful error msg

        // HINT: use 
        // throw new \yii\web\HttpException(404, 'The requested Item could not be found.');
        // to show error msg
        
    }

    


                /**
     * Handle resolved case
     *
     * @return string
     */

    public function actionResolvedcase()
    {
        if(isset($_GET['caseId'])&& !empty($_GET['caseId'])){
            $case = htmlspecialchars($_GET['caseId']);
        } else{
            throw new \yii\web\HttpException(404, 'The requested Item could not be found.');
        }

         if(!Yii::$app->user->identity->role=='admin'){
            throw new \yii\web\HttpException(403, 'You do not have permission to do this action');;
        } else{
            Yii::$app->db->createCommand()->update('report' , ['resolved' => 1],'caseNo = "'.$case.'"')->execute();
            Yii::$app->session->setFlash('command successed'); 
            return $this->actionIndex();
        }
        
        // get caseId to be removed

        // check if caseId not exists throw error 
            // 404, 'The requested Item could not be found.'

        // else check if current user is not admin throw error 
            // 403, You don't have permission to do this action

        // else change cases' resolved column value to 1

        // return to admin/index with successful msg


        // HINT: use 
        // Yii::$app->session->setFlash(''); 
        // to successful error msg

        // HINT: use 
        // throw new \yii\web\HttpException(404, 'The requested Item could not be found.');
        // to show error msg
      }

    public function actionUnbanuser()
    {
        if(isset($_GET['userId'])&& !empty($_GET['userId'])){
            $userId = htmlspecialchars($_GET['userId']);
        } else{
            throw new \yii\web\HttpException(404, 'The requested Item could not be found.');
        }
        // get userId to be removed

        if(!Yii::$app->user->identity->role=='admin'){
            throw new \yii\web\HttpException(403, 'You do not have permission to do this action');;
        } else {
            Yii::$app->db->createCommand()->update('user' , ['active' => 1],'id = "'.$userId.'"')->execute();
            Yii::$app->session->setFlash('user-banned successed'); 
            return $this->actionIndex();
        }
    }
    public function actionBanuserb()
    {
        if(isset($_GET['userId'])&& !empty($_GET['userId'])){
            $userId = htmlspecialchars($_GET['userId']);
        } else{
            throw new \yii\web\HttpException(404, 'The requested Item could not be found.');
        }
        // get userId to be removed

        if(!Yii::$app->user->identity->role=='admin'){
            throw new \yii\web\HttpException(403, 'You do not have permission to do this action');;
        } else {
            Yii::$app->db->createCommand()->update('user' , ['active' => 0],'id = "'.$userId.'"')->execute();
            Yii::$app->session->setFlash('user-banned successed'); 
            return $this->actionResolved();
        }
        // check if userId not exists throw error 
            // 404, 'The requested Item could not be found.'

        // else check if current user is not admin throw error 
            // 403, You don't have permission to do this action

        // else delete user

        // return to admin/index with successful msg


        // HINT: use 
        // Yii::$app->session->setFlash(''); 
        // to successful error msg

        // HINT: use 
        // throw new \yii\web\HttpException(404, 'The requested Item could not be found.');
        // to show error msg
    }

    public function actionUnbanuserb()
    {
        if(isset($_GET['userId'])&& !empty($_GET['userId'])){
            $userId = htmlspecialchars($_GET['userId']);
        } else{
            throw new \yii\web\HttpException(404, 'The requested Item could not be found.');
        }
        // get userId to be removed

        if(!Yii::$app->user->identity->role=='admin'){
            throw new \yii\web\HttpException(403, 'You do not have permission to do this action');;
        } else {
            Yii::$app->db->createCommand()->update('user' , ['active' => 1],'id = "'.$userId.'"')->execute();
            Yii::$app->session->setFlash('user-banned successed'); 
            return $this->actionResolved();
        }
    }

    public function actionRemoverecipeb()
    {
        if(isset($_GET['recipeId'])&& !empty($_GET['recipeId'])){
            $recipe = htmlspecialchars($_GET['recipeId']);
        } else{
            throw new \yii\web\HttpException(404, 'The requested Item could not be found.');
        }

        if(!Yii::$app->user->identity->role=='admin'){
            throw new \yii\web\HttpException(403, 'You do not have permission to do this action');;
        } else {
            Yii::$app->db->createCommand()->delete('recipe' , 'recipeId = "'.$recipe.'"')->execute();
            Yii::$app->session->setFlash('recipe deleted'); 
            return $this->actionResolved();
        }
    }

    public function actionUnresolvedcase()
    {
        if(isset($_GET['caseId'])&& !empty($_GET['caseId'])){
            $case = htmlspecialchars($_GET['caseId']);
        } else{
            throw new \yii\web\HttpException(404, 'The requested Item could not be found.');
        }

         if(!Yii::$app->user->identity->role=='admin'){
            throw new \yii\web\HttpException(403, 'You do not have permission to do this action');;
        } else{
            Yii::$app->db->createCommand()->update('report' , ['resolved' => 0],'caseNo = "'.$case.'"')->execute();
            Yii::$app->session->setFlash('command successed'); 
            return $this->actionResolved();
        }
    }
}

