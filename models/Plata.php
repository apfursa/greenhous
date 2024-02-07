<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "plata".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $model
 * @property int|null $objectId
 * @property int|null $keyPlata
 *
 * @property Datch[] $datches
 * @property Object $object
 */
class Plata extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'plata';
    }

    public function rules()
    {
        return [
            [['objectId', 'keyPlata'], 'integer'],
            [['name', 'model'], 'string', 'max' => 64],
            [['objectId'], 'exist', 'skipOnError' => true, 'targetClass' => Objects::className(), 'targetAttribute' => ['objectId' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'model' => 'Model',
            'objectId' => 'Object ID',
            'keyPlata' => 'Key Plata',
        ];
    }
//
//    /**
//     * Gets query for [[Datches]].
//     *
//     * @return \yii\db\ActiveQuery
//     */
//    public function getDatches()
//    {
//        return $this->hasMany(Datch::className(), ['plataId' => 'id']);
//    }
//
//    /**
//     * Gets query for [[Object]].
//     *
//     * @return \yii\db\ActiveQuery
//     */
//    public function getObject()
//    {
//        return $this->hasOne(Objects::className(), ['id' => 'objectId']);
//    }
}
