<?php

namespace app\models;

use Yii;
use app\models\Proekt;
use yii\helpers\ArrayHelper;
use app\models\Datch;

class Pokazaniya extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pokazaniya';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['datchId'], 'integer'],
            [['value'], 'string', 'max' => 64],
            [['datchId'], 'exist', 'skipOnError' => true, 'targetClass' => Datch::className(), 'targetAttribute' => ['datchId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'datchId' => 'Datch ID',
            'value' => 'Value',
        ];
    }

    /**
     * Gets query for [[Datch]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDatch()
    {
        return $this->hasOne(Datch::className(), ['id' => 'datchId']);
    }

//    public static function setValue($requestArr)
//    {
//        $data = substr($requestArr['params'], 1, -1);
//        $arr = explode(',', $data);
//        $dateTimestamp = date("Y-m-d H:i:s");
//
//        $model = new Proekt;
//        $model->tempIn = $arr[1];
//        $model->tempOut = $arr[3];
//        $model->deltat = $arr[1] - $arr[3];
//        $model->sred = ($arr[1] + $arr[3]) / 2;
//        $model->tempOkr = $arr[5];
//        $model->delT = ($arr[1] + $arr[3]) / 2 - $arr[5];
//        $model->date = $dateTimestamp;
//        $model->save();
//    }

    public static function setValue($request)
    {
        $datchObj = Datch::find()->where(['id' => $request['datchId']])->one();
//        Yii::warning(ArrayHelper::toArray($datchObj));
        $errorObj = Error::find()->where(['id' => $request['datchId']])->one();
//        Yii::warning(ArrayHelper::toArray($errorObj));
        $max = $datchObj->max;
        $min = $datchObj->min;
        if ($request['data'] < $max && $request['data'] > $min) {
            $color = "green";
            $errorObj->error = "0";
        } else {
            $color = "red";
            $errorObj->error = "1";
        }
        $pokazaniyaObj = new Pokazaniya;
        $pokazaniyaObj->datchId = $request['datchId'];
        $pokazaniyaObj->value = $request['data'];
        $pokazaniyaObj->colorVal = $color;
        $date = date("Y-m-d H:i:s");
        $pokazaniyaObj->date = $date;
        $pokazaniyaObj->save();
//        Yii::warning(ArrayHelper::toArray($pokazaniyaObj));
        $errorObj->date = $date;
        $errorObj->save();
//        Yii::warning(ArrayHelper::toArray($errorObj));
    }

//    public static function setValue($requestArr)
//    {
//        $data = substr($requestArr['params'], 1, -1);
//        $arr = explode(',', $data);
//        $date = date("Y-m-d H:i:s");
//        for ($i = 0; $i < ($requestArr['countDatch']) * 2; $i = $i + 2) {
//            $pokazaniyaObj = new Pokazaniya;
//            $pokazaniyaObj->datchId = $arr[$i];
//            $pokazaniyaObj->value = $arr[$i + 1];
//            $colorVal = self::colorDefinition($arr[$i + 1], $arr[$i]);
//            $pokazaniyaObj->colorVal = $colorVal;
//            $pokazaniyaObj->date = $date;
//            $pokazaniyaObj->save();
//        }
//    }

    public static function colorDefinition($value, $datchId)
    {
        $date = date("Y-m-d H:i:s");
        $datchObj = Datch::find()->where(['id' => $datchId])->one();
//        Yii::warning(ArrayHelper::toArray($datchObj), '$datchObj');
        $clientObj = Error::getClient($datchId);
        $max = $datchObj->max;
        $min = $datchObj->min;
        if ($value < $max && $value > $min) {
            $color = "green";
            if (!$clientObj->phoneError == "") {
                $clientObj->phoneError = "";
                $clientObj->date = $date;
                $clientObj->save();
            }
        } else {
            $color = "red";
            if ($clientObj->phoneError == "") {
                $clientObj->phoneError = $clientObj->telephone;
                $clientObj->date = $date;
                $clientObj->save();
            }

//            if($clientObj->phoneError == "" && $date > $datchObj->dateStartCall){
//                $clientObj->phoneError = $clientObj->telephone;
//                $clientObj->date = $date;
//                $clientObj->save();
//            }
        }

        return $color;
    }

//

//    public static function setValue($requestArr) {
//        
//        
//        for($i=0; $i<$requestArr['countDatch']; $i++){
//            Yii::warning($requestArr['countDatch'], '$requestArr[countDatch]');
//            
//            foreach($requestArr as $key => $value){
//                Yii::warning($key, '$key');
//                Yii::warning($value, '$value');
//                if($key == 'Datch'.$i){
//                    $data = substr($value, 1, -1);
//                    $arr = explode(',', $data);
//                    Yii::warning($arr, '$arr');
//                    $model = new Pokazaniya;
//                    $model->datchId = $arr[0];
//                    $model->value = $arr[1];                    
//                    $model->save();
//                }
//                
//            }
//        }
//        
//    }
}
