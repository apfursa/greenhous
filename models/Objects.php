<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "object".
 * @property int $id
 * @property int|null $name
 * @property int|null $clientId
 * @property Client $client
 * @property Plata[] $platas
 */
class Objects extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'object';
    }

    public function rules()
    {
        return [
            [['name', 'clientId'], 'integer'],
            [['clientId'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['clientId' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'clientId' => 'Client ID',
        ];
    }

}
