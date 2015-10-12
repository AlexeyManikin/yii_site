<?php

namespace app\controllers;

use app\controllers\statistic\StatisticController;
use Yii;
use yii\web\Controller;

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
    public function actionGetDomainCountGraph($zone='ru', $date_start='NOW', $date_end='NOW')
    {
        $controller_statistic = new StatisticController(StatisticController::STATISTIC_DOMAIN, 30);
        $data = $controller_statistic->getDateToGraph($zone, $date_start, $date_end);

        $return_array = array();
        foreach ($data as $item) {
            $value = [
                'id'    => $item['id'],
                'date'  => $item['date'],
                'tld'   => $zone,
                'count' => $item['count']
                ];
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
    public function actionGetNsProviderGraph($provider_id, $date_start='NOW', $date_end='NOW')
    {
        $controller_statistic = new StatisticController(StatisticController::STATISTIC_REGRU, 30);
        $data = $controller_statistic->getDateToGraph($provider_id, $date_start, $date_end);

        $return_array = array();
        foreach ($data as $item) {
            $value = [
                'id'       => $item['id'],
                'date'     => $item['date'],
                'count'    => $item['count'],
                'name'     => $item['obj']->provider->name,
                'type'     => $item['obj']->provider->type,
                'link'     => $item['obj']->provider->link
            ];
            array_push($return_array, $value);
        }

        print_r($return_array);
    }

    /**
     * @param $as
     * @param string $zone
     * @param string $date_start
     * @param string $date_end
     */
    public function actionGetAsGraph($as, $zone='ru', $date_start='NOW', $date_end='NOW')
    {
        $controller_statistic = new StatisticController(StatisticController::STATISTIC_AS, 30);
        $data = $controller_statistic->getDateToGraph($as, $date_start, $date_end, $zone);
        $return_array = [];
        foreach ($data as $item) {

            $provider_info = array(
                'id'          => $item['id'],
                'date'        => $item['date'],
                'as'          => $item['item'],
                'count'       => $item['count'],
                'zone'        => $zone,
                'description' => $item['obj']->aslist->descriptions,
                'country'     => $item['obj']->aslist->country
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
    public function actionGetIpDomainGraph($ip, $zone='ru', $date_start='NOW', $date_end='NOW')
    {
        $controller_statistic = new StatisticController(StatisticController::STATISTIC_A, 30);
        $data = $controller_statistic->getDateToGraph($ip, $date_start, $date_end, $zone);
        $return_array = [];
        foreach ($data as $item) {
            $provider_info = array(
                'id'          => $item['id'],
                'date'        => $item['date'],
                'a'           => $item['item'],
                'count'       => $item['count'],
                'zone'        => $zone,
                'as'          => $item['obj']->asn,
                'description' => $item['obj']->aslist->descriptions,
                'country'     => $item['obj']->aslist->country
            );

            array_push($return_array, $provider_info);
        }

        print_r($return_array);
    }

    /**
     * Необходимо тестирование, в таблице нету данных
     *
     * @param $cname
     * @param string $zone
     * @param string $date_start
     * @param string $date_end
     */
    public function actionGetCnameGraph($cname, $zone='ru', $date_start='NOW', $date_end='NOW')
    {
        $controller_statistic = new StatisticController(StatisticController::STATISTIC_CNAME, 30);
        $data = $controller_statistic->getDateToGraph($cname, $date_start, $date_end, $zone);
        $return_array = [];
        foreach ($data as $item) {
            $provider_info = array(
                'id'          => $item['id'],
                'date'        => $item['date'],
                'cname'       => $item['item'],
                'count'       => $item['count'],
                'zone'        => $zone,
            );

            array_push($return_array, $provider_info);
        }

        print_r($return_array);
    }

    /**
     * @param $mx
     * @param string $zone
     * @param string $date_start
     * @param string $date_end
     */
    public function actionGetMxGraph($mx, $zone='ru', $date_start='NOW', $date_end='NOW')
    {
        $controller_statistic = new StatisticController(StatisticController::STATISTIC_MX, 30);
        $data = $controller_statistic->getDateToGraph($mx, $date_start, $date_end, $zone);
        $return_array = [];
        foreach ($data as $item) {
            $provider_info = array(
                'id'          => $item['id'],
                'date'        => $item['date'],
                'mx'          => $item['item'],
                'count'       => $item['count'],
                'zone'        => $zone,
            );

            array_push($return_array, $provider_info);
        }

        print_r($return_array);
    }

    /**
     * @param $ns
     * @param string $zone
     * @param string $date_start
     * @param string $date_end
     */
    public function actionGetNsGraph($ns, $zone='ru', $date_start='NOW', $date_end='NOW')
    {
        $controller_statistic = new StatisticController(StatisticController::STATISTIC_NS, 30);
        $data = $controller_statistic->getDateToGraph($ns, $date_start, $date_end, $zone);
        $return_array = [];
        foreach ($data as $item) {
            $provider_info = array(
                'id'          => $item['id'],
                'date'        => $item['date'],
                'ns'          => $item['item'],
                'count'       => $item['count'],
                'zone'        => $zone,
            );

            array_push($return_array, $provider_info);
        }

        print_r($return_array);
    }

    /**
     * @param $registrant
     * @param string $zone
     * @param string $date_start
     * @param string $date_end
     */
    public function actionGetRegistrantGraph($registrant, $zone='ru', $date_start='NOW', $date_end='NOW')
    {
        $controller_statistic = new StatisticController(StatisticController::STATISTIC_REGISTRANT, 30);
        $data = $controller_statistic->getDateToGraph($registrant, $date_start, $date_end, $zone);
        $return_array = [];
        foreach ($data as $item) {
            $provider_info = array(
                'id'          => $item['id'],
                'date'        => $item['date'],
                'registrant'  => $item['item'],
                'count'       => $item['count'],
                'zone'        => $zone,
            );

            array_push($return_array, $provider_info);
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
    public function actionGetNsProviderTableStatistic($date_start='NOW', $date_end='NOW')
    {
        $controller_statistic = new StatisticController(StatisticController::STATISTIC_REGRU, 1);
        $data = $controller_statistic->getDateToTable('ru', $date_start, $date_end);
        $return_array = [];
        foreach ($data as $item) {
            $provider_info = array(
                'id'          => $item['id'],
                'name'        => $item['end_item']->provider->name,
                'provider_id' => $item['end_item']->provider->id,
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
    public function actionGetAsTableStatistic($zone='ru', $date_start='NOW', $date_end='NOW')
    {
        $controller_statistic = new StatisticController(StatisticController::STATISTIC_AS, 1);
        $data = $controller_statistic->getDateToTable($zone, $date_start, $date_end);
        $return_array = [];
        foreach ($data as $item) {
            $provider_info = array(
                'id'          => $item['id'],
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
     * @param string $zone
     * @param string $date_start
     * @param string $date_end
     */
    public function actionGetIpDomainTableStatistic($zone='ru', $date_start='NOW', $date_end='NOW')
    {
        $controller_statistic = new StatisticController(StatisticController::STATISTIC_A, 1);
        $data = $controller_statistic->getDateToTable($zone, $date_start, $date_end);
        $return_array = [];
        foreach ($data as $item) {
            $provider_info = array(
                'id'          => $item['id'],
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
     * Необходимо тестирование, в таблице нету данных
     *
     * @param string $zone
     * @param string $date_start
     * @param string $date_end
     */
    public function actionGetCnameTableStatistic($zone='ru', $date_start='NOW', $date_end='NOW')
    {
        $controller_statistic = new StatisticController(StatisticController::STATISTIC_CNAME, 1);
        $data = $controller_statistic->getDateToTable($zone, $date_start, $date_end);
        $return_array = [];
        foreach ($data as $item) {
            $provider_info = array(
                'id'          => $item['id'],
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
     * @param string $zone
     * @param string $date_start
     * @param string $date_end
     */
    public function actionGetMxTableStatistic($zone='ru', $date_start='NOW', $date_end='NOW')
    {
        $controller_statistic = new StatisticController(StatisticController::STATISTIC_MX, 1);
        $data = $controller_statistic->getDateToTable($zone, $date_start, $date_end);
        $return_array = [];
        foreach ($data as $item) {
            $provider_info = array(
                'id'          => $item['id'],
                'mx'          => $item['item'],
                'start_value' => $item['start_count'],
                'end_count'   => $item['end_count'],
                'zone'        => $zone,
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
    public function actionGetNsTableStatistic($zone='ru', $date_start='NOW', $date_end='NOW')
    {
        $controller_statistic = new StatisticController(StatisticController::STATISTIC_NS, 1);
        $data = $controller_statistic->getDateToTable($zone, $date_start, $date_end);
        $return_array = [];
        foreach ($data as $item) {
            $provider_info = array(
                'id'          => $item['id'],
                'ns'          => $item['item'],
                'start_value' => $item['start_count'],
                'end_count'   => $item['end_count'],
                'zone'        => $zone,
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
    public function actionGetRegistrantTableStatistic($zone='ru', $date_start='NOW', $date_end='NOW')
    {
        $controller_statistic = new StatisticController(StatisticController::STATISTIC_REGISTRANT, 1);
        $data = $controller_statistic->getDateToTable($zone, $date_start, $date_end);
        $return_array = [];
        foreach ($data as $item) {
            $provider_info = array(
                'id'          => $item['id'],
                'registrant'  => $item['item'],
                'start_value' => $item['start_count'],
                'end_count'   => $item['end_count'],
                'zone'        => $zone,
            );

            array_push($return_array, $provider_info);
        }

        print_r($return_array);
    }
}
