<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\Functions;
use yii\filters\AccessControl;
use app\components\AccessRule;
use app\models\Role;
use app\models\UserEditForm;
use yii\helpers\Url;

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
                'only' => ['create', 'update', 'index', 'delete', 'view', 'edit'],
                'rules' => [
                    [
                        'actions' => [''],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['edit'],
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
                return $this->redirect(Url::toRoute('user/edit'));
            }
            return $this->goHome();
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
}
