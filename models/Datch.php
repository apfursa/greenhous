<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "datch".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $min
 * @property int|null $max
 * @property string|null $type
 * @property int|null $plataId
 *
 * @property Plata $plata
 * @property Pokazaniya[] $pokazaniyas
 */
class Datch extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'datch';
    }

    public function rules()
    {
        return [
            [['min', 'max', 'plataId'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['type'], 'string', 'max' => 32],
            [['plataId'], 'exist', 'skipOnError' => true, 'targetClass' => Plata::className(), 'targetAttribute' => ['plataId' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'min' => 'Min',
            'max' => 'Max',
            'type' => 'Type',
            'plataId' => 'Plata ID',
        ];
    }

    public static function setValue($request)
    {
        $datchObj = self::find()->where(['id' => $request['datchId']])->one();
        Yii::warning($request, '$request');
        if(! ($request['maxTemp'] == null) && ! ($request['minTemp'] == null)){
            $datchObj->max = $request['maxTemp'];
            $datchObj->min = $request['minTemp'];
        }
        $datchObj->save();
    }
}
