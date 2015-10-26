<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/css/bootstrap.min.css',
        '/css/index.css',
        '/css/daterangepicker.css',
        'https://cdn.datatables.net/r/bs/jqc-1.11.3,dt-1.10.9,af-2.0.0,fc-3.1.0,fh-3.0.0,kt-2.0.0/datatables.min.css',
        'https://fonts.googleapis.com/css?family=Open+Sans:400,800,700,600,800italic,700italic,600italic,400italic&subset=latin,cyrillic',
    ];
    public $js = [
        'https://www.google.com/jsapi',
        'http://yastatic.net/jquery/2.1.4/jquery.js',
        '/js/moment.min.js',
        '/js/jquery.daterangepicker.js',
        '/js/bootstrap.min.js',
        'https://cdn.datatables.net/r/bs/jqc-1.11.3,dt-1.10.9,af-2.0.0,fc-3.1.0,fh-3.0.0,kt-2.0.0/datatables.min.js',
//        'http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js',
        '/js/index.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
