<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[MxCountStatistic]].
 *
 * @see MxCountStatistic
 */
class MxCountStatisticQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return MxCountStatistic[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return MxCountStatistic|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}