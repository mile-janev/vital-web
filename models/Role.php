<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "role".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 *
 * @property Users[] $users
 */
class Role extends \yii\db\ActiveRecord
{
    const ADMINISTRATOR = 'administrator';
    const VISITOR = 'visitor';
    const PATIENT = 'patient';
    const FAMILY = 'family';
    const DOCTOR = 'doctor';
    const NURSE = 'nurse';
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['name', 'description'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Role shortcode',
            'description' => 'Role',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['role_id' => 'id']);
    }
    
    /**
     * @accept string role name (example: 'visitor')
     * @return role Role primary key $id
     */
    public static function getRoleID($name = Role::VISITOR) {
        $role = self::findOne(['name' => $name]);
        if ($role) {
            $role_id = $role->id;
        } else {
            $role_id = FALSE;
        }
        
        return $role_id;
    }
    
    public static function getRoleOptions()
    {
        $roles = self::find()->orderBy('id DESC')->all();

        $options = [];

        foreach($roles as $role) {
            $options[$role->id] = "{$role->description}";
        }

        return $options;
    }
    
}
