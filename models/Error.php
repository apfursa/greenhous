<?php


namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

//use app\models\Datch;
//use app\models\Plata;

/**
 * This is the model class for table "proekt".
 *
 * @property int $id
 * @property int|null $error
 */
class Error extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'error';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'error'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
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
        //Yii::warning($request, '$request');
        $dateInactiv = $request['inactiv'];
        //Yii::warning($dateInactiv, '$dateInactiv');
        $dateInactivTime = $request['inactivTime'];
        //Yii::warning($dateInactivTime, '$dateInactivTime');
        $strDate = $dateInactiv . " " . $dateInactivTime .":00";
        $strTo = strtotime($strDate);
        //Yii::warning($strTo, '$strTo');

        $dateStartCall = date('Y-m-d H:i:s', ($strTo));
        $objError = Error::find()->where(['datchId' => $request['datchId']])->one();

        $objError->dateStartCall = $dateStartCall;
        $objError->save();

    }




//    public static function error($plataId)
//    {
//        $res = "";
//        $date = date("Y-m-d H:i:s");
//        $objId = Plata::find()->where(['id' => $plataId])->one()->objectId;
//        $clientId = Objects::find()->where(['id' => $objId])->one()->clientId;
//        $clientObj = Client::find()->where(['id' => $clientId])->one();
//        $strTelephone = $clientObj->phoneError;
//        $dateStart = $clientObj->dateStartCall;
//        if($date > $dateStart){
//            $res = $strTelephone;
//        }
//        return $res;
//    }

//    public static function error($datchId)
//    {
//        $clientObj = self::getClient($datchId);
//
//        $error_2 = Error::find()->one();
//        $error = ArrayHelper::toArray($error_2);
//        //Yii::warning($error_2, '$error_2');
//        //Yii::warning(ArrayHelper::toArray($error_2), '$error_3');
//        return $error;
//    }

    public static function setValueTelephone($datchId, $phone)
    {
        $clientObj = self::getClient($datchId);
        $str = 'ATD+7' . $phone . ';';
        $clientObj->telephone = $str;
        $clientObj->phoneError = "";
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


}