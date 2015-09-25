<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RegruStatData]].
 *
 * @see RegruStatData
 * @method RegruStatData one($db=null)
 * @method RegruStatData[] all($db=null)
 */
class RegruStatDataQuery extends \yii\db\ActiveQuery
{
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