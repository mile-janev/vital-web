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
                'only' => ['create', 'update', 'index', 'delete', 'edit', 'resetpassword', 'patients', 'patient', 'view', 'patient-dashboard'],
                'rules' => [
                    [
                        'actions' => ['resetpassword'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['edit', 'patients', 'patient'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['patient-dashboard'],
                        'allow' => true,
                        'roles' => [
                            Role::find()->where(['name' => Role::DOCTOR])->one(),
                            Role::find()->where(['name' => Role::NURSE])->one()
                        ],
                    ],
                    [
                        'actions' => ['create', 'update', 'index', 'delete', 'edit', 'view'],
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
//        var_dump($dataProvider->getModels());
//        var_dump($user->connection);
//        exit();
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
    public function actionPatient($id)
    {
        $model = $this->findModel($id);
        
        $heartRate = Logs::find()
                ->where(["sign" => "heart_rate", "user_id" => $id])
                ->orderBy("created_at DESC")
                ->limit(3)
                ->all();
        $blodPressure = Logs::find()
                ->where(["sign" => "blod_pressure", "user_id" => $id])
                ->orderBy("created_at DESC")
                ->limit(3)
                ->all();
        $temperature = Logs::find()
                ->where(["sign" => "temperature", "user_id" => $id])
                ->orderBy("created_at DESC")
                ->limit(3)
                ->all();
        $weight = Logs::find()
                ->where(["sign" => "weight", "user_id" => $id])
                ->orderBy("created_at DESC")
                ->limit(3)
                ->all();
        
        $alarms = \app\models\Alarm::find()
                ->where(["patient_id" => $id])
                ->andWhere("time > NOW()")
                ->orderBy("time ASC")
                ->all();
        
        return $this->render('patient', [
            'model' => $model,
            'heartRate' => $heartRate,
            'blodPressure' => $blodPressure,
            'temperature' => $temperature,
            'weight' => $weight,
            'alarms' => $alarms
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
        
        $heartRate = Logs::find()
                ->where(["sign" => "heart_rate", "user_id" => $id])
                ->orderBy("created_at DESC")
                ->limit(3)
                ->all();
        $blodPressure = Logs::find()
                ->where(["sign" => "blod_pressure", "user_id" => $id])
                ->orderBy("created_at DESC")
                ->limit(3)
                ->all();
        $temperature = Logs::find()
                ->where(["sign" => "temperature", "user_id" => $id])
                ->orderBy("created_at DESC")
                ->limit(3)
                ->all();
        $weight = Logs::find()
                ->where(["sign" => "weight", "user_id" => $id])
                ->orderBy("created_at DESC")
                ->limit(3)
                ->all();
        
        $alarms = \app\models\Alarm::find()
                ->where(["patient_id" => $id])
                ->andWhere("time > NOW()")
                ->orderBy("time ASC")
                ->all();
        
        
        
//        ----------------------------
        
        $user = User::find()->where(["id" => $id])->one();
        
        //Log Heart start
        $logsHeart = Logs::find()
                ->where(['sign' => "heart_rate", 'user_id' => $id])
                ->orderBy("created_at DESC")
                ->limit(8)
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
        
        //Log Temperature start
        $logsTemp = Logs::find()
                ->where(['sign' => "temperature", 'user_id' => $id])
                ->orderBy("created_at DESC")
                ->limit(8)
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
        
        return $this->render('patient_dashboard', [
            "chartHeart" => $chartHeart,
            "signHeartModel" => $signHeartModel,
            "chartTemp" => $chartTemp,
            "signTempModel" => $signTempModel,
            "user" => $user,
            
            'model' => $model,
            'heartRate' => $heartRate,
            'blodPressure' => $blodPressure,
            'temperature' => $temperature,
            'weight' => $weight,
            'alarms' => $alarms
        ]);
    }
    
}
