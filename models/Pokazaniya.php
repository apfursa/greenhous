<?php

namespace app\models;

use Yii;
use app\models\Hour;

class Pokazaniya extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'pokazaniya';
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
        Yii::warning($request, '$request');
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

        $hourObj = new Hour;
        $hourObj->datchId = $request['datchId'];
        $hourObj->value = $request['data'];
        $hourObj->colorVal = $color;
//        $date = date("Y-m-d H:i:s");
        $hourObj->date = $date;
        $time = date('H:i:s', strtotime($date));
        $hourObj->time = $time;
        $hourObj->save();
        $dateDeleteHour = date("Y-m-d H:i:s", strtotime($date) - 3600);
        $hours = Hour::find()->where(['<', 'date', $dateDeleteHour])->all();
        foreach($hours as $hour)
        {
            $hour->delete();
        }

        $dayObj = new Day();
        $dayObj->datchId = $request['datchId'];
        $dayObj->value = $request['data'];
        $dayObj->colorVal = $color;
//        $date = date("Y-m-d H:i:s");
        $dayObj->date = $date;
        $time = date('H:i:s', strtotime($date));
        $dayObj->time = $time;
        $dayObj->save();
        $dateDeleteDay = date("Y-m-d H:i:s", strtotime($date) - 86400);
        $days = Day::find()->where(['<', 'date', $dateDeleteDay])->all();
        foreach($days as $day)
        {
            $day->delete();
        }

        $weekObj = new Week();
        $weekObj->datchId = $request['datchId'];
        $weekObj->value = $request['data'];
        $weekObj->colorVal = $color;
//        $date = date("Y-m-d H:i:s");
        $weekObj->date = $date;
        $time = date('H:i:s', strtotime($date));
        $weekObj->time = $time;
        $weekObj->save();
        $dateDeleteWeek = date("Y-m-d H:i:s", strtotime($date) - 604800);
        $weeks = Week::find()->where(['<', 'date', $dateDeleteWeek])->all();
        foreach($weeks as $week)
        {
            $week->delete();
        }

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
