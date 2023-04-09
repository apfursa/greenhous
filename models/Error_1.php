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
        return 'error_table';
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

    public static function error($plataId)
    {
        $res = "";
        $date = date("Y-m-d H:i:s");
        $objId = Plata::find()->where(['id' => $plataId])->one()->objectId;
        $clientId = Objects::find()->where(['id' => $objId])->one()->clientId;
        $clientObj = Client::find()->where(['id' => $clientId])->one();
        $strTelephone = $clientObj->phoneError;
        $dateStart = $clientObj->dateStartCall;
        if($date > $dateStart){
            $res = $strTelephone;
        }
        return $res;
    }

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