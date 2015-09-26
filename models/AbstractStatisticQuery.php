<?php

namespace app\models;

/**
 * @see ACountStatistic
 */
abstract class AbstractStatisticQuery extends \yii\db\ActiveQuery
{
    /**
     * @return mixed
     */
    public abstract function getTableName();

    /**
     * Выбрать записи со значением не более определенной даты
     *
     * @return $this
     */
    public function getNotMoreDate($date)
    {
        $a = $this->getTableName();
        $db = \Yii::$app->db;
        $query = $db->createCommand("SELECT max(date) AS last_date FROM {$a} WHERE date <= :day", [':day' => $date]);
        $last_date = $query->queryOne();

        if (!$last_date) {
            return False;
        }

        $date = $last_date['last_date'];
        return $this->andWhere("date = :day", [':day' => $date]);
    }

    /**
     * @param $start_date
     * @param $end_date
     * @return $this
     */
    public function getDateInterval($start_date, $end_date)
    {
        $a = $this->getTableName();
        $this->andWhere("{$a}.date >= :date_start", [':date_start' => $start_date]);
        $this->andWhere("{$a}.date <= :end_date", [':end_date' => $end_date]);
        return $this;
    }

    /**
     * Возвращаем данные только определенной зоны
     *
     * @param string $zone
     * @return $this
     */
    public function getZone($zone="ALL")
    {
        if ($zone == "ALL") {
            return $this;
        }

        $a = $this->getTableName();
        return $this->andWhere("{$a}.tld = :tld", [':tld' => $zone]);
    }


    /**
     * @inheritdoc
     * @return \yii\db\ActiveQuery[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \yii\db\ActiveQuery|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}