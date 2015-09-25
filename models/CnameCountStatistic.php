<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cname_count_statistic".
 *
 * @property integer $id
 * @property string $date
 * @property string $cname
 * @property string $tld
 * @property integer $count
 */
class CnameCountStatistic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cname_count_statistic';
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
            [['cname'], 'string', 'max' => 55],
            [['tld'], 'string', 'max' => 32],
            [['date', 'cname', 'tld'], 'unique', 'targetAttribute' => ['date', 'cname', 'tld'], 'message' => 'The combination of Date, Cname and Tld has already been taken.']
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
            'cname' => 'Cname',
            'tld' => 'Tld',
            'count' => 'Count',
        ];
    }

    /**
     * @inheritdoc
     * @return CnameCountStatisticQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CnameCountStatisticQuery(get_called_class());
    }
}
