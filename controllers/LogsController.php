<?php

namespace app\controllers;

use Yii;
use app\models\Logs;
use app\models\LogsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Sign;

/**
 * LogsController implements the CRUD actions for Logs model.
 */
class LogsController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Logs models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LogsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Logs model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Logs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Logs();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Logs model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Logs model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Logs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Logs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Logs::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
     * Displays a single Sign model.
     * @param string $id
     * @return mixed
     */
    public function actionDetail($sign, $user_id)
    {
        $logs = Logs::find()
                ->where(['sign' => $sign, 'user_id' => $user_id])
                ->orderBy("created_at DESC")
                ->all();
        
        $signModel = Sign::find()->where(["alias" => $sign])->one();
        
        $user = \app\models\User::find()->where(["id" => $user_id])->one();
        
        //Only for detail view for vital sign
        return $this->render('detail', [
            'sign' => $sign,
            'user_id' => $user_id,
            'logs' => $logs,
            'signModel' => $signModel,
            'user' => $user
        ]);
    }
    
    public function actionAdd($sign, $user_id)
    {
        $model = new Logs();
        
        $signModel = Sign::find()->where(["alias" => $sign])->one();
        
        $user = \app\models\User::find()->where(["id" => $user_id])->one();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['detail', 'sign' => $sign, 'user_id' => $user_id]);
        } else {
            return $this->render('add', [
                'model' => $model,
                'sign' => $sign,
                'user_id' => $user_id,
                'signModel' => $signModel,
                'user' => $user
            ]);
        }
    }
}
