<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[MxCountStatistic]].
 *
 * @see MxCountStatistic
 */
class MxCountStatisticQuery extends AbstractStatisticQuery
{
    /**
     * @return string
     */
    public function getTableName()
    {
        return MxCountStatistic::tableName();
    }
}