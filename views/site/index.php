<?php

/* @var $this yii\web\View */

$this->title = 'Domain statistic';
?>
<main class="clearfix">
    <div class="topline">
        <div class="container">
            <div class="col-lg-12">
                <h2><em>First<strong class="text-blue">Stat</strong>.ru</em></h2><span>TOP провайдеров для зон .ru .su .рф</span>
            </div>
        </div>
    </div>
    <div class="menu">
        <div class="container">

            <div >

                <div class="navbar navbar-default navbar-blue">

                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div id="navbar" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li <?php if ($zone == 'ru') echo "class=\"active\""; ?>><a href="/ru">Зона .RU</a></li>
                            <li <?php if ($zone == 'su') echo "class=\"active\""; ?>><a href="/su">Зона .SU</a></li>
                            <li <?php if ($zone == 'rf') echo "class=\"active\""; ?>><a href="/rf">Зона .РФ</a></li>
<!--                            <li><a href="/history">История изменения DNS для домена</a></li>-->
                        </ul>
                    </div>
                </div>
            </div>
<!--            <div class="col-lg-4">-->
<!--                <div class="radio select-box">-->
<!--                    <div class="select-box__item select-box__item_active">-->
<!--                        <label class="select-box__label" for="hosting">-->
<!--                            <input class="select-box__radio" type="radio" id="hosting" name="provider" value="hosting" checked>-->
<!--                            <span>Только хостинг-провайдеры</span>-->
<!--                        </label>-->
<!--                    </div>-->
<!--                    <div class="select-box__item">-->
<!--                        <label class="select-box__label" for="all">-->
<!--                            <input class="select-box__radio" type="radio" id="all" name="provider" value="all">-->
<!--                            <span>Все</span>-->
<!--                        </label>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->


        </div>
    </div>
    <div class="main">
        <div class="container">
            <div class="sidebar col-lg-3">
                <h3>Как считать?</h3>
                <ul class="type-list">
<!--                  <li class=\"type-list__item type-list__item_active\"><a href=\"#1\">По провайдерам</a></li>"; -->
                    <li class="type-list__item type-list__item_active" id="li_table_as"><a id="table_as" href="#" onclick="change_table('as'); return false;">По автономным системам</a></li>
<!--                    <li class="type-list__item"><a href="#2">По NS серверам</a></li>-->
<!--                    <li class="type-list__item"><a href="#3">По MX серверам</a></li>-->
                    <li class="type-list__item" id="li_table_ip"><a id="table_ip" href="#" onclick="change_table('ip'); return false;">По IP адресам</a></li>
<!--                    <li class="type-list__item"><a href="#3">По CNAME записям</a></li>-->
<!--                    <li class="type-list__item"><a href="#3">По Регистраторам</a></li>-->
                </ul>

<!--                <h3>Прирост доменов</h3>-->
<!--                <div id="chart_div"></div>-->
                <br><br>
                <div class="how">
                    <h3>Как это работает?</h3>
                    <p>
                        Проект по сбору статистики выложен в <a href="https://github.com/AlexeyManikin/domain_statistic"
                        target="github">opensource</a>. Каждую ночь запрашиваются список актуальных доменов для зон .ru .su .рф и далее
                        для каждого домена опрашивается DNS сервер. Агрегируемая статистика как раз и представлена на данном сайте.
                    </p>
                    <p>
                        Если Вы нашли грубую ошибку <a href="mailto: alexey@beget.ru">напишите мне</a>.
                    </p>
                </div>
            </div>

            <div class="col-lg-9">


<!--                <div class="col-lg-9">-->
<!--                    <p>-->
<!--                        Статистика за <a id="date-range0"></a> или <a href="#1">за вчера</a>, <a href="#2">за прошлый месяц</a>-->
<!--                    </p>-->
<!--                </div>-->
<!--                <div class="col-lg-3">-->
<!--                    <div class="input-group">-->
<!--                        <input type="text" class="form-control" placeholder="Фильтр">-->
<!--                        <span class="input-group-addon"><i class="glyphicon glyphicon-remove"></i></span>-->
<!--                    </div>-->
<!--                </div>-->
                <br>

                <table class="table provider-list" id="datatable">
                    <thead>
<!--                    <tr>-->
<!--                        <th>№</th>-->
<!--                        <th>Провайдер</th>-->
<!--                        <th>Кол-во доменов</th>-->
<!--                        <th>% доменов</th>-->
<!--                        <th>Доля рынка</th>-->
<!--                        <th>Прирост</th>-->
<!--                        <th>% роста</th>-->
<!--                    </tr>-->
<!--                    </thead>-->
<!--                    <tr>-->
<!--                        <th>1</th>-->
<!--                        <td><a href="./stat-in.html">Beget.ru</a></td>-->
<!--                        <td>123354</td>-->
<!--                        <td>3</td>-->
<!--                        <td>4</td>-->
<!--                        <td class="up">+111</td>-->
<!--                        <td class="up">5</td>-->
<!--                    </tr><tr>-->
<!--                        <th>1</th>-->
<!--                        <td><a href="#">Timeweb.ru</a></td>-->
<!--                        <td>123354</td>-->
<!--                        <td>3</td>-->
<!--                        <td>4</td>-->
<!--                        <td class="down">-111</td>-->
<!--                        <td class="down">-5</td>-->
<!--                    </tr>-->
                </table>

<!--                <div class="table-nav">-->
<!--                    <ul class="pagination">-->
<!--                        <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true"><i class="glyphicon glyphicon-arrow-left"></i> Предыдущая</span></a></li>-->
<!--                        <li><span class="text-black">1/2</span></li>-->
<!--                        <li><a href="#" aria-label="Next"><span aria-hidden="true">Следующая <i class="glyphicon glyphicon-arrow-right"></i></span></a></li>-->
<!--                    </ul>-->
<!---->
<!---->
<!--                </div>-->
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</main>