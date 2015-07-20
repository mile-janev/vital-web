<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $role_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $auth_key
 * @property string $reset_token
 *
 * @property Logs[] $logs
 * @property Role $role
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{    
    
    public $password_confirm;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password', 'password_confirm'], 'required'],
            [['role_id'], 'integer'],
            [['image', 'created_at', 'updated_at', 'last_login'], 'safe'],
            [['password', 'password_confirm', 'name', 'email'], 'string', 'max' => 128],
            [['image'], 'string', 'max' => 255],
            [['password'], 'string', 'min' => 6],
            [['auth_key', 'reset_token'], 'string', 'max' => 32],
            [['email'], 'email'],
            [['email'], 'unique'],
            ['password_confirm', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'password_confirm' => 'Confirm password',
            'role_id' => 'Role ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'last_login' => 'Last Login',
            'auth_key' => 'Auth Key',
            'reset_token' => 'Reset Token',
            'image' => 'Image',
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
               'class' => TimestampBehavior::className(),
               'createdAtAttribute' => 'created_at',
               'updatedAtAttribute' => 'updated_at',
               'value' => new Expression('NOW()'),
           ],
       ];
    }
    
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
    
    /**
     * Before save hook
     */
    public function beforeSave($insert) {

        // If the password is NOT a hash, then we generate a hash to save it. 
        // This happens when a new user is created or when the user changes their password, in all other cases
        // it's just user data that is changing, so we don't need to redo all this as the password is already hashed.
        if (!preg_match('/^\$2[axy]\$(\d\d)\$[\.\/0-9A-Za-z]{22}/', $this->password, $matches)) {
            $this->setPassword($this->password);
        }

        Yii::info('USER INSERT: '.print_r($insert, true));

        return parent::beforeSave($insert);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogs()
    {
        return $this->hasMany(Logs::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'role_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedications()
    {
        return $this->hasMany(Medication::className(), ['patient_id' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConnection()
    {
        return $this->hasMany(Connection::className(), ['user_id' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatientConnection()
    {
        return $this->hasMany(Connection::className(), ['patient_id' => 'id']);
    }
    
    /**
     * Finds user by email
     *
     * @param  string      $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }
    
    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
    
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }
    
    /**
     * Get the user last login date
     */
    public function getLastLoginTime()
    {
        return ($this->last_login) ? date('g:i A', strtotime($this->last_login)) : "";
    }
    
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    
    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            if (!$this->hasErrors('email')) {
                $role_id = Role::getRoleID(Role::VISITOR);
                $this->role_id = $role_id;
                $this->generateAuthKey();
                
                if ($this->save()) {
                    return $this;
                } else {
                    return NULL;
                }
            }
        }
        
        return null;
    }
    
    /**
     * Finds user by role or roles array
     *
     * @param string/array $role
     * @return array of users from given role/s
     */
    public static function findByRole($role)
    {
        if (is_array($role)) {
            $roles = Role::find()->where(['IN', 'name', $role])->all();
            $rolesArray = \yii\helpers\ArrayHelper::map($roles, 'id', 'id');
            $users = self::find()->where(['IN', 'role_id', $rolesArray])->all();
        } else {
            $role = Role::find()->where(['name' => $role])->one();
            $users = self::find()->where(['role_id' => $role->id])->all();
        }
        
        
        return $users;
    }
    
    public static function patientDoctorNurse($patient_id, $dn_id)
    {
        $isDN = FALSE;
        
        $con = Connection::find()->where(["user_id" => $dn_id, "patient_id" => $patient_id])->one();

        if ($con && ($con->user->role->name == Role::DOCTOR || $con->user->role->name == Role::NURSE)) {
            $isDN = TRUE;
        }
        
        return $isDN;
    }
}
