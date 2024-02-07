<?php


namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\Datch;
use app\models\Error;

class SettingController extends \yii\rest\Controller
{
    public function actionSetting()
    {
        $request = Yii::$app->request->queryParams;
        $datchId = $request['datchId'];
        Yii::warning($datchId, 'SettingController_$datchId_16');
        $datch = Datch::find()->where(['id' => $datchId])->one();
        $min = $datch['min'];
        $max = $datch['max'];
        $date = date('Y-m-d');
        $time = date('H:i:s');
        return [
//            'Ok'
            'max' => $max,
            'min' => $min,
            'date' => $date,
            'time' => $time
        ];
    }

}
