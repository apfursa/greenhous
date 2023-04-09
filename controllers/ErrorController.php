<?php


namespace app\controllers;

use app\models\Client;
use Yii;
use yii\helpers\ArrayHelper;
use app\models\Error;
//use yii\web\Controller;
use yii\rest\Controller;

class ErrorController extends Controller
{

    public function actionError()
    {
        $request = Yii::$app->request->queryParams;
//        $requestArr = ArrayHelper::toArray($request);
//        Yii::warning($requestArr, '$requestArr');
        $datchId = $request['datchId'];
        $arr = Error::error($datchId);
        $strTelephone = "";
        if($arr['error'] == 1){
            $strTelephone = Client::find()->where(['id' => $arr['clientId']])->one()->telephone;
        }

        //$arr = [];
        //$arr['errorss'] = $error;
        //$error['p'] = 12;
//        $error = [
//            'p' => 12,
//            'k' => 18
//        ];
//        $arr = $this->asJson($error);
//        Yii::warning($err, '$err');
        return $strTelephone;
    }
//    public function actionError()
//    {
//        $request = Yii::$app->request->queryParams;
////        $requestArr = ArrayHelper::toArray($request);
////        Yii::warning($requestArr, '$requestArr');
//        $plataId = $request['plataId'];
//        $strTelephone = Error::error($plataId);
//        //$arr = [];
//        //$arr['errorss'] = $error;
//        //$error['p'] = 12;
////        $error = [
////            'p' => 12,
////            'k' => 18
////        ];
//        //$arr = $this->asJson($error);
//        //Yii::warning($err, '$err');
//        return $strTelephone;
//    }
}
