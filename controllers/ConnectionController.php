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
use yii\data\ActiveDataProvider;

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
                'only' => ['create', 'update', 'index', 'delete', 'view', 'overview', 'remove-own', 'ajax-call', 'check-call', 'call-dismiss'],
                'rules' => [
                    [
                        'actions' => [''],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['add', 'overview', 'remove-own', 'communication', 'ajax-call', 'check-call', 'call-dismiss'],
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
        $query = \app\models\User::find()
                ->joinWith("connection")
                ->where(["connection.patient_id" => Yii::$app->user->id]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 8,
            ],
        ]);
        
        return $this->render('overview', [
            'dataProvider' => $dataProvider,
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
        $user_called = \app\models\User::find()->where(["id" => $id])->one();
        $call = \app\models\Call::find()->where(["called" => $id])->orderBy("id DESC")->one();
        
        if ($call !== null) {
            $user_caller = \app\models\User::find()->where(["id" => $call->caller])->one();
        } else {
            $user_caller = \app\models\User::find()->where(["id" => \Yii::$app->user->id])->one();
        }
        
        return $this->render('call', [
            'user_called' => $user_called,
            'user_caller' => $user_caller
        ]);
    }
    
    public function actionCallEnded($id, $dismissed=0) {
        //Make all calls missed from this caller
        $callsFinish = \app\models\Call::find()
                ->where(["called" => $id, "caller" => \Yii::$app->user->id, "status" => 0])
                ->all();
        foreach ($callsFinish as $cf) {
            $cf->status = 3;
            $cf->save();
        }
        
        $user_called = \app\models\User::find()->where(["id" => $id])->one();
        
        $call = \app\models\Call::find()->where(["called" => $id])->orderBy("id DESC")->one();
        
        if ($call !== null) {
            $user_caller = \app\models\User::find()->where(["id" => $call->caller])->one();
        } else {
            $user_caller = \app\models\User::find()->where(["id" => \Yii::$app->user->id])->one();
        }
                
        return $this->render('call_ended', [
            'user_called' => $user_called,
            'user_caller' => $user_caller,
            'dismissed' => $dismissed
        ]);
    }
    
    public function actionAjaxCall()
    {
        $this->layout=false;
        header('Content-type: application/json');
        $output = [];
        
        $params = Yii::$app->request->post();
        
        $output["status"] = "yes";
        
        if (\Yii::$app->user->id == $params["called"]) {//Means this is an answer
            $call = \app\models\Call::find()->where([
                    "called" => \Yii::$app->user->id,
                    "status" => 0
                ])
                ->orderBy(["start" => SORT_DESC])
                ->one();
            if ($call !== null) {
                $call->status = 1;
                $call->update();
                $output["status"] = "yes";
            }
        } else {//If caller
            if ($params["answer"] == 0) {
                $call = new \app\models\Call();
                $call->caller = $params['caller'];
                $call->called = $params['called'];
                $call->save();
                $output["status"] = "yes";
            }
        }
        
        echo \yii\helpers\Json::encode($output);
        exit();
    }
    
    public function actionAjaxCallStatus()
    {
        $this->layout=false;
        header('Content-type: application/json');
        $output = [];
        
        $params = Yii::$app->request->post();
        
        $call = \app\models\Call::find()->where([
                "called" => $params["called"],
                "caller" => \Yii::$app->user->id,
                "status" => 2
            ])
            ->andWhere('start > DATE_SUB(NOW(), INTERVAL 10 SECOND)')
            ->orderBy(["start" => SORT_DESC])
            ->one();
            if ($call !== null) {
                $output["status"] = "dismissed";
            } else {
                $output["status"] = "ok";
            }
        
        echo \yii\helpers\Json::encode($output);
        exit();
    }
    
    public function actionCheckCall()
    {
        $this->layout=false;
        header('Content-type: application/json');
        $output = [];
        
        $call = \app\models\Call::find()->where([
                    "called" => \Yii::$app->user->id,
                    "status" => 0
                ])
                ->orderBy(["start" => SORT_DESC])
                ->one();
        if ($call) {
            $output['call'] = 'yes';
            $output['caller'] = $call->caller0->name;
        } else {
            $output['call'] = 'no';
        }
        
        echo \yii\helpers\Json::encode($output);
        exit();
    }
    
    public function actionCallDismiss()
    {
        $this->layout=false;
        header('Content-type: application/json');
        $output = [];
        
        $calls = \app\models\Call::find()->where([
                    "called" => \Yii::$app->user->id,
                    "status" => 0
                ])
                ->all();

        foreach ($calls as $call) {
            $call->status = 2;
            $call->save();
        }
        
        $output['status'] = 'yes';
        
        echo \yii\helpers\Json::encode($output);
        exit();
    }
    
    /**
     * New action
     * Overview own connections
     */
    public function actionPatientCommunication($id)
    {
        $user = \app\models\User::find()->where(["id" => $id])->one();
        
        return $this->render('communication', [
            'user' => $user
        ]);
    }
    
}
