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
use yii\data\ActiveDataProvider;

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
                'only' => ['create', 'update', 'index', 'delete', 'view', 'overview',
                        'add-own', 'edit-own', 'delete-own', 'add-doctor', 'edit-doctor', 
                        'delete-doctor', 'done', 'patient-reminders', 'check-sos', 'remove-sos'],
                'rules' => [
                    [
                        'actions' => [''],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['overview', 'add-own', 'edit-own', 'delete-own', 'done'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['check-sos', 'remove-sos', 'patient-reminders', 'add-doctor', 'edit-doctor', 'delete-doctor'],
                        'allow' => true,
                        'roles' => [
                            Role::find()->where(['name' => Role::DOCTOR])->one(),
                            Role::find()->where(['name' => Role::NURSE])->one()
                        ],
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
     * New action
     * Overview own alarms
     */
    public function actionOverview()
    {
        $user = \app\models\User::find()->where(["id" => Yii::$app->user->id])->one();
        
        $query = Alarm::find()->where(["for_id" => Yii::$app->user->id]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]],
            'pagination' => [
                'pageSize' => 8,
            ],
        ]);
        
        return $this->render('overview', [
            'dataProvider' => $dataProvider,
            'user' => $user
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
        
        $model->for_id = Yii::$app->user->id;
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
        $model = Alarm::find()->where(["id" => $id, "for_id" => Yii::$app->user->id, "from_id" => Yii::$app->user->id])->one();
        
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
     * Doctor create alarm for patient
     * @return mixed
     */
    public function actionAddDoctor($for_id)
    {
        $model = new Alarm();
        
        $model->for_id = $for_id;
        $model->from_id = Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['alarm/patient-reminders', 'id' => $for_id]);
        } else {
            return $this->renderAjax('add_doctor', [
                'model' => $model
            ]);
        }
    }
    
    /**
     * New action
     * Doctor edit alarm for patient
     * @return mixed
     */
    public function actionEditDoctor($id)
    {
        $model = Alarm::find()->where(["id" => $id])->one();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['alarm/patient-reminders', 'id' => $model->for_id]);
        } else {
            return $this->renderAjax('add_doctor', [
                'model' => $model
            ]);
        }
    }
    
    /**
     * Deletes an existing Alarm model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDeleteDoctor($id)
    {
        $model = Alarm::find()->where(["id" => $id])->one();
        
        if ($model) {
            $for_id = $model->for_id;
            $model->delete();
            return $this->redirect(['alarm/patient-reminders', 'id' => $for_id]);
        } else {
            $this->goBack();
        }
    }
    
    public function actionDone()
    {
        $this->layout=false;
        header('Content-type: application/json');
        
        $output["status"] = "no";
        
        $params = Yii::$app->request->post();
        
        if ($params['id']) {
            $alarm = Alarm::find()->where(["id" => $params['id'], "for_id" => Yii::$app->user->id])->one();
            if ($alarm) {
                $alarm->seen = 1;
                $saved = $alarm->save();
                if ($saved) {
                    $output["status"] = "yes";
                    $newAlarm = \app\models\Alarm::findUserAlarm();
                    if ($newAlarm) {
                        
                        if ($newAlarm->for_id == $newAlarm->from_id) {
                            $label = 'New reminder';
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
        
        echo \yii\helpers\Json::encode($output);
        exit();
    }
    
    public function actionCheckSos()
    {
        $this->layout=false;
        header('Content-type: application/json');
        $output = [];
        
        $sos = Alarm::find()->where([
                    "for_id" => \Yii::$app->user->id,
                    "seen" => 0,
                    "is_sos" => 1
                ])
                ->orderBy(["time" => SORT_DESC])
                ->one();
        if ($sos) {
            $output['status'] = "yes";
            $output['from_id'] = $sos->from_id;
            $output['sos'] = $sos->title;
            $output['patient'] = $sos->from->name;
            $output['time'] = $sos->time;
        } else {
            $output['status'] = 'no';
        }
        
        echo \yii\helpers\Json::encode($output);
        exit();
    }
    
    public function actionRemoveSos()
    {
        $this->layout=false;
        header('Content-type: application/json');
        $output = [];

        $params = Yii::$app->request->post();
        $from_id = $params["from_id"];
        
        $sosS = Alarm::find()->where([
                    "from_id" => $from_id,
                    "seen" => 0,
                    "is_sos" => 1
                ])
                ->all();
        if (count($sosS) > 0) {
            foreach ($sosS as $sos) {
                $sos->seen = 1;
                $sos->save();
            }
            $output['status'] = "yes";
        } else {
            $output['status'] = 'no';
        }
        
        echo \yii\helpers\Json::encode($output);
        exit();
    }
    
    /**
     * New action
     * Overview patient alarms
     */
    public function actionPatientReminders($id)
    {
        $user = \app\models\User::find()->where(["id" => $id])->one();
        
        $query = Alarm::find()->where(["for_id" => $id]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]],
            'pagination' => [
                'pageSize' => 8,
            ],
        ]);
        
        return $this->render('patient_reminders', [
            'dataProvider' => $dataProvider,
            'user' => $user
        ]);
    }
    
    /**
     * New action
     * Delete own measurement
     */
    public function actionDeleteOwn($id)
    {
        $model = Alarm::find()->where(["id" => $id, "from_id" => Yii::$app->user->id])->one();
        if ($model) {
            $model->delete();
            return $this->redirect(["alarm/overview"]);
        } else {
            return $this->goBack();
        }
    }
    
}
