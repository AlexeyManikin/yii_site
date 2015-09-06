<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RegruStatData]].
 *
 * @see RegruStatData
 */
class RegruStatDataQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return RegruStatData[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return RegruStatData|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}