<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proekt".
 *
 * @property int $id
 * @property float|null $tempIn
 * @property float|null $tempOut
 * @property float|null $deltat
 * @property float|null $sred
 * @property float|null $tempOkr
 * @property float|null $delT
 */
class Proekt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proekt_2';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tempIn', 'tempOut', 'deltat', 'sred', 'tempOkr', 'delT'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tempIn' => 'Temp In',
            'tempOut' => 'Temp Out',
            'deltat' => 'Deltat',
            'sred' => 'Sred',
            'tempOkr' => 'Temp Okr',
            'delT' => 'Del T',
        ];
    }
}
