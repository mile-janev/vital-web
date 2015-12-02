<?php

namespace app\models;

use Yii;
use yii\base\Model;

class MewsForm extends Model
{
    public $systolic;
    public $diastolic;
    public $heart;
    public $respiratory;
    public $temperature;
    public $avpu;
    public $patient;


    public function rules()
    {
        return [
            [['systolic', 'heart', 'respiratory', 'temperature', 'avpu', 'patient'], 'required'],
            [['systolic', 'heart', 'respiratory', 'temperature', 'avpu', 'patient'], 'integer'],
            [['systolic', 'diastolic', 'heart', 'respiratory', 'temperature', 'avpu', 'patient'], 'safe'],
            [['diastolic'], 'default', 'value' => 0],
        ];
    }

    public function attributeLabels()
    {
        return [
            'systolic' => 'Systolic Blood Pressure',
            'diastolic' => 'Diastolic Blood Pressure',
            'heart' => 'Heart Rate',
            'respiratory' => 'Respiratory Rate',
            'temperature' => 'Temperature',
            'avpu' => 'AVPU',
            'patient' => 'Patient'
        ];
    }
    
}
