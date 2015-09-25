<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ns_count_statistic".
 *
 * @property integer $id
 * @property string $date
 * @property string $ns
 * @property string $tld
 * @property integer $count
 */
class NsCountStatistic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ns_count_statistic';
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
            [['ns'], 'string', 'max' => 70],
            [['tld'], 'string', 'max' => 32],
            [['date', 'ns', 'tld'], 'unique', 'targetAttribute' => ['date', 'ns', 'tld'], 'message' => 'The combination of Date, Ns and Tld has already been taken.']
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
            'ns' => 'Ns',
            'tld' => 'Tld',
            'count' => 'Count',
        ];
    }

    /**
     * @inheritdoc
     * @return NsCountStatisticQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NsCountStatisticQuery(get_called_class());
    }
}
