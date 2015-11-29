<?php
namespace app\controllers;

use Yii;
use app\models\Medication;
use app\models\MedicationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use yii\filters\AccessControl;
use app\components\AccessRule;
use app\models\Role;
use yii\data\ActiveDataProvider;

/**
 * MedicationController implements the CRUD actions for Medication model.
 */
class MedicationController extends Controller
{
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only' => ['create', 'update', 'index', 'delete', 'delete-doctor', 'add', 'edit', 'view', 'overview'],
                'rules' => [
                    [
                        'actions' => [''],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['add', 'overview'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['add', 'edit', 'delete-doctor'],
                        'allow' => true,
                        'roles' => [
                            Role::find()->where(['name' => Role::DOCTOR])->one(),
                            Role::find()->where(['name' => Role::NURSE])->one()
                        ],
                    ],
                    [
                        'actions' => ['create', 'update', 'index', 'delete', 'add', 'edit', 'view'],
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
     * Lists all Medication models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MedicationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Medication model.
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
     * Creates a new Medication model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Medication();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Medication model.
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
     * Deletes an existing Medication model.
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
     * Finds the Medication model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Medication the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Medication::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
     * Creates a new Medication model.
     * @return mixed
     */
    public function actionAdd($id)
    {
        $model = new Medication();

        if ($model->load(Yii::$app->request->post())) {
            $model->patient_id = $id;
            $model->prescribed_by_id = \Yii::$app->user->id;
            $modelSaved = $model->save();
            return $this->redirect(['medication/patient-history', 'id' => $id]);
        } else {
            return $this->renderAjax('add', [
                'model' => $model
            ]);
        }
    }
    
    /**
     * Updates a new Medication model.
     * @return mixed
     */
    public function actionEdit($id)
    {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['medication/patient-history', 'id' => $model->patient_id]);
        } else {
            return $this->renderAjax('add', [
                'model' => $model
            ]);
        }
    }
    
    /**
     * New action
     * Overview own medications
     */
    public function actionOverview()
    {
        $query = Medication::find()->where(["patient_id" => Yii::$app->user->id]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]],
            'pagination' => [
                'pageSize' => 8,
            ],
        ]);
        
        $user = \app\models\User::find()->where(["id" => Yii::$app->user->id])->one();
        
        return $this->render('overview', [
            'dataProvider' => $dataProvider,
            'user' => $user
        ]);
    }
    
    public function actionPatientHistory($id)
    {
        $user = User::find()->where(["id" => $id])->one();
        
        $query = Medication::find()->where(["patient_id" => $id]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]],
            'pagination' => [
                'pageSize' => 8,
            ],
        ]);
        
        return $this->render('patient_history', [
            'dataProvider' => $dataProvider,
            'user' => $user
        ]);
    }
    
    /**
     * Deletes an existing Medication model.
     * If deletion is successful, the browser will be redirected to the 'patient-dashboard' page.
     * @param string $id
     * @return mixed
     */
    public function actionDeleteDoctor($id)
    {
        $model = Medication::find()->where(["prescribed_by_id" => Yii::$app->user->id, "id" => $id])->one();

        if ($model) {
            $patient_id = $model->patient_id;
            $model->delete();
            return $this->redirect(["medication/patient-history", "id" => $patient_id]);
        } else {
            return $this->goBack();
        }
    }
    
}
