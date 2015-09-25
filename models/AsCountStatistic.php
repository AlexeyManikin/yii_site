<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "as_count_statistic".
 *
 * @property integer $id
 * @property string $date
 * @property integer $asn
 * @property string $tld
 * @property integer $count
 */
class AsCountStatistic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'as_count_statistic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'count'], 'required'],
            [['date'], 'safe'],
            [['asn', 'count'], 'integer'],
            [['tld'], 'string', 'max' => 32],
            [['date', 'asn', 'tld'], 'unique', 'targetAttribute' => ['date', 'asn', 'tld'], 'message' => 'The combination of Date, Asn and Tld has already been taken.']
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
            'asn' => 'Asn',
            'tld' => 'Tld',
            'count' => 'Count',
        ];
    }

    /**
     * @inheritdoc
     * @return AsCountStatisticQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AsCountStatisticQuery(get_called_class());
    }
}
