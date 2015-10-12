<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[NsCountStatistic]].
 *
 * @see NsCountStatistic
 */
class NsCountStatisticQuery extends AbstractStatisticQuery
{
    /**
     * @return string
     */
    public function getTableName()
    {
        return NsCountStatistic::tableName();
    }

    /**
     * @param $item
     * @return $this
     */
    public function getOnlyItem($item)
    {
        $a = $this->getTableName();
        return $this->andWhere("{$a}.ns = :ns", [':ns' => $item]);
    }
}