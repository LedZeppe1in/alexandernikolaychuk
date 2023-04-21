<?php

namespace app\modules\client\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\modules\admin\models\User;
use app\modules\client\models\LoginForm;

class DefaultController extends Controller
{
    public $layout = 'client';

    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
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
                'backColor' => 0xF9F9F9,
                'foreColor' => 0xFE5D39,
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
        $user = User::find()->one();

        return $this->render('index', [
            'user' => $user
        ]);
    }

    /**
     * Biography page.
     *
     * @return string
     */
    public function actionBiography()
    {
        return $this->render('biography');
    }

    /**
     * Concerts page.
     *
     * @return string
     */
    public function actionConcerts()
    {
        return $this->render('concerts');
    }

    /**
     * Media page.
     *
     * @return string
     */
    public function actionMedia()
    {
        return $this->render('media');
    }

    /**
     * Music page.
     *
     * @return string
     */
    public function actionMusic()
    {
        return $this->render('music');
    }

    /**
     * Projects page.
     *
     * @return string
     */
    public function actionProjects()
    {
        return $this->render('projects');
    }

    /**
     * Repertoire page.
     *
     * @return string
     */
    public function actionRepertoire()
    {
        return $this->render('repertoire');
    }

    /**
     * Contacts page.
     *
     * @return string
     */
    public function actionContacts()
    {
        return $this->render('contacts');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionSingIn()
    {
        if (!Yii::$app->user->isGuest)
            return $this->goHome();

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login())
            return $this->goBack();

        $model->password = '';
        return $this->render('sing-in', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionSingOut()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}