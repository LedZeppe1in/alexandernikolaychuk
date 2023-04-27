<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\admin\models\MusicAlbum;
use app\modules\admin\models\MusicAlbumSearch;
use yii\web\UploadedFile;

/**
 * MusicAlbumController implements the CRUD actions for MusicAlbum model.
 */
class MusicAlbumController extends Controller
{
    public $layout = 'admin';

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all MusicAlbum models.
     *
     * @return string
     */
    public function actionList()
    {
        $searchModel = new MusicAlbumSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MusicAlbum model.
     *
     * @param $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MusicAlbum model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return string|\yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionCreate()
    {
        $model = new MusicAlbum();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $file = UploadedFile::getInstance($model, 'cover_file');
                if ($file && $file->tempName) {
                    $model->cover_file = $file;
                    if ($model->validate(['cover_file'])) {
                        // Формирование пути к файлу обложки
                        $dir = Yii::getAlias('@webroot') . '/uploads/album-cover/';
                        $fileName = str_replace(' ', '-', $model->cover_file->baseName) . '.' .
                            $model->cover_file->extension;
                        $model->cover = $dir . $fileName;
                    }
                }
                // Сохранение данных в БД
                if ($model->save()) {
                    if ($model->cover !== null) {
                        // Создание новой директории для файла обложки
                        $dir = Yii::getAlias('@webroot') . '/uploads/album-cover/' . $model->id . '/';
                        $fileName = str_replace(' ', '-', $model->cover_file->baseName) . '.' .
                            $model->cover_file->extension;
                        FileHelper::createDirectory($dir);
                        // Обновление пути к файлу обложки в БД
                        $model->updateAttributes(['cover' => $dir . $fileName]);
                        // Сохранение файла обложки на сервере
                        $model->cover_file->saveAs($dir . $fileName);
                    }
                    Yii::$app->getSession()->setFlash('success',
                        Yii::t('app', 'MUSIC_ADMIN_PAGE_MESSAGE_CREATE_MUSIC_ALBUM'));

                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else
            $model->loadDefaultValues();

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MusicAlbum model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\base\Exception
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'cover_file');
            if ($file && $file->tempName) {
                $model->cover_file = $file;
                if ($model->validate(['cover_file'])) {
                    if ($model->cover !== null) {
                        // Определение директории где расположен файл обложки
                        $pos = strrpos($model->cover, '/');
                        $dir = substr($model->cover, 0, $pos) . '/';
                        // Запоминание нового имя файла афишы
                        $fileName = str_replace(' ', '-', $model->cover_file->baseName) . '.' .
                            $model->cover_file->extension;
                        // Удаление старого файла обложки
                        unlink($model->cover);
                    } else {
                        // Формирование пути к файлу обложки
                        $dir = Yii::getAlias('@webroot') . '/uploads/album-cover/';
                        $fileName = str_replace(' ', '-', $model->cover_file->baseName) . '.' .
                            $model->cover_file->extension;
                        $model->cover = $dir . $fileName;
                        // Создание новой директории для файла обложки
                        $dir .= $model->id . '/';
                        FileHelper::createDirectory($dir);
                    }
                    // Сохранение нового файла обложки
                    $model->cover_file->saveAs($dir . $fileName);
                    // Сохранение нового пути к файлу обложки в БД
                    $model->updateAttributes(['cover' => $dir . $fileName]);
                }
            }
            Yii::$app->getSession()->setFlash('success',
                Yii::t('app', 'MUSIC_ADMIN_PAGE_UPDATE_MUSIC_ALBUM'));

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MusicAlbum model.
     * If deletion is successful, the browser will be redirected to the 'list' page.
     *
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\base\ErrorException
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->cover !== null) {
            // Определение директории где расположен файл обложки
            $pos = strrpos($model->cover, '/');
            $dir = substr($model->cover, 0, $pos);
            // Удаление файла обложки и директории где она хранилась
            FileHelper::removeDirectory($dir);
        }
        $model->delete(); // Удалние записи из БД
        Yii::$app->getSession()->setFlash('success',
            Yii::t('app', 'MUSIC_ADMIN_PAGE_DELETE_MUSIC_ALBUM'));

        return $this->redirect(['list']);
    }

    /**
     * Finds the MusicAlbum model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param $id
     * @return MusicAlbum the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MusicAlbum::findOne(['id' => $id])) !== null)
            return $model;

        throw new NotFoundHttpException(Yii::t('app', 'ERROR_MESSAGE_PAGE_NOT_FOUND'));
    }
}