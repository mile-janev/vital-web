<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sign".
 *
 * @property string $id
 * @property string $name
 * @property string $alias
 */
class Sign extends \yii\db\ActiveRecord
{
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
            [['id', 'name', 'alias'], 'required'],
            [['id'], 'integer'],
            [['name', 'alias'], 'string', 'max' => 128]
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
            'alias' => 'Alias',
        ];
    }
}
