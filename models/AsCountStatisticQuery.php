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
}