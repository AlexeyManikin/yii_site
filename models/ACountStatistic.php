<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "a_count_statistic".
 *
 * @property integer $id
 * @property string $date
 * @property string $a
 * @property string $tld
 * @property integer $count
 */
class ACountStatistic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'a_count_statistic';
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
            [['a'], 'string', 'max' => 16],
            [['tld'], 'string', 'max' => 32],
            [['date', 'a', 'tld'], 'unique', 'targetAttribute' => ['date', 'a', 'tld'], 'message' => 'The combination of Date, A and Tld has already been taken.']
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
            'a' => 'A',
            'tld' => 'Tld',
            'count' => 'Count',
        ];
    }

    /**
     * @inheritdoc
     * @return ACountStatisticQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ACountStatisticQuery(get_called_class());
    }
}
