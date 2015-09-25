<?php

namespace app\controllers;

use app\models\DomainCountStatistic;
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
    public function actionIndex2()
    {
        return $this->render('index');
    }

    /**
     * @param string $zone
     * @param string $date_start
     * @param string $date_end
     */
    public function actionGetAsStatistic($zone='.ru', $date_start='NOW', $date_end='NOW')
    {

    }

    /**
     * Параметры даты 'Y-m-d'
     *
     * @param string $date_start
     * @param string $date_end
     */
    public function actionIndex($date_start='NOW', $date_end='NOW')
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
            return;
        }

        $start_info_providers = RegruStatData::find()->getNotMoreDate($date_start)
                                ->with(RegruStatData::R_REGRU_PROVIDERS)->all();
        $end_info_providers = RegruStatData::find()->getNotMoreDate($date_end)
                                ->with(RegruStatData::R_REGRU_PROVIDERS)->orderBy('value DESC')->all();

        $return_array = [];
        $i = 1;
        foreach ($end_info_providers as $provider) {

            $start_value = 0;
            foreach ($start_info_providers as $start_provider) {
                if ($start_provider->provider_id == $provider->provider_id) {
                    $start_value = $start_provider->value;
                }
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
    public function actionCount($zone='.ru', $date_start='NOW', $date_end='NOW')
    {
        if ($date_end == 'NOW') {
            $date_end = DomainCountStatistic::getLastAvailableDate();
            if ($date_start == 'NOW') {
                $date_end_normal = DateTime::createFromFormat("Y-m-d", $date_end);
                date_sub($date_end_normal, date_interval_create_from_date_string('30 day'));
                $date_start = $date_end_normal->format('Y-m-d');
            }
        }

        if (DateTime::createFromFormat("Y-m-d", $date_start) > DateTime::createFromFormat("Y-m-d", $date_end)) {
            # выбрасываем исключение
            return;
        }

        
    }

    /**
     * @param string $zone
     */
    public function actionAllCountDomain($zone='ALL')
    {

    }
}
