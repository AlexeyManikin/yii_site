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
 * @property AsList $aslist
 */
class AsCountStatistic extends AbstractStatistic
{
    const R_AS_LIST = "aslist";

    /**
     * @return string
     */
    public function getAggregateItem()
    {
        return $this->asn;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'as_count_statistic';
    }

    /**
     * @return AsList
     */
    public function getAslist()
    {
        return $this->hasOne(AsList::className(), ["id" => "asn"]);
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
     * Возвращаем дату последнего обновления информации по NS серверам провайдера
     *
     * @return mixed
     */
    public static function getLastAvailableDate()
    {
        $db = \Yii::$app->db;
        $query = $db->createCommand("SELECT max(date) AS last_date FROM ".DomainCountStatistic::tableName());
        $last_date = $query->queryOne();
        return $last_date['last_date'];
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
