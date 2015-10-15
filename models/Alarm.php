<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "alarm".
 *
 * @property string $id
 * @property string $title
 * @property string $created_at
 * @property string $updated_at
 * @property string $patient_id
 * @property string $time
 *
 * @property User $patient
 */
class Alarm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alarm';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'patient_id', 'time'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['patient_id'], 'integer'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Reminder',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'patient_id' => 'Patient',
            'time' => 'Time'
        ];
    }
    
    /*
     * Override beforeSave() method
     * Method called before listing is saved, on create or update
     */
    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            if (!$this->created_at) {
                $this->created_at = new Expression('NOW()');
            }
            $this->updated_at = new Expression('NOW()');
            $this->from_id = Yii::$app->user->id;
        } else {
            $this->updated_at = new Expression('NOW()');
        }
        
        return parent::beforeSave($insert);
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
    public function getFrom()
    {
        return $this->hasOne(User::className(), ['id' => 'from_id']);
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
     * Find first alarm for current user
     */
    public static function findUserAlarm() 
    {
        $alarm = \app\models\Alarm::find()
            ->where(["patient_id" => Yii::$app->user->id, "seen" => 0])
            ->andWhere("time <= NOW()")
            ->orderBy("time ASC")
            ->one();
        
        return $alarm;
    }
}
