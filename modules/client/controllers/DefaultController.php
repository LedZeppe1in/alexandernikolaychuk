<?php

namespace app\modules\client\controllers;

use app\modules\admin\models\Concert;
use app\modules\admin\models\MusicAlbum;
use app\modules\admin\models\Photo;
use app\modules\admin\models\Project;
use app\modules\admin\models\Repertoire;
use app\modules\admin\models\Video;
use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\modules\admin\models\User;
use app\modules\client\models\LoginForm;
use app\modules\client\models\ContactForm;

class DefaultController extends Controller
{
    public $layout = 'client'; // Подключение макета клиентской части сайта

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
        $this->layout = 'home'; // Подключение макета главной страницы
        return $this->render('index', ['user' => User::find()->one()]);
    }

    /**
     * Biography page.
     *
     * @return string
     */
    public function actionBiography()
    {
        return $this->render('biography', ['user' => User::find()->one()]);
    }

    /**
     * Concerts page.
     *
     * @return string
     */
    public function actionConcerts()
    {
        $model = Concert::find()->all();
        $user = User::find()->one();

        return $this->render('concerts', [
            'model' => $model,
            'user' => $user,
        ]);
    }

    /**
     * Media page.
     *
     * @return string
     */
    public function actionMedia()
    {
        $photo_model = Photo::find()->all();
        $video_model = Video::find()->all();
        $user = User::find()->one();

        return $this->render('media', [
            'photo_model' => $photo_model,
            'video_model' => $video_model,
            'user' => $user,
        ]);
    }

    /**
     * Music page.
     *
     * @return string
     */
    public function actionMusic()
    {
        $model = MusicAlbum::find()->all();
        $user = User::find()->one();

        return $this->render('music', [
            'model' => $model,
            'user' => $user,
        ]);
    }

    /**
     * Projects page.
     *
     * @return string
     */
    public function actionProjects()
    {
        $model = Project::find()->all();
        $user = User::find()->one();

        return $this->render('projects', [
            'model' => $model,
            'user' => $user,
        ]);
    }

    /**
     * Repertoire page.
     *
     * @return string
     */
    public function actionRepertoire()
    {
        $model = Repertoire::find()->all();
        $user = User::find()->one();

        return $this->render('repertoire', [
            'model' => $model,
            'user' => $user,
        ]);
    }

    /**
     * Contacts page.
     *
     * @return string
     */
    public function actionContacts()
    {
        $user = User::find()->one();

        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }

        return $this->render('contacts', [
            'model' => $model,
            'user' => $user,
        ]);
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
            return $this->redirect('/admin/user/profile');

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