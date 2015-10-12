<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ACountStatistic]].
 *
 * @see ACountStatistic
 */
class ACountStatisticQuery extends AbstractStatisticQuery
{
    /**
     * @return string
     */
    public function getTableName()
    {
        return ACountStatistic::tableName();
    }

    /**
     * @param $item
     * @return $this
     */
    public function getOnlyItem($item)
    {
        $a = $this->getTableName();
        return $this->andWhere("{$a}.a = :a", [':a' => $item]);
    }
}