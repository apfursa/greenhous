<?php

namespace app\controllers;

use app\models\Error;
use Yii;
use yii\helpers\ArrayHelper;
use app\models\Datch;
use yii\web\Controller;

class SetupController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionParam($datchId)
    {
        $typeDatch = Datch::find()->where(['id' => $datchId])->one()->type;
//        $res = $this->asJson($typeDatch);
//        return $datchId;
        switch ($typeDatch) {
            case ("t"):
                return $this->render('temperature', ['datchId' => $datchId]);
                break;
            case ("fi"):
                return $this->render('humidity', ['datchId' => $datchId]);
                break;
            case ("p"):
                return $this->render('pressure', ['datchId' => $datchId]);
                break;
            case ("i"):
                return $this->render('illumination', ['datchId' => $datchId]);
                break;
            case ("s"):
                return $this->render('smoke', ['datchId' => $datchId]);
                break;
            case ("pit"):
                return $this->render('powerSupply', ['datchId' => $datchId]);
                break;
            case ("tel"):
                return $this->render('phone', ['datchId' => $datchId]);
                break;
            default:
                break;
        }
    }

    public function actionSetValueForm()
    {
        $request = Yii::$app->request->post();
        $typeDatch = Datch::find()->where(['id' => $request['datchId']])->one()->type;
        if ($typeDatch == "tel") {
            if (!($request['phone'] == '')) {
                Error::setValueTelephone($request['datchId'], $request['phone']);
            }
        } else {
            Datch::setValue($request);
            Error::setValue($request);
        }
//        $res = $this->asJson($request);
//        return $res;
        return $this->goBack();
    }
}
