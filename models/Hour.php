<?php

namespace app\models;

use Yii;
//use app\models\Proekt;

class Hour extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'hour';
    }

    public function rules()
    {
        return [
            [['datchId'], 'integer'],
//            [['value'], 'string', 'max' => 64],
            [['datchId'], 'exist', 'skipOnError' => true, 'targetClass' => Datch::className(), 'targetAttribute' => ['datchId' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'datchId' => 'Datch ID',
            'value' => 'Value',
        ];
    }

    public function getDatch()
    {
        return $this->hasOne(Datch::className(), ['id' => 'datchId']);
    }

    public static function setValue($request)
    {
        $datchObj = Datch::find()->where(['id' => $request['datchId']])->one();
        $errorObj = Error::find()->where(['datchId' => $request['datchId']])->one();
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
        $errorObj->date = $date;
        $errorObj->save();
    }

    public static function colorDefinition($value, $datchId)
    {
        $date = date("Y-m-d H:i:s");
        $datchObj = Datch::find()->where(['id' => $datchId])->one();
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
        }
        return $color;
    }

}
