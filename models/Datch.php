<?php

namespace app\models;

use Yii;

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
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'datch';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['min', 'max', 'plataId'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['type'], 'string', 'max' => 32],
            [['plataId'], 'exist', 'skipOnError' => true, 'targetClass' => Plata::className(), 'targetAttribute' => ['plataId' => 'id']],
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
            'min' => 'Min',
            'max' => 'Max',
            'type' => 'Type',
            'plataId' => 'Plata ID',
        ];
    }
//
//    /**
//     * Gets query for [[Plata]].
//     *
//     * @return \yii\db\ActiveQuery
//     */
//    public function getPlata()
//    {
//        return $this->hasOne(Plata::className(), ['id' => 'plataId']);
//    }
//
//    /**
//     * Gets query for [[Pokazaniyas]].
//     *
//     * @return \yii\db\ActiveQuery
//     */
//    public function getPokazaniyas()
//    {
//        return $this->hasMany(Pokazaniya::className(), ['datchId' => 'id']);
//    }

    public static function setValue($request)
    {
//        Yii::warning($request, '$request_80');
//        $dateinactive = $request['inactive'];
//        Yii::warning($dateinactive, '$dateinactive');
//        $dateinactiveTime = $request['inactiveTime'];
//        Yii::warning($dateinactiveTime, '$dateinactiveTime');
//        $strDate = $dateinactive . " " . $dateinactiveTime .":00";
//        $strTo = strtotime($strDate);
        //Yii::warning($strTo, '$strTo');

//        $dateStartCall = date('Y-m-d H:i:s', ($strTo));
        //Yii::warning($dateStartCall, '$dateStartCall');
//        $datePlus = 120;
//        $nextDate = time() + $datePlus;
//        $dateStartCall = date("Y-m-d H:i:s", $nextDate);//, $nextDate'Y-m-d H:m:s'
        $datchObj = self::find()->where(['id' => $request['datchId']])->one();
        if(! ($request['maxTemp'] == null) && ! ($request['minTemp'] == null)){
            $datchObj->max = $request['maxTemp'];
            $datchObj->min = $request['minTemp'];
        }
        $datchObj->save();

//        $plataId = $datchObj->plataId;
//        $objectId = Plata::find()->where(['id' => $plataId])->one()->objectId;
//        $clientId = Objects::find()->where(['id' => $objectId])->one()->clientId;
//        $clientObj = Client::find()->where(['id' => $clientId])->one();
//
//        //$date = date("Y-m-d H:i:s");
//        $clientObj->dateStartCall = $dateStartCall;
//        $clientObj->save();
    }
}
