<?php

namespace app\controllers;

use Yii;
use app\models\Connection;
use app\models\ConnectionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\components\AccessRule;
use app\models\Role;

/**
 * ConnectionController implements the CRUD actions for Connection model.
 */
class ConnectionController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only' => ['create', 'update', 'index', 'delete', 'view', 'overview', 'remove-own'],
                'rules' => [
                    [
                        'actions' => [''],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['add', 'overview', 'remove-own', 'communication'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['create', 'update', 'index', 'delete', 'view'],
                        'allow' => true,
                        'roles' => [
                            Role::find()->where(['name' => Role::ADMINISTRATOR])->one()
                        ],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Connection models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ConnectionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Connection model.
     * @param string $user_id
     * @param string $patient_id
     * @return mixed
     */
    public function actionView($user_id, $patient_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($user_id, $patient_id),
        ]);
    }

    /**
     * Creates a new Connection model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Connection();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'patient_id' => $model->patient_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Connection model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $user_id
     * @param string $patient_id
     * @return mixed
     */
    public function actionUpdate($user_id, $patient_id)
    {
        $model = $this->findModel($user_id, $patient_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'patient_id' => $model->patient_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Connection model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $user_id
     * @param string $patient_id
     * @return mixed
     */
    public function actionDelete($user_id, $patient_id)
    {
        $this->findModel($user_id, $patient_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Connection model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $user_id
     * @param string $patient_id
     * @return Connection the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($user_id, $patient_id)
    {
        if (($model = Connection::findOne(['user_id' => $user_id, 'patient_id' => $patient_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
     * New action
     * Overview own connections
     */
    public function actionOverview()
    {
        $user = \app\models\User::find()->where(["id" => Yii::$app->user->id])->one();
        
        return $this->render('overview', [
            'user' => $user
        ]);
    }
    
    /**
     * New action
     * Remove own connection
     */
    public function actionRemoveOwn($user_id)
    {
        $connection = Connection::find()
                ->where(["patient_id" => Yii::$app->user->id, "user_id" => $user_id])
                ->one();
        
        if ($connection) {
            $connection->delete();
        }
        
        return $this->redirect(['connection/overview']);
    }
    
    /**
     * New action
     * Add connection to your own profile
     */
    public function actionAdd()
    {
        $model = new Connection();

        $model->patient_id = Yii::$app->user->id;
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['connection/overview']);
        } else {
            return $this->renderAjax('add', [
                'model' => $model,
            ]);
        }
    }
    
    /**
     * New action
     * Overview own connections
     */
    public function actionCommunication()
    {
        $user = \app\models\User::find()->where(["id" => Yii::$app->user->id])->one();
        
        return $this->render('communication', [
            'user' => $user
        ]);
    }
    
    public function actionCall($id) {
        $user = \app\models\User::find()->where(["id" => Yii::$app->user->id])->one();
        
        return $this->render('call', [
            'user' => $user
        ]);
    }
    
}
