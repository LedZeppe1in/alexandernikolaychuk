<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\admin\models\Concert;
use app\modules\admin\models\ConcertSearch;
use yii\web\UploadedFile;

/**
 * ConcertController implements the CRUD actions for Concert model.
 */
class ConcertController extends Controller
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
     * Lists all Concert models.
     *
     * @return string
     */
    public function actionList()
    {
        $searchModel = new ConcertSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Concert model.
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
     * Creates a new Concert model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return string|\yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionCreate()
    {
        $model = new Concert();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $file = UploadedFile::getInstance($model, 'poster_file');
                if ($file && $file->tempName) {
                    $model->poster_file = $file;
                    if ($model->validate(['poster_file'])) {
                        // Формирование пути к файлу афишы
                        $dir = Yii::getAlias('@webroot') . '/uploads/concert-poster/';
                        $fileName = str_replace(' ', '-', $model->poster_file->baseName) . '.' .
                            $model->poster_file->extension;
                        $model->poster = $dir . $fileName;
                    }
                }
                // Сохранение данных в БД
                if ($model->save()) {
                    if ($model->poster !== null) {
                        // Создание новой директории для файла афишы
                        $dir = Yii::getAlias('@webroot') . '/uploads/concert-poster/' . $model->id . '/';
                        $fileName = str_replace(' ', '-', $model->poster_file->baseName) . '.' .
                            $model->poster_file->extension;
                        FileHelper::createDirectory($dir);
                        // Обновление пути к файлу афишы в БД
                        $model->updateAttributes(['poster' => $dir . $fileName]);
                        // Сохранение файла афишы на сервере
                        $model->poster_file->saveAs($dir . $fileName);
                    }
                    // Вывод сообщения
                    Yii::$app->getSession()->setFlash('success',
                        Yii::t('app', 'CONCERTS_ADMIN_PAGE_MESSAGE_CREATE_CONCERT'));

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
     * Updates an existing Concert model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \yii\base\Exception
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $file = UploadedFile::getInstance($model, 'poster_file');
            if ($file && $file->tempName) {
                $model->poster_file = $file;
                if ($model->validate(['poster_file'])) {
                    if ($model->poster !== null) {
                        // Определение директории где расположен файл афишы
                        $pos = strrpos($model->poster, '/');
                        $dir = substr($model->poster, 0, $pos) . '/';
                        // Запоминание нового имя файла афишы
                        $fileName = str_replace(' ', '-', $model->poster_file->baseName) . '.' .
                            $model->poster_file->extension;
                        // Удаление старого файла афишы
                        unlink($model->poster);
                    } else {
                        // Формирование пути к файлу афишы
                        $dir = Yii::getAlias('@webroot') . '/uploads/concert-poster/';
                        $fileName = str_replace(' ', '-', $model->poster_file->baseName) . '.' .
                            $model->poster_file->extension;
                        $model->poster = $dir . $fileName;
                        // Создание новой директории для файла афишы
                        $dir .= $model->id . '/';
                        FileHelper::createDirectory($dir);
                    }
                    // Сохранение нового файла афишы
                    $model->poster_file->saveAs($dir . $fileName);
                    // Сохранение нового пути к файлу афишы в БД
                    $model->updateAttributes(['poster' => $dir . $fileName]);
                }
            }
            Yii::$app->getSession()->setFlash('success',
                Yii::t('app', 'CONCERTS_ADMIN_PAGE_MESSAGE_UPDATED_CONCERT'));

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Concert model.
     * If deletion is successful, the browser will be redirected to the 'list' page.
     *
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\base\ErrorException
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->poster !== null) {
            // Определение директории где расположен файл афишы
            $pos = strrpos($model->poster, '/');
            $dir = substr($model->poster, 0, $pos);
            // Удаление файла афишы и директории где она хранилась
            FileHelper::removeDirectory($dir);
        }
        $model->delete(); // Удалние записи из БД
        Yii::$app->getSession()->setFlash('success',
            Yii::t('app', 'CONCERTS_ADMIN_PAGE_MESSAGE_DELETED_CONCERT'));

        return $this->redirect(['list']);
    }

    /**
     * Finds the Concert model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param $id
     * @return Concert the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Concert::findOne(['id' => $id])) !== null)
            return $model;

        throw new NotFoundHttpException(Yii::t('app', 'ERROR_MESSAGE_PAGE_NOT_FOUND'));
    }
}