<?php


namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\Pokazaniya;
use app\models\Error;

class PokazaniyaController extends \yii\web\Controller
{
    public function actionData()
    {
        $request = Yii::$app->request->queryParams;
        //Yii::warning(ArrayHelper::toArray($request), '$request');
        $requestArr = ArrayHelper::toArray($request);
        Pokazaniya::setValue($requestArr);
    }

    public function actionError()
    {
        $request = Yii::$app->request->queryParams;
        $requestArr = ArrayHelper::toArray($request);
        //Yii::warning($requestArr, '$requestArr');

        $error = Error::error();
        //Yii::warning($error, '$error');
        return $error;
    }
}
