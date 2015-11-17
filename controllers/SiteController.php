<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\PasswordResetForm;
use app\models\User;
use yii\filters\AccessControl;
use app\components\AccessRule;
use app\models\Role;
use app\models\Logs;
use app\components\Functions;
use app\models\UserSearch;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only' => ['login', 'logout', 'register', 'password-forget'],
                'rules' => [
                    [
                        'actions' => ['login', 'register', 'password-forget'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => [''],
                        'allow' => true,
                        'roles' => [
                            Role::find()->where(['name' => Role::ADMINISTRATOR])->one()
                        ],
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return $this->goBack();
            } else {
                return $this->render('index', [
                    'model' => $model,
                ]);
            }
            
        } else {
        
            if(Functions::isRole(Role::DOCTOR) || Functions::isRole(Role::NURSE)) {
                $searchModel = new UserSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $user = User::find()->where(['id' => \Yii::$app->user->id])->one();

                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            } else {
                return $this->render('index', [

                ]);
            }
            
        }
    }

    public function actionIndexOld()
    {
        if (!\Yii::$app->user->isGuest) {
            $id = \Yii::$app->user->id;
            
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
        } else {
            $heartRate = [];
            $blodPressure = [];
            $temperature = [];
            $weight = [];
            $alarms = [];
            $user = false;
        }
        
        return $this->render('index_old', [
            'heartRate' => $heartRate,
            'blodPressure' => $blodPressure,
            'temperature' => $temperature,
            'weight' => $weight,
            'alarms' => $alarms,
        ]);
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionRegister()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionPrivacy()
    {
        return $this->render('privacy');
    }
    
    public function actionPasswordForget()
    {
        $model = new PasswordResetForm();
        
        if ($model->load(Yii::$app->request->post())) {
            $model->reset();
        }
        
        return $this->render('password-forget', [
            'model' => $model,
        ]);
    }
}
