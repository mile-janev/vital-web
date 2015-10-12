<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "connection".
 *
 * @property string $user_id
 * @property string $patient_id
 *
 * @property User $user
 * @property User $patient
 */
class Connection extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'connection';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'patient_id'], 'required'],
            [['user_id', 'patient_id'], 'integer'],
            [['user_id', 'patient_id'], 'unique', 'targetAttribute' => ['user_id', 'patient_id'], 'message' => 'Already connected!']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User',
            'patient_id' => 'Patient',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatient()
    {
        return $this->hasOne(User::className(), ['id' => 'patient_id']);
    }
}
