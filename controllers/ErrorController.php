<?php


namespace app\controllers;

use app\models\Client;
use app\models\Pokazaniya;
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
        $datchId = $request['datchId'];
        Yii::warning($datchId, '$datchId');
        $modelPok = Pokazaniya::find()->where(['datchId' => $datchId])->orderBy(['id' => SORT_DESC])->limit(1)->one();
        $date = date("Y-m-d H:i:s");
        $modelPok->date = $date;
        $modelPok->colorVal = 'green';
        $modelPok->save();
        $modelError = Error::find()->where(['datchId' => $datchId])->one();
        $modelError->error = '0';
        $test = Error::find()->where(['datchId' => $datchId])->one()->test;
        if ($test == 1) {
            $modelError->error = '1';
            $modelError->test = 0;
        }
        $modelError->save();
        $arr = Error::error($datchId);
        $strTelephone = "";
        if ($arr['error'] == 1) {
            $strTelephone = Client::find()->where(['id' => $arr['clientId']])->one()->telephone;
        }
        return $strTelephone;
    }
}
