<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "medication".
 *
 * @property string $id
 * @property string $rx_number
 * @property string $name
 * @property string $strength
 * @property string $strength_measure
 * @property string $schedule
 * @property string $note
 * @property string $patient_id
 * @property string $prescribed_by_id
 *
 * @property User $patient
 * @property User $prescribedBy
 */
class Medication extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'medication';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rx_number', 'name', 'strength', 'schedule', 'patient_id', 'prescribed_by_id'], 'required'],
            [['strength', 'patient_id', 'prescribed_by_id'], 'integer'],
            [['schedule', 'note'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['rx_number'], 'string', 'max' => 128],
            [['name'], 'string', 'max' => 255],
            [['strength_measure'], 'string', 'max' => 4]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rx_number' => 'Rx Number',
            'name' => 'Name',
            'strength' => 'Dose',
            'strength_measure' => 'Measure',
            'schedule' => 'Schedule',
            'note' => 'Note',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'patient_id' => 'Patient',
            'prescribed_by_id' => 'Prescribed By',
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
     * @return \yii\db\ActiveQuery
     */
    public function getPatient()
    {
        return $this->hasOne(User::className(), ['id' => 'patient_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrescribedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'prescribed_by_id']);
    }
    
    public static function measurements()
    {
        $measurements = [];
        $measurements['']  = "--";
        $measurements['mg']  = "mg";
        $measurements['mcg']  = "mcg";
        $measurements['g']  = "g";
        $measurements['ml']  = "ml";
        $measurements['mg/ml']  = "mg/ml";
        $measurements['mcg/ml']  = "mcg/ml";
        $measurements['%']  = "%";
        $measurements['SPF']  = "SPF";
        
        return $measurements;
    }
}
