<?php


namespace app\controllers\test;


use app\models\Pokazaniya;
use app\models\Error;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;
use Yii;
use app\models\Hour;
use app\models\Day;
use app\models\Week;


class TestRestController extends Controller
{
    public function actionTest()
    {

        $date = strtotime('-10 min');
        $arrError = Error::find()->all();
        foreach ($arrError as $oneError) {
            $datchId = $oneError['datchId'];
            $objPokazaniya = Pokazaniya::find()
                ->where(['datchId' => $datchId])
                ->orderBy(['id' => SORT_DESC])
                ->limit(1)
                ->one();
            if(is_array($objPokazaniya)){
                return 'arr';
            }
            if(is_object($objPokazaniya)){
                return $objPokazaniya;
            }
            $datePokazaniya = strtotime($objPokazaniya->date);
            if ($date > $datePokazaniya) {
                $oneError['error'] = '1';
                $oneError->save();
                $objPokazaniya['colorVal'] = 'black';
                $objPokazaniya->save();
                return $objPokazaniya['id'];
            }
        }
//        return $date;
    }

    public function actionDate()
    {
//        $models = Hour::find()->all();
//        foreach($models as $model)
//        {
//            $day = new Day;
//            $day['datchId'] = $model['datchId'];
//            $day['value'] = $model['value'];
//            $day['colorVal'] = $model['colorVal'];
//            $day['date'] = $model['date'];
//            $day['time'] = $model['time'];
//            $day->save();
//        }
        $date = date("Y-m-d H:i:s");
        $dateDeleteDay = date("Y-m-d H:i:s", strtotime($date) - 86400);
        $days = Day::find()->where(['<', 'date', $dateDeleteDay])->all();
        foreach($days as $day)
        {
            $day->delete();
        }
        return 'Ok';
    }
}