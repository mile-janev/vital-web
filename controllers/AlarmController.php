<?php

namespace app\controllers;

use Yii;
use app\models\Alarm;
use app\models\AlarmSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use yii\filters\AccessControl;
use app\components\AccessRule;
use app\models\Role;

/**
 * AlarmController implements the CRUD actions for Alarm model.
 */
class AlarmController extends Controller
{
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only' => ['create', 'update', 'index', 'delete', 'add', 'change', 'view', 'overview', 'add-own', 'done'],
                'rules' => [
                    [
                        'actions' => [''],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['add', 'overview', 'add-own', 'done'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['add', 'change'],
                        'allow' => true,
                        'roles' => [
                            Role::find()->where(['name' => Role::DOCTOR])->one(),
                            Role::find()->where(['name' => Role::NURSE])->one()
                        ],
                    ],
                    [
                        'actions' => ['create', 'update', 'index', 'delete', 'add', 'change', 'view'],
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
     * Lists all Alarm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AlarmSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Alarm model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Alarm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Alarm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Alarm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
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
     * Deletes an existing Alarm model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Alarm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Alarm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Alarm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
     * Creates a new Alarm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAdd()
    {
        $model = new Alarm();
        
        $params = Yii::$app->request->get();
        
        $patient = User::find()->where(["id" => $params["patient_id"]])->one();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['user/patient', 'id' => $params["patient_id"]]);
        } else {
            return $this->render('add_change', [
                'model' => $model,
                'patient' => $patient,
            ]);
        }
    }
    
    /**
     * Updates an existing Alarm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionChange($id)
    {
        $model = $this->findModel($id);
        
        $patient = User::find()->where(["id" => $model->patient_id])->one();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['user/patient', 'id' => $model->patient_id]);
        } else {
            return $this->render('add_change', [
                'model' => $model,
                'patient' => $patient,
            ]);
        }
    }
    
    /**
     * New action
     * Overview own alarms
     */
    public function actionOverview()
    {
        $models = Alarm::find()
                ->where(["patient_id" => Yii::$app->user->id])
                ->orderBy("created_at DESC")
                ->limit(8)
                ->all();
        $user = \app\models\User::find()->where(["id" => Yii::$app->user->id])->one();
        
        return $this->render('overview', [
            'user' => $user,
            'models' => $models,
        ]);
    }
    
    /**
     * New action
     * Create own alarm
     * @return mixed
     */
    public function actionAddOwn()
    {
        $model = new Alarm();
        
        $model->patient_id = Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['alarm/overview']);
        } else {
            return $this->renderAjax('add_own', [
                'model' => $model
            ]);
        }
    }
    
    /**
     * New action
     * Edit own alarm
     * @return mixed
     */
    public function actionEditOwn($id)
    {
        $model = Alarm::find()->where(["id" => $id, "patient_id" => Yii::$app->user->id])->one();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['alarm/overview']);
        } else {
            return $this->renderAjax('add_own', [
                'model' => $model
            ]);
        }
    }
    
    public function actionDone()
    {
        $this->layout=false;
        header('Content-type: application/json');
        
        $output["status"] = "no";
        
        $params = Yii::$app->request->post();
        
        if ($params['id']) {
            $alarm = Alarm::find()->where(["id" => $params['id'], "patient_id" => Yii::$app->user->id])->one();
            if ($alarm) {
                $alarm->seen = 1;
                $saved = $alarm->save();
                if ($saved) {
                    $output["status"] = "yes";
                    $newAlarm = \app\models\Alarm::findUserAlarm();
                    if ($newAlarm) {
                        
                        if ($newAlarm->patient_id == $newAlarm->from_id) {
                            $label = 'New own reminder';
                        } else {
                            $label = "New message from " . $newAlarm->from->role->description . " " . $newAlarm->from->name;
                        }
                        $output['new_label'] = $label;
                        $output['new_content'] = $newAlarm->title;
                        $output['new_id'] = $newAlarm->id;
                    } else {
                        $output['new'] = 'no';
                    }
                }
            }
        }
//        var_dump($params);
//        exit();
        
        echo \yii\helpers\Json::encode($output);
        exit();
    }
    
}
