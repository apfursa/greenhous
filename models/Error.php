<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

class Error extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'error';
    }

    public function rules()
    {
        return [
            [['id', 'error'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'error' => 'Error'
        ];
    }

    public static function error($datchId)
    {
        $res = [];
        $clientId = Error::find()->where(['datchId' => $datchId])->one()->clientId;
        $arrObjClient = Error::find()->where(['clientId' => $clientId])->all();
        foreach ($arrObjClient as $objClient) {
            if ($objClient['error'] == 1) {
                $date = date("Y-m-d H:i:s");
                if ($date > $objClient['dateStartCall']) {
                    $res['error'] = "1";
                    $res['clientId'] = $clientId;
                    return $res;
                }
            }
        }
        $res['error'] = "0";
        $res['clientId'] = $clientId;
        return $res;
    }

    public static function setValue($request)
    {
        $dateInactiv = $request['inactive'];
        $dateInactivTime = $request['inactiveTime'];
        $strDate = $dateInactiv . " " . $dateInactivTime . ":00";
        $strTo = strtotime($strDate);
        $dateStartCall = date('Y-m-d H:i:s', ($strTo));
        $objError = Error::find()->where(['datchId' => $request['datchId']])->one();
        $objError->dateStartCall = $dateStartCall;
        $objError->save();

    }

    public static function setValueTelephone($datchId, $phone)
    {
        $clientObj = self::getClient($datchId);
        $str = 'ATD+7' . $phone . ';';
        $clientObj->telephone = $str;
        $date = date("Y-m-d H:i:s");
        $clientObj->date = $date;
        $clientObj->save();
    }

    public static function getClient($datchId)
    {
        $plataId = Datch::find()->where(['id' => $datchId])->one()->plataId;
        $objId = Plata::find()->where(['id' => $plataId])->one()->objectId;
        $clientId = Objects::find()->where(['id' => $objId])->one()->clientId;
        $clientObj = Client::find()->where(['id' => $clientId])->one();
        return $clientObj;
    }

    public static function errorTime()
    {
        $date = strtotime('-10 min');
        $arrError = Error::find()->all();
        foreach ($arrError as $oneError) {
            $datchId = $oneError['datchId'];
            $objPokazaniya = Pokazaniya::find()
                ->where(['datchId' => $datchId])
                ->orderBy(['id' => SORT_DESC])
                ->limit(1)
                ->one();
            $datePokazaniya = strtotime($objPokazaniya->date);
            if ($date > $datePokazaniya) {
                $oneError->error = '1';
                $oneError->save();
                $objPokazaniya->colorVal = 'black';
                $objPokazaniya->save();
            }
        }
    }

}