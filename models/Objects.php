<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "object".
 *
 * @property int $id
 * @property int|null $name
 * @property int|null $clientId
 *
 * @property Client $client
 * @property Plata[] $platas
 */
class Objects extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'object';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'clientId'], 'integer'],
            [['clientId'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['clientId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'clientId' => 'Client ID',
        ];
    }
//
//    /**
//     * Gets query for [[Client]].
//     *
//     * @return \yii\db\ActiveQuery
//     */
//    public function getClient()
//    {
//        return $this->hasOne(Client::className(), ['id' => 'clientId']);
//    }
//
//    /**
//     * Gets query for [[Platas]].
//     *
//     * @return \yii\db\ActiveQuery
//     */
//    public function getPlatas()
//    {
//        return $this->hasMany(Plata::className(), ['objectId' => 'id']);
//    }
    
//    public static function getObject($clientId) {
//        $objects = Object::find()->where(['clientId' => $clientId])->all();
//        return $objects;
//    }
}
