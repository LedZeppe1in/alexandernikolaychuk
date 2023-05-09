<?php

namespace app\modules\client\controllers;

use app\modules\admin\models\ProjectPhoto;
use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\modules\admin\models\User;
use app\modules\client\models\LoginForm;
use app\modules\client\models\ContactForm;
use app\modules\admin\models\Concert;
use app\modules\admin\models\MusicAlbum;
use app\modules\admin\models\Photo;
use app\modules\admin\models\Project;
use app\modules\admin\models\Repertoire;
use app\modules\admin\models\Video;

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
        return $this->render('concerts', ['model' => Concert::find()->all(), 'user' => User::find()->one()]);
    }

    /**
     * Media page.
     *
     * @return string
     */
    public function actionMedia()
    {
        return $this->render('media', ['user' => User::find()->one()]);
    }

    /**
     * Photo page.
     *
     * @return string
     */
    public function actionPhoto()
    {
        return $this->render('photo', [
            'model' => Photo::find()->where(['type' => Photo::AUTHOR_TYPE])->all(),
            'user' => User::find()->one(),
        ]);
    }

    /**
     * Photo carousel page.
     *
     * @param $id
     * @return string
     */
    public function actionPhotoCarousel($id)
    {
        $model = null;
        if (Photo::findOne($id)->type == Photo::AUTHOR_TYPE)
            $model = Photo::find()->where(['type' => Photo::AUTHOR_TYPE])->all();
        else {
            $project_photo = ProjectPhoto::find()->where(['photo' => (int)$id])->one();
            if (!empty($project_photo)) {
                $project_photos = ProjectPhoto::find()->where(['project' => $project_photo->project])->all();
                $arr = [];
                foreach ($project_photos as $item)
                    array_push($arr, $item->photo);
                $model = Photo::findAll($arr);
            }
        }

        return $this->render('photo-carousel', [
            'model' => $model,
            'id' => $id,
            'user' => User::find()->one(),
        ]);
    }

    /**
     * Video page.
     *
     * @return string
     */
    public function actionVideo()
    {
        return $this->render('video', ['model' => Video::find()->all(), 'user' => User::find()->one()]);
    }

    /**
     * Music page.
     *
     * @return string
     */
    public function actionMusic()
    {
        return $this->render('music', [
            'model' => MusicAlbum::find()->where(['type' => MusicAlbum::AUTHOR_TYPE])->all(),
            'user' => User::find()->one()
        ]);
    }

    /**
     * Displays a single MusicAlbum model.
     *
     * @param $id
     * @return string
     */
    public function actionMusicView($id)
    {
        return $this->render('music-view', ['model' => MusicAlbum::findOne($id), 'user' => User::find()->one()]);
    }

    /**
     * Projects page.
     *
     * @return string
     */
    public function actionProjects()
    {
        return $this->render('projects', ['model' => Project::find()->all(), 'user' => User::find()->one()]);
    }

    /**
     * Displays a single Project model.
     *
     * @param $id
     * @return string
     */
    public function actionProjectView($id)
    {
        return $this->render('project-view', ['model' => Project::findOne($id), 'user' => User::find()->one()]);
    }

    /**
     * Repertoire page.
     *
     * @return string
     */
    public function actionRepertoire()
    {
        return $this->render('repertoire', [
            'concert_repertoire' => Repertoire::find()->where(['type' => Repertoire::CONCERT_TYPE])->all(),
            'orchestra_repertoire' => Repertoire::find()->where(['type' => Repertoire::ORCHESTRA_TYPE])->all(),
            'user' => User::find()->one()
        ]);
    }

    /**
     * Contacts page.
     *
     * @return string
     */
    public function actionContacts()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }

        return $this->render('contacts', [
            'model' => $model,
            'user' => User::find()->one(),
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