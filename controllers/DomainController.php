<?php

namespace app\controllers;

use yii\web\Controller;

class DomainController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGetDomainHistory($fqdn)
    {

    }

}
