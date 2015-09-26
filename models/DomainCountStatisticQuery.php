<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[DomainCountStatistic]].
 *
 * @see DomainCountStatistic
 */
class DomainCountStatisticQuery extends AbstractStatisticQuery
{
    /**
     * @return string
     */
    public function getTableName()
    {
        return DomainCountStatistic::tableName();
    }
}