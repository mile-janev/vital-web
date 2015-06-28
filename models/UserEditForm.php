<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;
use yii\imagine\Image;

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
class UserEditForm extends Model
{    
    
    public $id;
    public $email;
    public $name;
    public $password;
    public $password_confirm;
    public $role_id;
    public $image = NULL;

    private $user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'role_id'], 'required'],
            [['id', 'role_id'], 'integer'],
            [['auth_key', 'reset_token'], 'string', 'max' => 32],
            [['image'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['email'], 'unique'],
            [['password', 'password_confirm'], 'required', 'when' => function($model) {
                return $model->password != '';
            }, 'whenClient' => "function (attribute, value) {
                    return $('#usereditform-password').val() != '';
                }"
            ],
            ['password_confirm', 'compare', 'compareAttribute' => 'password']
        ];
    }

    public function updateMe($ownProfile=FALSE)
    {
        $this->user = $this->getUser();
        
        $ds = DIRECTORY_SEPARATOR; // different when using windows 
        $pics_directory = \Yii::$app->basePath . $ds . 'web' . $ds . 'pics';
        $users_directory = $pics_directory . $ds . 'user';
        $userFile = $users_directory . $ds . $this->id.".jpg";
        
        if (!file_exists($pics_directory)) {
            mkdir($pics_directory, 0777);
        }
        if (!file_exists($users_directory)) {
            mkdir($users_directory, 0777);
        }
        
        if ($_FILES['UserEditForm']["tmp_name"]['image']) {
            Image::thumbnail($_FILES['UserEditForm']["tmp_name"]['image'], 180, 180)
                    ->save($userFile, ['quality' => 50]);
            $this->image = "/user/".$this->id.".jpg";
        }
        
        $this->saveMe($ownProfile);

        return $this->user;
    }

    public function createUser()
    {
        $this->user = new User();

        $this->saveMe();

        return $this->user;
    }
    
    private function saveMe($ownProfile=FALSE)
    {
        if ($ownProfile) {
            $this->user->id = Yii::$app->user->id;
        } else {
            $this->user->id = $this->id;
        }
        $this->user->name = $this->name;
        $this->user->email = $this->email;
        $this->user->role_id = $this->role_id;
        $this->user->image = $this->image;

        if ($this->password) {
            $this->user->password = $this->password;
            $this->user->password_confirm = $this->password_confirm;
            
            if (!$this->user->validate()) {
                Yii::warning("Could not validate the user: ".print_r($this->user->getErrors(), true));
                return false;
            }
        }
        $this->user->generateAuthKey();
        $this->user->save(false);
        
    }

    public function getUser()
    {
        $id = Yii::$app->user->id;
        if ($this->id) {
            $id = $this->id;
        }

        return User::find()->where(['id' => $id])->one();
    }
    
}
