<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ACountStatistic]].
 *
 * @see ACountStatistic
 */
class ACountStatisticQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return ACountStatistic[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ACountStatistic|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}