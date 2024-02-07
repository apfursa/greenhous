<?php

namespace app\controllers;

use app\models\Error;
use app\models\Objects;
use app\models\Plata;
use app\models\Users;
use Yii;
use yii\helpers\ArrayHelper;
use app\models\Datch;
use yii\web\Controller;

class SetupController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionParam($datchId)
    {
        $userId = Yii::$app->user->id;
        Yii::warning($userId, '$userId');
        $clientId = Users::find()->where(['id' => $userId])->one()->clientId;
        $objectArr = Objects::find()->where(['clientId' => $clientId])->asArray()->all();
        Yii::warning($objectArr, '$objectArr_23');
        $objectIdArr = ArrayHelper::getColumn($objectArr, 'id');
        Yii::warning($objectIdArr, '$objectIdArr_26');
        $plataArr = Plata::find()->where(['objectId' => $objectIdArr])->asArray()->all();
        Yii::warning($plataArr, '$plataArr_28');
        $plataIdArr = ArrayHelper::getColumn($plataArr, 'id');
        Yii::warning($plataIdArr, '$plataIdArr_30');
        $datchArr = Datch::find()->where(['plataId' => $plataIdArr])->asArray()->all();
        $datchIdArr = ArrayHelper::getColumn($datchArr, 'id');
        Yii::warning($datchIdArr, '$datchIdArr_33');

        if (in_array($datchId, $datchIdArr)) {
            $typeDatch = Datch::find()->where(['id' => $datchId])->one()->type;
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
        } else {
            return false;
        }
//        $plataArr = [];
//        foreach($objectArr as $object){
//            $plataArr[] = Plata::find()->where(['objectId' => $object['id']])->asArray()->all();
//        }
//        Yii::warning($plataArr, '$plataArr_31');

    }

    public function actionSetValueForm()
    {
        $request = Yii::$app->request->post();
        $typeDatch = Datch::find()->where(['id' => $request['datchId']])->one()->type;
        if ($typeDatch == "tel") {
            if (!($request['phone'] == '')) {
                Error::setValueTelephone($request['datchId'], $request['phone']);
            }
            if (!($request['test'] == '')) {
                $model = Error::find()->where(['datchId' => $request['datchId']])->one();
                $model->test = 1;
                $date = date("Y-m-d H:i:s");
                $model->date = $date;
                $model->save();
                Yii::warning(ArrayHelper::toArray($model), 57);
            }
        } else {
            Datch::setValue($request);
            Error::setValue($request);
        }
        return $this->goBack();
    }

    public function actionGraphic()
    {

        $url60min = 'https://lookerstudio.google.com/reporting/133d26ef-579c-40ad-8a27-57b1f0bf23f5';
//        $request = Yii::$app->request->post();
//        $typeDatch = Datch::find()->where(['id' => $request['datchId']])->one()->type;
//        if ($typeDatch == "tel") {
//            if (!($request['phone'] == '')) {
//                Error::setValueTelephone($request['datchId'], $request['phone']);
//            }
//            if (!($request['test'] == '')) {
//                $model = Error::find()->where(['datchId' => $request['datchId']])->one();
//                $model->test = 1;
//                $date = date("Y-m-d H:i:s");
//                $model->date = $date;
//                $model->save();
//                Yii::warning(ArrayHelper::toArray($model), 57);
//            }
//        } else {
//            Datch::setValue($request);
//            Error::setValue($request);
//        }
//        return $this->goBack();

    }
}
