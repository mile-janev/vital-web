<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "logs".
 *
 * @property integer $id
 * @property string $sign
 * @property double $value
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property string $user_id
 *
 * @property User $user
 */
class Logs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'logs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sign', 'value', 'user_id'], 'required'],
            [['value'], 'number'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['user_id'], 'integer'],
            [['sign'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sign' => 'Sign',
            'value' => 'Value',
            'description' => 'Description',
            'created_at' => 'Time',
            'updated_at' => 'Last Updated Time',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
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
        } else {
            $this->updated_at = new Expression('NOW()');
        }
        
        return parent::beforeSave($insert);
    }
}
