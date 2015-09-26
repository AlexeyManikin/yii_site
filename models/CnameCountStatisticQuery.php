<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[CnameCountStatistic]].
 *
 * @see CnameCountStatistic
 */
class CnameCountStatisticQuery  extends AbstractStatisticQuery
{
    /**
     * @return string
     */
    public function getTableName()
    {
        return CnameCountStatistic::tableName();
    }
}