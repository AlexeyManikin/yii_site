<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RegistrantCountStatistic]].
 *
 * @see RegistrantCountStatistic
 */
class RegistrantCountStatisticQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return RegistrantCountStatistic[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return RegistrantCountStatistic|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}