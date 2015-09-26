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
}