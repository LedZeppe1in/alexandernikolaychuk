<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\admin\models\Project;
use app\modules\admin\models\ProjectSearch;
use yii\web\UploadedFile;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
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
     * Lists all Project models.
     *
     * @return string
     */
    public function actionList()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Project model.
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
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return string|\yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionCreate()
    {
        $model = new Project();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $file = UploadedFile::getInstance($model, 'poster_file');
                if ($file && $file->tempName) {
                    $model->poster_file = $file;
                    if ($model->validate(['poster_file'])) {
                        // Формирование пути к файлу постера
                        $dir = Yii::getAlias('@webroot') . '/uploads/project-poster/';
                        $fileName = str_replace(' ', '-', $model->poster_file->baseName) . '.' .
                            $model->poster_file->extension;
                        $model->poster = $dir . $fileName;
                    }
                }
                // Сохранение данных в БД
                if ($model->save()) {
                    if ($model->poster !== null) {
                        // Создание новой директории для файла постера
                        $dir = Yii::getAlias('@webroot') . '/uploads/project-poster/' . $model->id . '/';
                        $fileName = str_replace(' ', '-', $model->poster_file->baseName) . '.' .
                            $model->poster_file->extension;
                        FileHelper::createDirectory($dir);
                        // Обновление пути к файлу постера в БД
                        $model->updateAttributes(['poster' => $dir . $fileName]);
                        // Сохранение файла постера на сервере
                        $model->poster_file->saveAs($dir . $fileName);
                    }
                    Yii::$app->getSession()->setFlash('success',
                        Yii::t('app', 'PROJECTS_ADMIN_PAGE_MESSAGE_CREATE_PROJECT'));

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
     * Updates an existing Project model.
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
            $file = UploadedFile::getInstance($model, 'poster_file');
            if ($file && $file->tempName) {
                $model->poster_file = $file;
                if ($model->validate(['poster_file'])) {
                    if ($model->poster !== null) {
                        // Определение директории где расположен файл постера
                        $pos = strrpos($model->poster, '/');
                        $dir = substr($model->poster, 0, $pos) . '/';
                        // Запоминание нового имя файла постера
                        $fileName = str_replace(' ', '-', $model->poster_file->baseName) . '.' .
                            $model->poster_file->extension;
                        // Удаление старого файла постера
                        unlink($model->poster);
                    } else {
                        // Формирование пути к файлу постера
                        $dir = Yii::getAlias('@webroot') . '/uploads/project-poster/';
                        $fileName = str_replace(' ', '-', $model->poster_file->baseName) . '.' .
                            $model->poster_file->extension;
                        $model->poster = $dir . $fileName;
                        // Создание новой директории для файла постера
                        $dir .= $model->id . '/';
                        FileHelper::createDirectory($dir);
                    }
                    // Сохранение нового файла постера
                    $model->poster_file->saveAs($dir . $fileName);
                    // Сохранение нового пути к файлу постера в БД
                    $model->updateAttributes(['poster' => $dir . $fileName]);
                }
            }
            Yii::$app->getSession()->setFlash('success',
                Yii::t('app', 'PROJECTS_ADMIN_PAGE_MESSAGE_UPDATED_PROJECT'));

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Project model.
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
        if ($model->poster !== null) {
            // Определение директории где расположен файл постера
            $pos = strrpos($model->poster, '/');
            $dir = substr($model->poster, 0, $pos);
            // Удаление файла постера и директории где она хранилась
            FileHelper::removeDirectory($dir);
        }
        $model->delete(); // Удалние записи из БД
        Yii::$app->getSession()->setFlash('success',
            Yii::t('app', 'PROJECTS_ADMIN_PAGE_MESSAGE_DELETED_PROJECT'));

        return $this->redirect(['list']);
    }

    /**
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne(['id' => $id])) !== null)
            return $model;

        throw new NotFoundHttpException(Yii::t('app', 'ERROR_MESSAGE_PAGE_NOT_FOUND'));
    }
}