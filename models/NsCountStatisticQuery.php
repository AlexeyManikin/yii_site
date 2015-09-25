<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[NsCountStatistic]].
 *
 * @see NsCountStatistic
 */
class NsCountStatisticQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return NsCountStatistic[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return NsCountStatistic|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}