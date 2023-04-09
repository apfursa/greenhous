<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\helpers\ArrayHelper;
use app\models\Client;
use app\models\Objects;
use app\models\Users;
use app\models\Plata;
use app\models\Datch;
use app\models\Pokazaniya;
use yii\web\UploadedFile;
use app\models\UploadImage;

class SiteController extends Controller
{

    //public $enableCsrfValidation = false;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $id = Yii::$app->user->id;
        //$id = 102;
//        Yii::warning($id, 'app\controllers\SiteController_actionIndex()_$id');
        $clientId = Users::getClientId($id);
        $objects = Objects::find()->where(['clientId' => $clientId])->asArray()->all();
//        $objectsArr = ArrayHelper::toArray($objects);
//        Yii::warning($objects, 'app\controllers\SiteController_actionIndex()_$objects');
        $object = [];
        $objectF = [];
        $plats = [];
        $pl = [];
        $ob = [];
        $datchs = [];
        foreach ($objects as $object_a) {
            $transmitters = Plata::find()->where(['objectId' => $object_a['id']])->asArray()->all(); // Передатчики
//            $plataArr = ArrayHelper::toArray($transmitters);
//            Yii::warning($transmitters, 'app\controllers\SiteController_actionIndex()_$transmitters');
            foreach ($transmitters as $transmitter) {
                //Yii::warning($transmitter, '$transmitter');
                $platass[$transmitter['name'] . '-id' . $transmitter['id']] = $transmitter;
//                Yii::warning($platass, 'app\controllers\SiteController_actionIndex()_$platass');
            }
            $object[$object_a['name']] = $platass;
            $platass = [];
        }
//        Yii::warning($object, 'app\controllers\SiteController_actionIndex()_$object');
        foreach ($object as $key => $obj1) {
            foreach ($obj1 as $plat) {
                $datchObj = Datch::find()->where(['plataId' => $plat['id']])->all();
                $datchArr = ArrayHelper::toArray($datchObj);
                //Yii::warning($datchArr, '$datchArr');
                foreach ($datchArr as $dat) {
                    //Yii::warning($dat, '$dat');
                    $datchikss[$dat['name']] = $dat; // . '-id' . $dat['id']
                    //Yii::warning($datchikss, '$datchikss');
                }
                $plats[$plat['name'] . '-id' . $plat['id']] = $datchikss;
                $datchikss = [];
                //Yii::warning($plats, '$plats');
            }
            $objectF[$key] = $plats;
            $plats = [];
            //Yii::warning($objectF, '$object_2');
        }
//        Yii::warning($objectF, 'app\controllers\SiteController_actionIndex()_$object_F');
        foreach ($objectF as $keyObjPok => $objPok) {
//            Yii::warning($keyObjPok, 'app\controllers\SiteController_actionIndex()_$keyObjPok');
//            Yii::warning($objPok, 'app\controllers\SiteController_actionIndex()_$objPok');
            foreach ($objPok as $keyPlatPok => $platPok) {
//                Yii::warning($platPok, 'app\controllers\SiteController_actionIndex()_$platPok');
                foreach ($platPok as $keyDatchPok => $datchPok) {
//                    Yii::warning($datchPok, 'app\controllers\SiteController_actionIndex()_$datchPok');
                    $pokazObj = Pokazaniya::find()->where(['datchId' => $datchPok['id']])->orderBy(['id' => SORT_DESC])->limit(1)->one();

                    $pokazArr = ArrayHelper::toArray($pokazObj);
                    $datchs[$keyDatchPok] = $pokazArr;
//                    $datchs[$keyDatchPok] = end($pokazArr);
//                    Yii::warning($datchs, 'app\controllers\SiteController_actionIndex()_$datchs');
                    $pokazArr = [];
                }
                $pl[$keyPlatPok] = $datchs;
                $datchs = [];
            }
            $ob[$keyObjPok] = $pl;
            $pl = [];
//            Yii::warning($ob, 'app\controllers\SiteController_actionIndex()_$ob_124');
        }
//        Yii::warning($ob, 'app\controllers\SiteController_actionIndex()_$ob');
        return $this->render('index', ['ob' => $ob]);
    }

    public function actionLogin()
    {
//        Yii::warning(Yii::$app->request->post(), 'post');
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            //Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

}
