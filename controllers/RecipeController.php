<?php
namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\CommentForm;
use app\models\RecipeForm;
use app\models\ReportForm;

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
        return $this->render('index');
    }
    
    public function actionPostform(){
        return $this->render('postform');
    }




    public function actionRecipe(){

        $model = new RecipeForm();

        if (Yii::$app->request->isPost) {
            $model->recipePhoto = UploadedFile::getInstance($model, 'recipePhoto');
            if ($model->recipe()) {
                return;
            }
        }
        return $this->render('recipe', ['model' => $model]);
        }


    public function actionComment()
        {
            $model = new CommentForm();
            if ($model->load(Yii::$app->request->post()) && $model->comment(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('CommentFormSubmitted');
                return $this->refresh();
            }
            return $this->render('comment', [
                'model' => $model,
            ]);
        }


    public function actionReport()
        {
            $model = new ReportForm();
            if ($model->load(Yii::$app->request->post()) && $model->report(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('ReportFormSubmitted');
                return $this->refresh();
            }
            return $this->render('report', [
                'model' => $model,
            ]);
        }

}