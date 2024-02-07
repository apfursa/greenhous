<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "datch".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $min
 * @property int|null $max
 * @property string|null $type
 * @property int|null $plataId
 *
 * @property Plata $plata
 * @property Pokazaniya[] $pokazaniyas
 */
class Link extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'link';
    }

    public function rules()
    {
        return [
            [['id', 'linkAddress', 'datchId'], 'safe'], ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'linkAddress' => 'Адрес ссылки',
            'datchId' => 'datchId'
        ];
    }

}
