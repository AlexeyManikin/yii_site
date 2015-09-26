<?php

namespace app\controllers;

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
    public function actionGetAsStatistic($zone='ru', $date_start='NOW', $date_end='NOW')
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

        $start_info = AsCountStatistic::find()->getZone($zone)->getNotMoreDate($date_start)->all();
        $end_info = AsCountStatistic::find()->getZone($zone)->getNotMoreDate($date_end)
                                            ->with(AsCountStatistic::R_AS_LIST)
                                            ->orderBy('count DESC')
                                            ->all();

        $start_count_array = [];
        foreach ($start_info as $start_asn_info) {
            $start_count_array[$start_asn_info->asn] = $start_asn_info->count;
        }

        $return_array = [];
        $i = 1;
        foreach ($end_info as $as_info) {
            $start_value = 0;
            if (array_key_exists($as_info->asn, $start_count_array)) {
                $start_value = $start_count_array[$as_info->asn];
            }

            $provider_info = array(
                'id'          => $i++,
                'as'          => $as_info->asn,
                'start_value' => $start_value,
                'end_count'   => $as_info->count,
                'zone'        => $zone,
                'description' => $as_info->aslist->descriptions,
                'country'     => $as_info->aslist->country,
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
    public function actionGetNsProviderStats($date_start='NOW', $date_end='NOW')
    {
        if ($date_end == 'NOW') {
            $date_end = RegruStatData::getLastAvailableDate();
            if ($date_start == 'NOW') {
                $date_end_normal = DateTime::createFromFormat("Y-m-d", $date_end);
                date_sub($date_end_normal, date_interval_create_from_date_string('1 day'));
                $date_start = $date_end_normal->format('Y-m-d');
            }
        }

        if (DateTime::createFromFormat("Y-m-d", $date_start) > DateTime::createFromFormat("Y-m-d", $date_end)) {
            # выбрасываем исключение
            echo "Exceptions =))";
            return;
        }

        $start_info_providers = RegruStatData::find()->getNotMoreDate($date_start)->all();
        $end_info_providers = RegruStatData::find()->getNotMoreDate($date_end)
                                ->with(RegruStatData::R_REGRU_PROVIDERS)->orderBy('value DESC')->all();

        $start_count_array = [];
        foreach ($start_info_providers as $start_provider) {
            $start_count_array[$start_provider->provider_id] = $start_provider->value;
        }

        $return_array = [];
        $i = 1;
        foreach ($end_info_providers as $provider) {
            $start_value = 0;
            if (array_key_exists($provider->provider_id, $start_count_array)) {
                $start_value = $start_count_array[$provider->value];
            }

            $provider_info = array(
                'id'          => $i++,
                'name'        => $provider->provider->name,
                'start_value' => $start_value,
                'end_count'   => $provider->value,
                'type'        => $provider->provider->type,
                'link'        => $provider->provider->link
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
    public function actionGetDomainCount($zone='ru', $date_start='NOW', $date_end='NOW')
    {
        if ($date_end == 'NOW') {
            $date_end = DomainCountStatistic::getLastAvailableDate();
            if ($date_start == 'NOW') {
                $date_end_normal = DateTime::createFromFormat("Y-m-d", $date_end);
                date_sub($date_end_normal, date_interval_create_from_date_string('30 day'));
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

        $domain_count = DomainCountStatistic::find()->getZone($zone)
                                                    ->getDateInterval($date_start, $date_end)
                                                    ->orderBy('id')
                                                    ->all();

        $return_array = array();

        $i = 0;
        foreach ($domain_count as $c) {
            $value = ['id'=> $i++,
                      'date' => $c->date,
                      'zone' => $zone,
                      'count' => $c->count];

            array_push($return_array, $value);
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

        $start_info = ACountStatistic::find()->getZone($zone)->getNotMoreDate($date_start)->all();
        $end_info = ACountStatistic::find()->getZone($zone)->getNotMoreDate($date_end)
            ->with(ACountStatistic::R_AS_LIST)
            ->orderBy('count DESC')
            ->all();

        $start_count_array = [];
        foreach ($start_info as $start_asn_info) {
            $start_count_array[$start_asn_info->a] = $start_asn_info->count;
        }

        $return_array = [];
        $i = 1;
        foreach ($end_info as $ip_info) {
            $start_value = 0;
            if (array_key_exists($ip_info->a, $start_count_array)) {
                $start_value = $start_count_array[$ip_info->a];
            }

            $provider_info = array(
                'id'          => $i++,
                'a'           => $ip_info->a,
                'start_value' => $start_value,
                'end_count'   => $ip_info->count,
                'zone'        => $zone,
                'as'          => $ip_info->asn,
                'description' => $ip_info->aslist->descriptions,
                'country'     => $ip_info->aslist->country,
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

        $start_info = CnameCountStatistic::find()->getZone($zone)->getNotMoreDate($date_start)->all();
        $end_info = CnameCountStatistic::find()->getZone($zone)->getNotMoreDate($date_end)
                                               ->orderBy('count DESC')
                                               ->all();

        $start_count_array = [];
        foreach ($start_info as $start_asn_info) {
            $start_count_array[$start_asn_info->cname] = $start_asn_info->count;
        }

        $return_array = [];
        $i = 1;
        foreach ($end_info as $cname_info) {
            $start_value = 0;
            if (array_key_exists($cname_info->cname, $start_count_array)) {
                $start_value = $start_count_array[$cname_info->cname];
            }

            $provider_info = array(
                'id'          => $i++,
                'cname'       => $cname_info->cname,
                'start_value' => $start_value,
                'end_count'   => $cname_info->count,
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
