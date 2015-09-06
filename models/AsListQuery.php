<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AsList]].
 *
 * @see AsList
 */
class AsListQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return AsList[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return AsList|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}