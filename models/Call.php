<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "call".
 *
 * @property string $id
 * @property string $caller
 * @property string $called
 * @property string $start
 * @property string $end
 * @property integer $status
 *
 * @property User $caller0
 * @property User $called0
 */
class Call extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'call';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['caller', 'called',], 'required'],
            [['caller', 'called', 'status'], 'integer'],
            [['start', 'end'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'caller' => 'Caller',
            'called' => 'Called',
            'start' => 'Start',
            'end' => 'End',
            'status' => 'Status',
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
               'createdAtAttribute' => 'start',
               'updatedAtAttribute' => 'end',
               'value' => new Expression('NOW()'),
           ],
       ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCaller0()
    {
        return $this->hasOne(User::className(), ['id' => 'caller']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalled0()
    {
        return $this->hasOne(User::className(), ['id' => 'called']);
    }
}
