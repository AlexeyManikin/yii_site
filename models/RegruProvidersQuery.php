<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RegruProviders]].
 *
 * @see RegruProviders
 */
class RegruProvidersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return RegruProviders[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return RegruProviders|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}