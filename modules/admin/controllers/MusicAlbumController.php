<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Project;
use app\modules\admin\models\ProjectAlbum;
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
                $file_ru = UploadedFile::getInstance($model, 'cover_file_ru');
                if ($file_ru && $file_ru->tempName) {
                    $model->cover_file_ru = $file_ru;
                    if ($model->validate(['cover_file_ru'])) {
                        // Формирование пути к файлу обложки на русском языке
                        $dir = Yii::getAlias('@webroot') . '/uploads/album-cover-ru/';
                        $fileName = str_replace(' ', '-', $model->cover_file_ru->baseName) . '.' .
                            $model->cover_file_ru->extension;
                        $model->cover_ru = $dir . $fileName;
                    }
                }
                $file_en = UploadedFile::getInstance($model, 'cover_file_en');
                if ($file_en && $file_en->tempName) {
                    $model->cover_file_en = $file_en;
                    if ($model->validate(['cover_file_en'])) {
                        // Формирование пути к файлу обложки на английском языке
                        $dir = Yii::getAlias('@webroot') . '/uploads/album-cover-en/';
                        $fileName = str_replace(' ', '-', $model->cover_file_en->baseName) . '.' .
                            $model->cover_file_en->extension;
                        $model->cover_en = $dir . $fileName;
                    }
                }
                // Сохранение данных в БД
                if ($model->save()) {
                    if ($model->cover_ru !== null) {
                        // Создание новой директории для файла обложки на русском языке
                        $dir = Yii::getAlias('@webroot') . '/uploads/album-cover-ru/' . $model->id . '/';
                        $fileName = str_replace(' ', '-', $model->cover_file_ru->baseName) . '.' .
                            $model->cover_file_ru->extension;
                        FileHelper::createDirectory($dir);
                        // Обновление пути к файлу обложки на русском языке в БД
                        $model->updateAttributes(['cover_ru' => $dir . $fileName]);
                        // Сохранение файла обложки на русском языке на сервере
                        $model->cover_file_ru->saveAs($dir . $fileName);
                    }
                    if ($model->cover_en !== null) {
                        // Создание новой директории для файла обложки на английском языке
                        $dir = Yii::getAlias('@webroot') . '/uploads/album-cover-en/' . $model->id . '/';
                        $fileName = str_replace(' ', '-', $model->cover_file_en->baseName) . '.' .
                            $model->cover_file_en->extension;
                        FileHelper::createDirectory($dir);
                        // Обновление пути к файлу обложки на английском языке в БД
                        $model->updateAttributes(['cover_en' => $dir . $fileName]);
                        // Сохранение файла обложки на английском языке на сервере
                        $model->cover_file_en->saveAs($dir . $fileName);
                    }
                    // Создание связи музыкального альбома с проектом
                    if ($model->type == MusicAlbum::PROJECT_TYPE) {
                        $project_album = new ProjectAlbum();
                        $project_album->project = Project::findOne(Yii::$app->request->post('MusicAlbum')['project'])->id;
                        $project_album->music_album = $model->id;
                        $project_album->save();
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
            $file_ru = UploadedFile::getInstance($model, 'cover_file_ru');
            if ($file_ru && $file_ru->tempName) {
                $model->cover_file_ru = $file_ru;
                if ($model->validate(['cover_file_ru'])) {
                    if ($model->cover_ru !== null) {
                        // Определение директории где расположен файл обложки на русском языке
                        $pos = strrpos($model->cover_ru, '/');
                        $dir = substr($model->cover_ru, 0, $pos) . '/';
                        // Запоминание нового имя файла обложки на русском языке
                        $fileName = str_replace(' ', '-', $model->cover_file_ru->baseName) . '.' .
                            $model->cover_file_ru->extension;
                        // Удаление старого файла обложки на русском языке
                        unlink($model->cover_ru);
                    } else {
                        // Формирование пути к файлу обложки на русском языке
                        $dir = Yii::getAlias('@webroot') . '/uploads/album-cover-ru/';
                        $fileName = str_replace(' ', '-', $model->cover_file_ru->baseName) . '.' .
                            $model->cover_file_ru->extension;
                        $model->cover_ru = $dir . $fileName;
                        // Создание новой директории для файла обложки на русском языке
                        $dir .= $model->id . '/';
                        FileHelper::createDirectory($dir);
                    }
                    // Сохранение нового файла обложки на русском языке
                    $model->cover_file_ru->saveAs($dir . $fileName);
                    // Сохранение нового пути к файлу обложки на русском языке в БД
                    $model->updateAttributes(['cover_ru' => $dir . $fileName]);
                }
            }
            $file_en = UploadedFile::getInstance($model, 'cover_file_en');
            if ($file_en && $file_en->tempName) {
                $model->cover_file_en = $file_en;
                if ($model->validate(['cover_file_en'])) {
                    if ($model->cover_en !== null) {
                        // Определение директории где расположен файл обложки на английском языке
                        $pos = strrpos($model->cover_en, '/');
                        $dir = substr($model->cover_en, 0, $pos) . '/';
                        // Запоминание нового имя файла обложки на русском языке
                        $fileName = str_replace(' ', '-', $model->cover_file_en->baseName) . '.' .
                            $model->cover_file_en->extension;
                        // Удаление старого файла обложки на английском языке
                        unlink($model->cover_en);
                    } else {
                        // Формирование пути к файлу обложки на английском языке
                        $dir = Yii::getAlias('@webroot') . '/uploads/album-cover-en/';
                        $fileName = str_replace(' ', '-', $model->cover_file_en->baseName) . '.' .
                            $model->cover_file_en->extension;
                        $model->cover_en = $dir . $fileName;
                        // Создание новой директории для файла обложки на английском языке
                        $dir .= $model->id . '/';
                        FileHelper::createDirectory($dir);
                    }
                    // Сохранение нового файла обложки на английском языке
                    $model->cover_file_en->saveAs($dir . $fileName);
                    // Сохранение нового пути к файлу обложки на английском языке в БД
                    $model->updateAttributes(['cover_en' => $dir . $fileName]);
                }
            }
            // Обновление связи музыкального альбома с проектом
            $project_id = Project::findOne(Yii::$app->request->post('MusicAlbum')['project'])->id;
            $project_album = ProjectAlbum::find()->where(['music_album' => $model->id])->one();
            if (empty($project_album)) {
                if ($model->type == MusicAlbum::PROJECT_TYPE) {
                    $project_album = new ProjectAlbum();
                    $project_album->project = $project_id;
                    $project_album->music_album = $model->id;
                    $project_album->save();
                }
            } else
                if ($model->type == MusicAlbum::PROJECT_TYPE)
                    $project_album->updateAttributes(['project' => $project_id]);
                else
                    $project_album->delete();
            Yii::$app->getSession()->setFlash('success',
                Yii::t('app', 'MUSIC_ADMIN_PAGE_MESSAGE_UPDATED_MUSIC_ALBUM'));

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
        if ($model->cover_ru !== null) {
            // Определение директории где расположен файл обложки на русском языке
            $pos = strrpos($model->cover_ru, '/');
            $dir = substr($model->cover_ru, 0, $pos);
            // Удаление файла обложки на русском языке и директории где она хранилась
            FileHelper::removeDirectory($dir);
        }
        if ($model->cover_en !== null) {
            // Определение директории где расположен файл обложки на английском языке
            $pos = strrpos($model->cover_en, '/');
            $dir = substr($model->cover_en, 0, $pos);
            // Удаление файла обложки на английском языке и директории где она хранилась
            FileHelper::removeDirectory($dir);
        }
        $model->delete(); // Удалние записи из БД
        Yii::$app->getSession()->setFlash('success',
            Yii::t('app', 'MUSIC_ADMIN_PAGE_MESSAGE_DELETED_MUSIC_ALBUM'));

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