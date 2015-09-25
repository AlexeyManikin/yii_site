<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "registrant_count_statistic".
 *
 * @property integer $id
 * @property string $date
 * @property string $registrant
 * @property string $tld
 * @property integer $count
 */
class RegistrantCountStatistic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'registrant_count_statistic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'count'], 'required'],
            [['date'], 'safe'],
            [['count'], 'integer'],
            [['registrant'], 'string', 'max' => 70],
            [['tld'], 'string', 'max' => 32],
            [['date', 'registrant', 'tld'], 'unique', 'targetAttribute' => ['date', 'registrant', 'tld'], 'message' => 'The combination of Date, Registrant and Tld has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'registrant' => 'Registrant',
            'tld' => 'Tld',
            'count' => 'Count',
        ];
    }

    /**
     * @inheritdoc
     * @return RegistrantCountStatisticQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RegistrantCountStatisticQuery(get_called_class());
    }
}
