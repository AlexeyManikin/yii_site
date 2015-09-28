<?php

namespace app\controllers;

use app\controllers\statistic\StatisticController;
use app\models\ACountStatistic;
use app\models\AsCountStatistic;
use app\models\CnameCountStatistic;
use app\models\DomainCountStatistic;
use app\models\MxCountStatistic;
use app\models\NsCountStatistic;
use app\models\RegistrantCountStatistic;
use app\models\RegruStatData;
use DateTime;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @param string $zone
     * @param string $date_start
     * @param string $date_end
     */
    public function actionGetDomainCount($zone='ru', $date_start='NOW', $date_end='NOW')
    {
        $date_array = StatisticController::checkDate($date_start, $date_end, 30,
                                                     StatisticController::STATISTIC_DOMAIN);
        $domain_count = DomainCountStatistic::find()->getZone($zone)
                                                    ->getDateInterval($date_array['start_date'],
                                                                      $date_array['end_date'])
                                                    ->orderBy('id')
                                                    ->all();
        $return_array = array();
        $i = 0;
        foreach ($domain_count as $item) {
            $value = ['id'    => $i++,
                      'date'  => $item->date,
                      'zone'  => $item->tld,
                      'count' => $item->count];
            array_push($return_array, $value);
        }

        print_r($return_array);
    }

    /**
     * Параметры даты 'Y-m-d',
     * только .ru так как собираем данные с REG.RU =)
     *
     * @param string $date_start
     * @param string $date_end
     */
    public function actionGetNsProviderStats($date_start='NOW', $date_end='NOW')
    {
        $controller_statistic = new StatisticController(StatisticController::STATISTIC_REGRU, 1);
        $data = $controller_statistic->getDate('ru', $date_start, $date_end);
        $return_array = [];
        $i = 1;
        foreach ($data as $item) {
            $provider_info = array(
                'id'          => $i++,
                'name'        => $item['end_item']->provider->name,
                'start_value' => $item['start_count'],
                'end_count'   => $item['end_count'],
                'type'        => $item['end_item']->provider->type,
                'link'        => $item['end_item']->provider->link
            );

            array_push($return_array, $provider_info);
        }

        print_r($return_array);
    }

    /**
     * @param string $zone
     * @param string $date_start
     * @param string $date_end
     */
    public function actionGetAsStatistic($zone='ru', $date_start='NOW', $date_end='NOW')
    {
        $controller_statistic = new StatisticController(StatisticController::STATISTIC_AS, 1);
        $data = $controller_statistic->getDate($zone, $date_start, $date_end);
        $return_array = [];
        $i = 1;
        foreach ($data as $item) {
            $provider_info = array(
                'id'          => $i++,
                'as'          => $item['item'],
                'start_value' => $item['start_count'],
                'end_count'   => $item['end_count'],
                'zone'        => $zone,
                'description' => $item['end_item']->aslist->descriptions,
                'country'     => $item['end_item']->aslist->country
            );

            array_push($return_array, $provider_info);
        }

        print_r($return_array);
    }

    /**
     * Необходимо тестирование
     *
     * @param string $zone
     * @param string $date_start
     * @param string $date_end
     */
    public function actionGetIpDomainCount($zone='ru', $date_start='NOW', $date_end='NOW')
    {
        $controller_statistic = new StatisticController(StatisticController::STATISTIC_A, 1);
        $data = $controller_statistic->getDate($zone, $date_start, $date_end);
        $return_array = [];
        $i = 1;
        foreach ($data as $item) {
            $provider_info = array(
                'id'          => $i++,
                'a'           => $item['item'],
                'start_value' => $item['start_count'],
                'end_count'   => $item['end_count'],
                'zone'        => $zone,
                'as'          => $item['end_item']->asn,
                'description' => $item['end_item']->aslist->descriptions,
                'country'     => $item['end_item']->aslist->country
            );

            array_push($return_array, $provider_info);
        }

        print_r($return_array);
    }

    /**
     * Необходимо тестирование
     *
     * @param string $zone
     * @param string $date_start
     * @param string $date_end
     */
    public function actionGetCnameCount($zone='ru', $date_start='NOW', $date_end='NOW')
    {
        $controller_statistic = new StatisticController(StatisticController::STATISTIC_CNAME, 1);
        $data = $controller_statistic->getDate($zone, $date_start, $date_end);
        $return_array = [];
        $i = 1;
        foreach ($data as $item) {
            $provider_info = array(
                'id'          => $i++,
                'cname'       => $item['item'],
                'start_value' => $item['start_count'],
                'end_count'   => $item['end_count'],
                'zone'        => $zone,
            );

            array_push($return_array, $provider_info);
        }

        print_r($return_array);
    }

    /**
     * Необходимо тестирование
     *
     * @param string $zone
     * @param string $date_start
     * @param string $date_end
     */
    public function actionGetMxCount($zone='ru', $date_start='NOW', $date_end='NOW')
    {
        if ($date_end == 'NOW') {
            $date_end = DomainCountStatistic::getLastAvailableDate();
            if ($date_start == 'NOW') {
                $date_end_normal = DateTime::createFromFormat("Y-m-d", $date_end);
                date_sub($date_end_normal, date_interval_create_from_date_string('1 day'));
                $date_start = $date_end_normal->format('Y-m-d');
            }
        }

        $d_start = DateTime::createFromFormat("Y-m-d", $date_start);
        $d_end   = DateTime::createFromFormat("Y-m-d", $date_end);

        if ($d_start > $d_end) {
            # выбрасываем исключение
            echo "Exceptions =))";
            return;
        }

        $start_info = MxCountStatistic::find()->getZone($zone)->getNotMoreDate($date_start)->all();
        $end_info = MxCountStatistic::find()->getZone($zone)->getNotMoreDate($date_end)
            ->orderBy('count DESC')
            ->all();

        $start_count_array = [];
        foreach ($start_info as $start_mx_info) {
            $start_count_array[$start_mx_info->mx] = $start_mx_info->count;
        }

        $return_array = [];
        $i = 1;
        foreach ($end_info as $mx_info) {
            $start_value = 0;
            if (array_key_exists($mx_info->mx, $start_count_array)) {
                $start_value = $start_count_array[$mx_info->mx];
            }

            $provider_info = array(
                'id'          => $i++,
                'mx'          => $mx_info->mx,
                'start_value' => $start_value,
                'end_count'   => $mx_info->count,
                'zone'        => $zone
            );

            array_push($return_array, $provider_info);
        }

        print_r($return_array);
    }

    /**
     * Необходимо тестирование
     *
     * @param string $zone
     * @param string $date_start
     * @param string $date_end
     */
    public function actionGetNsCount($zone='ru', $date_start='NOW', $date_end='NOW')
    {
        if ($date_end == 'NOW') {
            $date_end = DomainCountStatistic::getLastAvailableDate();
            if ($date_start == 'NOW') {
                $date_end_normal = DateTime::createFromFormat("Y-m-d", $date_end);
                date_sub($date_end_normal, date_interval_create_from_date_string('1 day'));
                $date_start = $date_end_normal->format('Y-m-d');
            }
        }

        $d_start = DateTime::createFromFormat("Y-m-d", $date_start);
        $d_end   = DateTime::createFromFormat("Y-m-d", $date_end);

        if ($d_start > $d_end) {
            # выбрасываем исключение
            echo "Exceptions =))";
            return;
        }

        $start_info = NsCountStatistic::find()->getZone($zone)->getNotMoreDate($date_start)->all();
        $end_info = NsCountStatistic::find()->getZone($zone)->getNotMoreDate($date_end)
            ->orderBy('count DESC')
            ->all();

        $start_count_array = [];
        foreach ($start_info as $start_ns_info) {
            $start_count_array[$start_ns_info->ns] = $start_ns_info->count;
        }

        $return_array = [];
        $i = 1;
        foreach ($end_info as $ns_info) {
            $start_value = 0;
            if (array_key_exists($ns_info->ns, $start_count_array)) {
                $start_value = $start_count_array[$ns_info->ns];
            }

            $provider_info = array(
                'id'          => $i++,
                'mx'          => $ns_info->ns,
                'start_value' => $start_value,
                'end_count'   => $ns_info->count,
                'zone'        => $zone
            );

            array_push($return_array, $provider_info);
        }

        print_r($return_array);
    }

    /**
     * Необходимо тестирование
     *
     * @param string $zone
     * @param string $date_start
     * @param string $date_end
     */
    public function actionGetRegistrantCount($zone='ru', $date_start='NOW', $date_end='NOW')
    {
//        if ($date_end == 'NOW') {
//            $date_end = DomainCountStatistic::getLastAvailableDate();
//            if ($date_start == 'NOW') {
//                $date_end_normal = DateTime::createFromFormat("Y-m-d", $date_end);
//                date_sub($date_end_normal, date_interval_create_from_date_string('1 day'));
//                $date_start = $date_end_normal->format('Y-m-d');
//            }
//        }
//
//        $d_start = DateTime::createFromFormat("Y-m-d", $date_start);
//        $d_end   = DateTime::createFromFormat("Y-m-d", $date_end);
//
//        if ($d_start > $d_end) {
//            # выбрасываем исключение
//            echo "Exceptions =))";
//            return;
//        }
//
//        $start_info = RegistrantCountStatistic::find()->getZone($zone)->getNotMoreDate($date_start)->all();
//        $end_info = RegistrantCountStatistic::find()->getZone($zone)->getNotMoreDate($date_end)
//            ->orderBy('count DESC')
//            ->all();
//
//        $start_count_array = [];
//        foreach ($start_info as $start_ns_info) {
//            $start_count_array[$start_ns_info->ns] = $start_ns_info->count;
//        }
//
//        $return_array = [];
//        $i = 1;
//        foreach ($end_info as $ns_info) {
//            $start_value = 0;
//            if (array_key_exists($ns_info->ns, $start_count_array)) {
//                $start_value = $start_count_array[$ns_info->ns];
//            }
//
//            $provider_info = array(
//                'id'          => $i++,
//                'mx'          => $ns_info->ns,
//                'start_value' => $start_value,
//                'end_count'   => $ns_info->count,
//                'zone'        => $zone
//            );
//
//            array_push($return_array, $provider_info);
//        }
//
//        print_r($return_array);
    }
}
