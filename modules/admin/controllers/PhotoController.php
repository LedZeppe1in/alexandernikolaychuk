<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\admin\models\Photo;
use app\modules\admin\models\PhotoSearch;
use yii\web\UploadedFile;

/**
 * PhotoController implements the CRUD actions for Photo model.
 */
class PhotoController extends Controller
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
     * Lists all Photo models.
     *
     * @return string
     */
    public function actionList()
    {
        $searchModel = new PhotoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Photo model.
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
     * Creates a new Photo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return string|\yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionCreate()
    {
        $model = new Photo();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $file = UploadedFile::getInstance($model, 'photo_file');
                if ($file && $file->tempName) {
                    $model->photo_file = $file;
                    if ($model->validate(['photo_file'])) {
                        // Формирование пути к файлу фото
                        $dir = Yii::getAlias('@webroot') . '/uploads/photo/';
                        $fileName = str_replace(' ', '-', $model->photo_file->baseName) . '.' .
                            $model->photo_file->extension;
                        $model->file = $dir . $fileName;
                    }
                }
                // Сохранение данных в БД
                if ($model->save()) {
                    if ($model->file !== null) {
                        // Создание новой директории для файла фото
                        $dir = Yii::getAlias('@webroot') . '/uploads/photo/' . $model->id . '/';
                        $fileName = str_replace(' ', '-', $model->photo_file->baseName) . '.' .
                            $model->photo_file->extension;
                        FileHelper::createDirectory($dir);
                        // Обновление пути к файлу фото в БД
                        $model->updateAttributes(['file' => $dir . $fileName]);
                        // Сохранение файла фото на сервере
                        $model->photo_file->saveAs($dir . $fileName);
                    }
                    Yii::$app->getSession()->setFlash('success',
                        Yii::t('app', 'PHOTO_ADMIN_PAGE_MESSAGE_CREATE_PHOTO'));

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
     * Updates an existing Photo model.
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
            $file = UploadedFile::getInstance($model, 'photo_file');
            if ($file && $file->tempName) {
                $model->photo_file = $file;
                if ($model->validate(['photo_file'])) {
                    if ($model->file !== null) {
                        // Определение директории где расположен файл фото
                        $pos = strrpos($model->file, '/');
                        $dir = substr($model->file, 0, $pos) . '/';
                        // Запоминание нового имя файла фото
                        $fileName = str_replace(' ', '-', $model->photo_file->baseName) . '.' .
                            $model->photo_file->extension;
                        // Удаление старого файла фото
                        unlink($model->file);
                    } else {
                        // Формирование пути к файлу фото
                        $dir = Yii::getAlias('@webroot') . '/uploads/photo/';
                        $fileName = str_replace(' ', '-', $model->photo_file->baseName) . '.' .
                            $model->photo_file->extension;
                        $model->file = $dir . $fileName;
                        // Создание новой директории для файла фото
                        $dir .= $model->id . '/';
                        FileHelper::createDirectory($dir);
                    }
                    // Сохранение нового файла фото
                    $model->photo_file->saveAs($dir . $fileName);
                    // Сохранение нового пути к файлу фото в БД
                    $model->updateAttributes(['file' => $dir . $fileName]);
                }
            }
            Yii::$app->getSession()->setFlash('success',
                Yii::t('app', 'PHOTO_ADMIN_PAGE_MESSAGE_UPDATED_PHOTO'));

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Photo model.
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
        if ($model->file !== null) {
            // Определение директории где расположен файл фото
            $pos = strrpos($model->file, '/');
            $dir = substr($model->file, 0, $pos);
            // Удаление файла фото и директории где она хранилась
            FileHelper::removeDirectory($dir);
        }
        $model->delete(); // Удалние записи из БД
        Yii::$app->getSession()->setFlash('success',
            Yii::t('app', 'PHOTO_ADMIN_PAGE_MESSAGE_DELETED_PHOTO'));

        return $this->redirect(['list']);
    }

    /**
     * Finds the Photo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param $id
     * @return Photo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Photo::findOne(['id' => $id])) !== null)
            return $model;

        throw new NotFoundHttpException(Yii::t('app', 'ERROR_MESSAGE_PAGE_NOT_FOUND'));
    }
}