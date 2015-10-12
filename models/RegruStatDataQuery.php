<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RegruStatData]].
 *
 * @see RegruStatData
 * @method RegruStatData one($db=null)
 * @method RegruStatData[] all($db=null)
 */
class RegruStatDataQuery extends AbstractStatisticQuery
{
    /**
     * @return string
     */
    public function getTableName()
    {
        return RegruStatData::tableName();
    }

    /**
     * Возвращаем данные только определенной зоны
     *
     * @param string $zone
     * @return $this
     */
    public function getZone($zone="ALL")
    {
        return $this;
    }

    /**
     * @param $item
     * @return $this
     */
    public function getOnlyItem($item)
    {
        $a = $this->getTableName();
        return $this->andWhere("{$a}.provider_id = :provider_id", [':provider_id' => $item]);
    }

    /**
     * Выбрать записи со значением не более определенной даты
     *
     * @return $this
     */
    public function getNotMoreDate($date)
    {
        $a = RegruStatData::tableName();
        $db = \Yii::$app->db;
        $query = $db->createCommand("SELECT max(date) AS last_date FROM {$a} WHERE date <= :day",
            [':day' => $date]);
        $last_date = $query->queryOne();

        if (!$last_date) {
            return False;
        }
        $date = $last_date['last_date'];
        return $this->andWhere("date = :day", [':day' => $date]);
    }

}