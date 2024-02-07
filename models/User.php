<?php

namespace app\models;


use yii\helpers\ArrayHelper;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{

    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;

//    public static function tableName() {
//        return 'user';
//    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id'], 'required'],
            [['id', 'phone', 'clientId'], 'integer'],
            [['name', 'lastName', 'pass', 'username', 'password', 'authKey', 'accessToken'], 'string', 'max' => 32],
            [['username', 'password', 'authKey', 'accessToken'], 'string', 'max' => 255],
            [['emal'], 'string', 'max' => 64],
            [['id'], 'unique'],
            [['clientId'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['clientId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    //Метки атрибутов
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'lastName' => 'Last Name',
            'emal' => 'Emal',
            'phone' => 'Phone',
            'clientId' => 'Client ID',
            'pass' => 'Pass',
        ];
    }

    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
        '102' => [
            'id' => '102',
            'username' => 'alex',
            'password' => 'alex',
            'authKey' => 'test102key',
            'accessToken' => '102-token',
        ],
        '103' => [
            'id' => '103',
            'username' => 'laa',
            'password' => '010584',
            'authKey' => 'test103key',
            'accessToken' => '103-token',
        ],

        '106' => [
            'id' => '106',
            'username' => 'Vitaly',
            'password' => 'khanskaya',
            'authKey' => 'test106key',
            'accessToken' => '106-token',
        ],
        '107' => [
            'id' => '107',
            'username' => 'Boris',
            'password' => 'Bryukhovetskaya',
            'authKey' => 'test107key',
            'accessToken' => '107-token',
        ],
    ];

    /**
     * {@inheritdoc}
     */
    //найти личность
    public static function findIdentity($id) {
        //isset — Определяет, была ли установлена переменная значением, отличным от null
        //Возвращает true, если var определена и её значение отлично от null, и false в противном случае.
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * {@inheritdoc}
     */
    //найти личность по токену доступа
    public static function findIdentityByAccessToken($token, $type = null) {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     * Находит пользователя по имени пользователя
     *
     * @param string $username
     * @return static|null
     */
    //найти по имени пользователя
    public static function findByUsername($username) {
        foreach (self::$users as $user) {
            //strcasecmp-Бинарно-безопасное сравнение строк без учёта регистра
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }
//
//    public static function findByUsername($username) {
//        $usersObj = User::find()->all();
//        $usersArr = ArrayHelper::toArray($usersObj);
//        Yii::warning($usersArr, '$usersArr');
//        foreach ($usersArr as $user) {
//            //$user = ArrayHelper::toArray($userObj);
//            Yii::warning($user, '$user');
//            //strcasecmp-Бинарно-безопасное сравнение строк без учёта регистра
//            if (strcasecmp($user['username'], $username) === 0) {
//                $obj = new static($user);
//                Yii::warning($obj, '$obj');
//                return $obj;
//            }
//        }
//
//        return null;
//    }

    /**
     * {@inheritdoc}
     */
    //получить идентификатор
    public function getId() {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    //получить ключ авторизации
    public function getAuthKey() {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    //подтвердить ключ авторизации
    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     * Проверяет пароль
     *
     * @param string $password password to validate
     * @param string $password пароль для проверки
     * @return bool if password provided is valid for current user
     * @return bool если предоставленный пароль действителен для текущего пользователя
     */
    //подтвердить пароль
    public function validatePassword($password) {
        return $this->password === $password;
    }

}
