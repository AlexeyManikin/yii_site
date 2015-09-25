<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[DomainCountStatistic]].
 *
 * @see DomainCountStatistic
 */
class DomainCountStatisticQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return DomainCountStatistic[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return DomainCountStatistic|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}