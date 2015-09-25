<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AsCountStatistic]].
 *
 * @see AsCountStatistic
 */
class AsCountStatisticQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return AsCountStatistic[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return AsCountStatistic|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}