<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mx_count_statistic".
 *
 * @property integer $id
 * @property string $date
 * @property string $mx
 * @property string $tld
 * @property integer $count
 */
class MxCountStatistic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mx_count_statistic';
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
            [['mx'], 'string', 'max' => 70],
            [['tld'], 'string', 'max' => 32],
            [['date', 'mx', 'tld'], 'unique', 'targetAttribute' => ['date', 'mx', 'tld'], 'message' => 'The combination of Date, Mx and Tld has already been taken.']
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
            'mx' => 'Mx',
            'tld' => 'Tld',
            'count' => 'Count',
        ];
    }

    /**
     * @inheritdoc
     * @return MxCountStatisticQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MxCountStatisticQuery(get_called_class());
    }
}
