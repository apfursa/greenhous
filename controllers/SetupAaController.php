<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\Datch;
use yii\rest\ActiveController;
use yii\web\Controller;
use app\models\Setup;

class SetupController extends Controller
{
    //public $modelClass = Setup::class;

    public $enableCsrfValidation = false;

    public function actionParam($datchId)
    {
        $typeDatch = Datch::find()->where(['id' => $datchId])->one()->type;
//        Yii::warning($typeDatch, '$typeDatch');
        switch ($typeDatch) {
            case ("t"):
                return $this->render('temperature', ['datchId' => $datchId, 'max' => $max, 'min' => $min]);
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
        }

        //return $this->render('param', ['datchId' => $datchId]);
    }

    public function actionSetvalue()
    {
//        Yii::warning($id, 'id');
        //return $this->render('param',['ppp' => $id]);
    }

    public function actionSetValueForm()
    {
        $request = Yii::$app->request->post();
        Datch::setValue($request);
        //$res = $this->asJson($request);
        //return $res;
        return $this->goBack();
    }


}
