<?php

namespace app\models;

use Yii;

class Client extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'client';
    }

    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 64],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

}
