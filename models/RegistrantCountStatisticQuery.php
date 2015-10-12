<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RegistrantCountStatistic]].
 *
 * @see RegistrantCountStatistic
 */
class RegistrantCountStatisticQuery extends AbstractStatisticQuery
{
    /**
     * @return string
     */
    public function getTableName()
    {
        return RegistrantCountStatistic::tableName();
    }

    /**
     * @param $item
     * @return $this
     */
    public function getOnlyItem($item)
    {
        $a = $this->getTableName();
        return $this->andWhere("{$a}.registrant = :registrant", [':registrant' => $item]);
    }
}