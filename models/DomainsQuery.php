<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Domains]].
 *
 * @see Domains
 */
class DomainsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Domains[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Domains|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}