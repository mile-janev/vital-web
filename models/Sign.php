<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sign".
 *
 * @property string $id
 * @property string $name
 * @property string $measure
 * @property string $alias
 */
class Sign extends \yii\db\ActiveRecord
{
    const HEART_RATE = "heart_rate";
    const BLOOD_PRESSURE = "blood_pressure";
    const TEMPERATURE = "temperature";
    const WEIGHT = "weight";
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sign';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'measure', 'alias'], 'required'],
            [['name', 'alias'], 'string', 'max' => 128],
            [['measure'], 'string', 'max' => 32]
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
            'measure' => 'Measure',
            'alias' => 'Alias',
        ];
    }
}
