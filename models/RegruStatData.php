<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "regru_stat_data".
 *
 * @property integer $id
 * @property string $date
 * @property integer $provider_id
 * @property integer $value
 * @property integer $count
 * @property RegruProviders $provider
 */

class RegruStatData extends AbstractStatistic
{
    const R_REGRU_PROVIDERS = "provider";

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'regru_stat_data';
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getAggregateItem()
    {
        return $this->provider->name;
    }

    /**
     * @return RegruProviders
     */
    public function getProvider()
    {
        return $this->hasOne(RegruProviders::className(), ["id" => "provider_id"]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'value'], 'required'],
            [['date'], 'safe'],
            [['provider_id', 'value'], 'integer']
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
            'provider_id' => 'Provider ID',
            'value' => 'Value',
            'count' => 'Count'
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
        $query = $db->createCommand("SELECT max(date) AS last_date FROM regru_stat_data");
        $last_date = $query->queryOne();
        return $last_date['last_date'];
    }

    /**
     * @inheritdoc
     * @return RegruStatDataQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RegruStatDataQuery(get_called_class());
    }
}
