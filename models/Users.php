<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $lastName
 * @property string|null $emal
 * @property int|null $phone
 * @property int|null $clientId
 * @property string|null $pass
 *
 * @property Client $client
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'phone', 'clientId'], 'integer'],
            [['name', 'lastName', 'pass'], 'string', 'max' => 32],
            [['emal'], 'string', 'max' => 64],
            [['id'], 'unique'],
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
            'lastName' => 'Last Name',
            'emal' => 'Emal',
            'phone' => 'Phone',
            'clientId' => 'Client ID',
            'pass' => 'Pass',
        ];
    }

    /**
     * Gets query for [[Client]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'clientId']);
    }

    public static function getClientId($id) {
        $clientId = Users::find()->where(['id'=>$id])->one()->clientId;
//        Yii::warning($clientId, 'app\models\Users_getClientId()_$clientId');
        return $clientId;
    }
}
