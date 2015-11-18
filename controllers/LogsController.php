<?php

namespace app\controllers;

use Yii;
use app\models\Logs;
use app\models\LogsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Sign;
use yii\filters\AccessControl;
use app\components\AccessRule;
use app\models\Role;
use yii\data\ActiveDataProvider;

/**
 * LogsController implements the CRUD actions for Logs model.
 */
class LogsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only' => ['create', 'update', 'index', 'delete', 'add', 'detail', 'view', 'add-data', 'overview', 'log', 'view-data-text', 'view-data-chart', 'edit', 'delete-own'],
                'rules' => [
                    [
                        'actions' => [''],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['add', 'detail', 'add-data', 'overview', 'log', 'view-data-text', 'view-data-chart', 'edit', 'delete-own'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['add'],
                        'allow' => true,
                        'roles' => [
                            Role::find()->where(['name' => Role::DOCTOR])->one(),
                            Role::find()->where(['name' => Role::NURSE])->one()
                        ],
                    ],
                    [
                        'actions' => ['create', 'update', 'index', 'delete', 'add', 'detail', 'view'],
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
            return $this->renderAjax('create', [
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

        return $this->goBack();
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
    
    /*
     * New action
     * Add own Data links
     */
    public function actionAddData()
    {
        return $this->render('add_data');
    }
    
    /**
     * New action
     * Log own data.
     */
    public function actionLog($sign)
    {
        $model = new Logs();
        $user_id = Yii::$app->user->id;
        
        $signModel = Sign::find()->where(["alias" => $sign])->one();
        
        $user = \app\models\User::find()->where(["id" => $user_id])->one();
        $model->user_id = $user_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-data-text', 'sign' => $sign]);
        } else {
            return $this->renderAjax('log', [
                'model' => $model,
                'sign' => $sign,
                'signModel' => $signModel,
                'user' => $user
            ]);
        }
    }
    
    /*
     * New action
     * Overview own signs links
     */
    public function actionOverview()
    {
        return $this->render('overview');
    }
    
    /**
     * New action
     * View own log for some sign in text format
     */
    public function actionViewDataText($sign)
    {
        $user_id = Yii::$app->user->id;
        
        $user = \app\models\User::find()->where(["id" => $user_id])->one();
        
        $signModel = Sign::find()->where(["alias" => $sign])->one();
        
        $query = Logs::find()
                ->where(['sign' => $sign, 'user_id' => $user_id])
                ->orderBy("created_at DESC");
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]],
            'pagination' => [
                'pageSize' => 8,
            ],
        ]);
        
        //Only for detail view for vital sign
        return $this->render('view_data_text', [
            'sign' => $sign,
            'dataProvider' => $dataProvider,
            'signModel' => $signModel,
            'user' => $user
        ]);
    }
    
    /**
     * New action
     * View own log for some sign in chart
     */
    public function actionViewDataChart($sign)
    {
        $user_id = Yii::$app->user->id;
        
        $logs = Logs::find()
                ->where(['sign' => $sign, 'user_id' => $user_id])
                ->orderBy("created_at DESC")
                ->limit(30)
                ->all();
        
        $signModel = Sign::find()->where(["alias" => $sign])->one();
        
        $user = \app\models\User::find()->where(["id" => $user_id])->one();
        
        //Data Formating for chart
        if ($sign == "blood_pressure") {
            $lines = 2;
            $lpData = [];
            foreach ($logs as $key => $lp) {
                $lpArr = explode("/", $lp->value);
                $lpData[$key]['date'] = date("m/d/Y H:i", strtotime($lp->created_at));
                $lpData[$key]['systolic'] = $lpArr[0];
                $lpData[$key]['diastolic'] = isset($lpArr[1]) ? $lpArr[1] : 0;
            }
            $chart = [
                'cols' => [
                    0 => ['id' => 'Time', 'label' => 'Time', 'type' => 'string'],
                    1 => ['id' => 'Systolic', 'label' => 'Systolic', 'type' => 'number'],
                    2 => ['id' => 'Diastolic', 'label' => 'Diastolic', 'type' => 'number'],
                ]
            ];
            for($i = 0; $i<count($lpData); $i++){
                $chart['rows'][$i]['c'] = [
                    ['v' => $lpData[$i]['date']], 
                    ['v' => (int)$lpData[$i]['systolic']],
                    ['v' => (int)$lpData[$i]['diastolic']]
                ];
            }
        } else {
            $lines = 1;
            $chart = [
                'cols' => [
                    0 => ['id' => 'Time', 'label' => 'Time', 'type' => 'string'],
                    1 => ['id' => 'Log', 'label' => '', 'type' => 'number'],
                ]
            ];
            for($i = 0; $i<count($logs); $i++){
                $chartDate = date("m/d/Y H:i", strtotime($logs[$i]->created_at));
                $chart['rows'][$i]['c'] = [
                    ['v' => $chartDate], 
                    ['v' => (int)$logs[$i]->value]
                ];
            }
        }
        
        //Only for detail view for vital sign
        return $this->render('view_data_chart', [
            'sign' => $sign,
            'logs' => $logs,
            'signModel' => $signModel,
            'chart' => $chart,
            'user' => $user,
            'lines' => $lines
        ]);
    }
    
    /**
     * New action
     * Edit own measurement
     */
    public function actionEdit($id)
    {
        $model = Logs::find()->where(["id" => $id, "user_id" => Yii::$app->user->id])->one();
        $user = \app\models\User::find()->where(["id" => Yii::$app->user->id])->one();
        
        if ($model) {//Prevent updating other people logs
            $signModel = Sign::find()->where(["alias" => $model->sign])->one();
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(["logs/view-data-text", "sign" => $model->sign]);
            } else {
                return $this->renderAjax('edit', [
                    'model' => $model,
                    'signModel' => $signModel,
                    'user' => $user
                ]);
            }
        } else {
            return $this->goBack();
        }
    }
    
    /**
     * New action
     * Delete own measurement
     */
    public function actionDeleteOwn($id)
    {
        $model = Logs::find()->where(["id" => $id, "user_id" => Yii::$app->user->id])->one();
        if ($model) {
            $this->findModel($id)->delete();
            return $this->redirect(["logs/view-data-text", "sign" => $model->sign]);
        } else {
            return $this->goBack();
        }
    }
    
}
