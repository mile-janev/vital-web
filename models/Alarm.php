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
 * @property string $time
 * @property string $is_sos
 * @property string $created_at
 * @property string $updated_at
 * @property string $for_id
 * @property string $from_id
 * @property string $seen
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
            [['title', 'for_id', 'time'], 'required'],
            [['created_at', 'updated_at', 'is_sos'], 'safe'],
            [['for_id', 'from_id'], 'integer'],
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
            'time' => 'Time',
            'is_sos' => 'SOS',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'for_id' => 'Alarm For',
            'from_id' => 'Alarm From',
            'seen' => 'Seen'
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
        return $this->hasOne(User::className(), ['id' => 'for_id']);
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
            ->where(["for_id" => Yii::$app->user->id, "seen" => 0])
            ->andWhere("time <= NOW()")
            ->orderBy("time ASC")
            ->one();
        
        return $alarm;
    }
}
