<?php


namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;

class PumpController extends \yii\rest\Controller
{
    public function actionSetting()
    {
//        $request = Yii::$app->request->queryParams;
//        $datchId = $request['datchId'];
        Yii::warning('pump', 'pumpController_Setting_15');
//        $datch = Datch::find()->where(['id' => $datchId])->one();
//        $min = $datch['min'];
//        $max = $datch['max'];
//        $date = date('Y-m-d');
        $time = date('H:i:s');
        return [
            'time' => $time
        ];
    }

}
