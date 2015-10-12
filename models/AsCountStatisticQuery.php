<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AsCountStatistic]].
 *
 * @see AsCountStatistic
 */
class AsCountStatisticQuery extends AbstractStatisticQuery
{
    /**
     * @return string
     */
    public function getTableName()
    {
        return AsCountStatistic::tableName();
    }

    /**
     * @param $item
     * @return $this
     */
    public function getOnlyItem($item)
    {
        $a = $this->getTableName();
        return $this->andWhere("{$a}.asn = :asn", [':asn' => $item]);
    }
}