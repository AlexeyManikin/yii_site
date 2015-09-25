<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "domain_count_statistic".
 *
 * @property integer $id
 * @property string $date
 * @property string $tld
 * @property integer $count
 */
class DomainCountStatistic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'domain_count_statistic';
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
            [['tld'], 'string', 'max' => 32],
            [['date', 'tld'], 'unique', 'targetAttribute' => ['date', 'tld'], 'message' => 'The combination of Date and Tld has already been taken.']
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
     * @return DomainCountStatisticQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DomainCountStatisticQuery(get_called_class());
    }
}
