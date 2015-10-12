<?php

namespace app\controllers\statistic;

use app\models\AbstractStatistic;
use app\models\AbstractStatisticQuery;
use app\models\ACountStatistic;
use app\models\AsCountStatistic;
use app\models\CnameCountStatistic;
use app\models\DomainCountStatistic;
use app\models\MxCountStatistic;
use app\models\NsCountStatistic;
use app\models\RegistrantCountStatistic;
use app\models\RegruStatData;
use DateTime;
use yii\base\Exception;

/**
 *
 *
 * User: Alexey Manikin
 * Date: 28.09.15
 * Time: 0:02
 */
class StatisticController
{
    const STATISTIC_AS          = 'asstatistic';
    const STATISTIC_A           = 'astatistic';
    const STATISTIC_CNAME       = 'cnamestatistic';
    const STATISTIC_DOMAIN      = 'domainstatistic';
    const STATISTIC_MX          = 'mxstatistic';
    const STATISTIC_NS          = 'nsstatistic';
    const STATISTIC_REGISTRANT  = 'registrantstatistic';
    const STATISTIC_REGRU       = 'regrustatistic';

    private $statisic_type = NULL;
    private $default_interval = 1;

    /**
     * @param string $type
     * @param int $default_interval
     */
    public function __construct($type, $default_interval = 1)
    {
        $this->default_interval = $default_interval;
        $this->statisic_type = $type;
        $this->getQuery();
    }

    /**
     * @return AbstractStatisticQuery
     * @throws Exception
     */
    public function getQuery()
    {
        switch ($this->statisic_type) {
            case StatisticController::STATISTIC_AS:
                return AsCountStatistic::find()->with(AsCountStatistic::R_AS_LIST);
            case StatisticController::STATISTIC_A:
                return ACountStatistic::find()->with(ACountStatistic::R_AS_LIST);
            case StatisticController::STATISTIC_CNAME:
                return CnameCountStatistic::find();
            case StatisticController::STATISTIC_DOMAIN:
                return DomainCountStatistic::find();
            case StatisticController::STATISTIC_MX:
                return MxCountStatistic::find();
            case StatisticController::STATISTIC_NS:
                return NsCountStatistic::find();
            case StatisticController::STATISTIC_REGISTRANT:
                return RegistrantCountStatistic::find();
            case StatisticController::STATISTIC_REGRU:
                return RegruStatData::find()->with(RegruStatData::R_REGRU_PROVIDERS);
        }

        throw new Exception('Not found correct type');
    }

    /**
     * @return AbstractStatisticQuery
     * @throws Exception
     */
    public function getTableName()
    {
        return $this->getQuery()->getTableName();
    }

    /**
     * Возвращаем дату последнего обновления информации
     *
     * @param $table_name
     * @return mixed
     */
    public function getLastAvailableDate($table_name)
    {
        $db = \Yii::$app->db;
        $query = $db->createCommand("SELECT max(date) AS last_date FROM {$table_name}");
        $last_date = $query->queryOne();
        return $last_date['last_date'];
    }

    /**
     * @param string $date_start
     * @param string $date_end
     * @param int $default_interval
     * @param null $type
     * @return array
     * @throws Exception
     */
    static public function checkDate($date_start, $date_end, $default_interval, $type = NULL)
    {
        if ($date_end == 'NOW') {
            if ($type != NULL) {
                $controller = new StatisticController($type);
                $date_end = $controller->getLastAvailableDate($controller->getTableName());
            } else {
                $date_end = date('Y-m-d');
            }

            if ($date_start == 'NOW') {
                $date_end_normal = DateTime::createFromFormat("Y-m-d", $date_end);
                date_sub($date_end_normal, date_interval_create_from_date_string($default_interval." day"));
                $date_start = $date_end_normal->format('Y-m-d');
            }
        }

        $d_start = DateTime::createFromFormat("Y-m-d", $date_start);
        $d_end   = DateTime::createFromFormat("Y-m-d", $date_end);

        if ($d_start > $d_end) {
            throw new Exception('Start date more end date');
        }

        return array(
            'start'      => $d_start,
            'end'        => $d_end,
            'start_date' => $date_start,
            'end_date'   => $date_end,
        );
    }

    /**
     * @param $value
     * @param $date_start
     * @param $date_end
     * @param null $zone
     * @return array
     * @throws Exception
     */
    public function getDateToGraph($value, $date_start, $date_end, $zone = NULL)
    {
        $date_array = StatisticController::checkDate($date_start, $date_end, 30);
        $query  = $this->getQuery();
        if ($zone) {
            $query->getZone($zone);
        }
        $data_count = $query->getOnlyItem($value)
                            ->getDateInterval($date_array['start_date'],
                                             $date_array['end_date'])
                            ->orderBy('id')
                            ->all();
        $return_array = array();
        $i = 0;

        /**
         * @var AbstractStatistic $item
         */
        foreach ($data_count as $item) {
            $value = [
                'id'    => $i++,
                'date'  => $item->date,
                'item'  => $item->getAggregateItem(),
                'count' => $item->count,
                'obj'   => $item];

            array_push($return_array, $value);
        }

        return $return_array;
    }

    /**
     *
     * @param string $zone
     * @param string $date_start
     * @param string $date_end
     * @return array
     * @throws Exception
     */
    public function getDateToTable($zone, $date_start, $date_end)
    {
        $date = StatisticController::checkDate($date_start, $date_end, $this->default_interval);

        $order_column = 'count DESC';
        if ($this->statisic_type == StatisticController::STATISTIC_REGRU) {
            $order_column = 'value DESC';
        }

        $start_info = $this->getQuery()->getZone($zone)->getNotMoreDate($date['start_date'])->all();
        $end_info   = $this->getQuery()->getZone($zone)->getNotMoreDate($date['end_date'])->orderBy($order_column)
                           ->all();

        $start_count_array = [];
        /**
         * @var AbstractStatistic $start_info_item
         */
        foreach ($start_info as $start_info_item) {
            $start_count_array[$start_info_item->getAggregateItem()] = $start_info_item->count;
        }

        $return_array = [];
        $i = 1;
        /**
         * @var AbstractStatistic $end_info_item
         */
        foreach ($end_info as $end_info_item) {
            $start_value = 0;
            if (array_key_exists($end_info_item->getAggregateItem(), $start_count_array)) {
                $start_value = $start_count_array[$end_info_item->getAggregateItem()];
            }

            $provider_info = array(
                'id'          => $i++,
                'item'        => $end_info_item->getAggregateItem(),
                'start_count' => $start_value,
                'end_count'   => $end_info_item->count,
                'end_item'    => $end_info_item,
                'zone'        => $zone,
            );

            array_push($return_array, $provider_info);
        }

        return $return_array;
    }
}