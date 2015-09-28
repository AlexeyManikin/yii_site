<?php
/**
 *
 *
 * User: Alexey Manikin
 * Date: 27.09.15
 * Time: 2:49
 */

namespace app\models;

use Yii;

abstract class AbstractStatistic extends \yii\db\ActiveRecord
{
    /**
     * @return mixed
     */
    abstract public function getAggregateItem();
}