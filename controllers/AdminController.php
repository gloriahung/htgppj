<?php
namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\AdminLoginForm;
use app\models\SignupForm;
use app\models\ForgetPasswordForm;


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
                'only' => ['logout','login','signup','forgetpassword'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['login','signup','forgetpassword'],
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
                return $this->render('index');
            }
        }

        return $this->render('login', [
            'model' => $model,
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
            return $this->render('index');
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
     * Handle remove user
     *
     * @return string
     */

    public function actionRemoveuser()
    {
        
        // get userId to be removed

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

}

