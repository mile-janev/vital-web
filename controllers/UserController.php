<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\components\AccessRule;
use app\models\Role;
use app\models\UserEditForm;
use yii\helpers\Url;
use app\models\Logs;
use app\models\Sign;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only' => ['create', 'update', 'index', 'delete', 'edit', 'resetpassword', 'patients', 'view', 'view-own', 'patient-dashboard', 'sos'],
                'rules' => [
                    [
                        'actions' => ['resetpassword'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['edit', 'view-own'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['sos'],
                        'allow' => true,
                        'roles' => [
                            Role::find()->where(['name' => Role::PATIENT])->one()
                        ],
                    ],
                    [
                        'actions' => ['patients', 'patient-dashboard'],
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
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Lists all Patients for given doctor/nurse.
     * @return mixed
     */
    public function actionPatients()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $user = User::find()->where(['id' => \Yii::$app->user->id])->one();
        
        return $this->render('patients', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionViewOwn()
    {
        return $this->render('view_own', [
            'model' => $this->findModel(Yii::$app->user->id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
     public function actionCreate()
    {
        $user = new User();

        $editForm = new UserEditForm();

        if ($editForm->load(Yii::$app->request->post())) {
            if ($user = $editForm->createUser()) {
                return $this->redirect(Url::toRoute(['user/view', 'id' => $user->id]));
            }
            return $this->goHome();
        }

        $editForm->setAttributes($user->toArray(), false);

        return $this->render('create', [
            'model' => $editForm,
            'user' => $user
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $user = User::find()->where(['id' => $id])->one();

        $editForm = new UserEditForm();
        
        if ($editForm->load(Yii::$app->request->post())) {
            if ($user = $editForm->updateMe()) {
                return $this->redirect(Url::toRoute(['user/view', 'id' => $user->id]));
            }
            return $this->goHome();
        }

        $editForm->setAttributes($user->toArray(), false);
        $editForm->password = "";
        
        return $this->render('update', [
            'model' => $editForm,
            'user' => $user
        ]);
    }
    
    /**
     * Edit current user profile
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionEdit()
    {
        $id = Yii::$app->user->id;
        $user = User::find()->where(['id' => $id])->one();

        $editForm = new UserEditForm();

        if ($editForm->load(Yii::$app->request->post())) {
            $editForm->role_id = $user->role_id;
            if ($user = $editForm->updateMe(TRUE)) {
                Yii::$app->session->setFlash('profile_updated', 'Profile updated.');
                return $this->redirect(Url::toRoute('user/edit'));
            } else {
                return $this->goHome();
            }
        }

        $editForm->setAttributes($user->toArray(), false);
        $editForm->password = "";

        return $this->render('edit', [
            'model' => $editForm,
            'user' => $user
        ]);
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionResetpassword()
    {
        $getValues = Yii::$app->request->get();
        $postValues = Yii::$app->request->post();
        
        if (!empty($postValues)) {
            $token = $getValues['token'];
            $model = User::find()->where(["reset_token" => $token])->one();
            $model->password = $postValues['User']['password'];
            $model->password_confirm = $postValues['User']['password_confirm'];
            $model->reset_token = "";
            $passwordUpdated = $model->update();
            
            if ($passwordUpdated) {
                Yii::$app->session->setFlash('password_changed', 'Password is changed. You can login now with your new password.');
            } else {
                Yii::$app->session->setFlash('password_changed', 'Error. Please contact the administrator.');
            }
            
            return $this->redirect(['site/login']);
            
        } else if (empty($postValues) && !empty($getValues) && isset($getValues['token']) && trim($getValues['token']) != '') {
            $token = $getValues['token'];
            $model = User::find()
                    ->where(["reset_token" => $token])
                    ->andWhere('updated_at > DATE_SUB(NOW(), INTERVAL 24 HOUR)')
                    ->one();
            if ($model) {
                $model->password = "";
                return $this->render('resetpassword', [
                    'model' => $model,
                ]);
            } else {
                Yii::$app->session->setFlash('token_sent', 'Token is expired or invalid. Try again.');
                return $this->redirect(['site/password-forget']);
            }
        } else {
            return $this->redirect(['site/password-forget']);
        }        
    }
    
    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionPatientDashboard($id)
    {
        $model = $this->findModel($id);
        
        $user = User::find()->where(["id" => $id])->one();
        
        //Log Heart start
        $logsHeart = Logs::find()
                ->where(['sign' => "heart_rate", 'user_id' => $id])
                ->orderBy("created_at DESC")
                ->limit(30)
                ->all();
        $chartHeart = [
            'cols' => [
                0 => ['id' => 'Time', 'label' => 'Time', 'type' => 'string'],
                1 => ['id' => 'Log', 'label' => '', 'type' => 'number'],
            ]
        ];
        for($i = 0; $i<count($logsHeart); $i++){
            $chartDate = date("m/d/Y H:i", strtotime($logsHeart[$i]->created_at));
            $chartHeart['rows'][$i]['c'] = [
                ['v' => $chartDate], 
                ['v' => (int)$logsHeart[$i]->value]
            ];
        }
        $signHeartModel = Sign::find()->where(["alias" => "heart_rate"])->one();
        //Log Heart end
       
        // Log Pressure
        $logsPressure = Logs::find()
                ->where(['sign' => "blood_pressure", 'user_id' => $id])
                ->orderBy("created_at DESC")
                ->limit(30)
                ->all();
        
        $lpData = [];
        foreach ($logsPressure as $key => $lp) {
            $lpArr = explode("/", $lp->value);
            $lpData[$key]['date'] = date("m/d/Y H:i", strtotime($lp->created_at));
            $lpData[$key]['systolic'] = $lpArr[0];
            $lpData[$key]['diastolic'] = isset($lpArr[1]) ? $lpArr[1] : 0;
        }
        
        $chartPressure = [
            'cols' => [
                0 => ['id' => 'Time', 'label' => 'Time', 'type' => 'string'],
                1 => ['id' => 'Systolic', 'label' => 'Systolic', 'type' => 'number'],
                2 => ['id' => 'Diastolic', 'label' => 'Diastolic', 'type' => 'number'],
            ]
        ];
        for($i = 0; $i<count($lpData); $i++){
            $chartPressure['rows'][$i]['c'] = [
                ['v' => $lpData[$i]['date']], 
                ['v' => (int)$lpData[$i]['systolic']],
                ['v' => (int)$lpData[$i]['diastolic']]
            ];
        }
        $signPressureModel = Sign::find()->where(["alias" => "blood_pressure"])->one();
        //Log Blood Pressure end
        
        //Log Temperature start
        $logsTemp = Logs::find()
                ->where(['sign' => "temperature", 'user_id' => $id])
                ->orderBy("created_at DESC")
                ->limit(30)
                ->all();
        $chartTemp = [
            'cols' => [
                0 => ['id' => 'Time', 'label' => 'Time', 'type' => 'string'],
                1 => ['id' => 'Log', 'label' => '', 'type' => 'number'],
            ]
        ];
        for($i = 0; $i<count($logsTemp); $i++){
            $chartDate = date("m/d/Y H:i", strtotime($logsTemp[$i]->created_at));
            $chartTemp['rows'][$i]['c'] = [
                ['v' => $chartDate], 
                ['v' => (int)$logsTemp[$i]->value]
            ];
        }
        $signTempModel = Sign::find()->where(["alias" => "temperature"])->one();
        //Log Temperature end
       
        // Log Respiratory
        $logsRespiratory = Logs::find()
                ->where(['sign' => "respiratory_rate", 'user_id' => $id])
                ->orderBy("created_at DESC")
                ->limit(30)
                ->all();
        $chartRespiratory = [
            'cols' => [
                0 => ['id' => 'Time', 'label' => 'Time', 'type' => 'string'],
                1 => ['id' => 'Log', 'label' => '', 'type' => 'number'],
            ]
        ];
        for($i = 0; $i<count($logsRespiratory); $i++){
            $chartDate = date("m/d/Y H:i", strtotime($logsRespiratory[$i]->created_at));
            $chartRespiratory['rows'][$i]['c'] = [
                ['v' => $chartDate], 
                ['v' => (int)$logsRespiratory[$i]->value]
            ];
        }
        $signRespiratoryModel = Sign::find()->where(["alias" => "respiratory_rate"])->one();
        // end Respiratory
        
        // Log Weight
        $logsWeight = Logs::find()
                ->where(['sign' => "weight", 'user_id' => $id])
                ->orderBy("created_at DESC")
                ->limit(30)
                ->all();
        $chartWeight = [
            'cols' => [
                0 => ['id' => 'Time', 'label' => 'Time', 'type' => 'string'],
                1 => ['id' => 'Log', 'label' => '', 'type' => 'number'],
            ]
        ];
        for($i = 0; $i<count($logsWeight); $i++){
            $chartDate = date("m/d/Y H:i", strtotime($logsWeight[$i]->created_at));
            $chartWeight['rows'][$i]['c'] = [
                ['v' => $chartDate], 
                ['v' => (int)$logsWeight[$i]->value]
            ];
        }
        $signWeightModel = Sign::find()->where(["alias" => "weight"])->one();
        // end Weight
        
        return $this->render('patient_dashboard', [
            "chartHeart" => $chartHeart,
            "signHeartModel" => $signHeartModel,
            "chartTemp" => $chartTemp,
            "signTempModel" => $signTempModel,
            "chartPressure" => $chartPressure,
            "signPressureModel" => $signPressureModel,
            "chartRespiratory" => $chartRespiratory,
            "signRespiratoryModel" => $signRespiratoryModel,
            "chartWeight" => $chartWeight,
            "signWeightModel" => $signWeightModel,
            "user" => $user,
            "model" => $model
        ]);
    }
    
    public function actionSos()
    {
        $this->layout=false;
        header('Content-type: application/json');
        $output = [];
        
        $user = User::find()->where(["id" => Yii::$app->user->id])->one();
        $output["status"] = "yes";
        
        foreach ($user->patientConnection as $usrConn) {
            if ($usrConn->user->role->name == Role::DOCTOR || $usrConn->user->role->name == Role::NURSE) {
                $alarm = new \app\models\Alarm();
                $alarm->title = "SOS from " . $user->name;
                $alarm->is_sos = 1;
                $alarm->time = date("Y-m-d H:i:s", time());
                $alarm->from_id = Yii::$app->user->id;
                $alarm->for_id = $usrConn->user->id;
                $alarm->save();
            }
        }
        
        echo \yii\helpers\Json::encode($output);
        exit();
    }
    
}
