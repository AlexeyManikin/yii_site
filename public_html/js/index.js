
    //(function(){
    //    //google.load('visualization', '1', {packages: ['corechart', 'line']});
    //    //google.setOnLoadCallback(drawBasic);
    //    //
    //    //function drawBasic() {
    //    //    var data = new google.visualization.DataTable();
    //    //    data.addColumn('number', 'День');
    //    //    data.addColumn('number', 'Домены');
    //    //
    //    //    var jsonData = $.ajax({
    //    //        url: "?r=site/get-domain-count-graph",
    //    //        dataType: "json",
    //    //        async: false
    //    //    }).responseText;
    //    //
    //    //    jsonData = JSON.parse(jsonData);
    //    //    data.addRows(jsonData);
    //    //
    //    //    var options = {
    //    //        chartArea: {
    //    //            left: 21,
    //    //            top: 20,
    //    //            width: '80%'
    //    //
    //    //        },
    //    //        legend: {
    //    //            position: 'none'
    //    //        }
    //    //
    //    //    };
    //    //
    //    //    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
    //    //    chart.draw(data, options);
    //    //}
    //
    //
    //
    //    //var datePicker = $('#date-range0').dateRangePicker(
    //    //    {
    //    //        getValue: function()
    //    //        {
    //    //            return this.innerHTML;
    //    //        },
    //    //        setValue: function(s)
    //    //        {
    //    //            this.innerHTML = s;
    //    //        },
    //    //        separator : ' - ',
    //    //        format: 'DD.MM.YYYY',
    //    //        startOfWeek: 'monday'
    //    //
    //    //    }
    //    //).bind('datepicker-change',function(event,obj)
    //    //{
    //    //    var date1 = "" + obj.date1;
    //    //    var date2 = "" + obj.date2;
    //    //
    //    //    if (date1 === date2) {
    //    //        this.innerHTML = this.innerHTML.slice(0, 10);
    //    //    }
    //    //
    //    //});
    //    //
    //    //var date = new Date();
    //    //var today = date.getDate() + "." + (date.getMonth()+1) + "." + date.getFullYear();
    //    //setTimeout(function(){
    //    //    datePicker.data('dateRangePicker').setDateRange(today,today);
    //    //});
    //
    //
    //}());

    global_table = create_table_type('as');

    function create_table_type(type) {
        if (type == 'as') {
            return $("#datatable").dataTable({
                "nowrap": true,
                "display": "stripe",
                //searching: false,
                "pageLength": 30,
                "lengthChange": false,
                "processing": true,
                "ajax": "?r=site/get-as-table-statistic",
                "language": {
                    "zeroRecords": "Не чего не найдено - возможно Вы сломали поиск",
                    "info": "",
                    "infoEmpty": "Данные обновляются",
                    "search":    "Поиск провайдера:",
                    "paginate": {
                        "first":      "Первая",
                        "last":       "Последняя",
                        "next":       "Следующая",
                        "previous":   "Предыдущая"
                    },
                },
                "aoColumns":[{
                        "sTitle":"№",
                        "data": "id",
                        "mRender": function ( id, type, full )  {
                            return  '<div style="color:black">' + id + '</div>';
                        }
                    },
                    {
                        "sTitle":"AS",
                        "data": "as",
                        "mRender": function ( as, type, full )  {
                            return  '<a href="asinfo">' + as + '</div>';
                        }
                    },
                    {
                        "sTitle":"Описание",
                        "bSortable": false,
                        "data": "description",
                        "mRender": function ( id, type, full )  {
                            return  '<div style="color:black">' + id + '</div>';
                        }
                    },
                    {
                        "sTitle":"Страна",
                        "data": "country",
                        "mRender": function ( id, type, full )  {
                            return  '<div style="color:black">' + id + '</div>';
                        }
                    },
                    {
                        "sTitle":"Количество доменов",
                        "data": "end_count",
                        "mRender": function ( id, type, full )  {
                            return  '<div style="color:black">' + id + '</div>';
                        }
                    },
                    {
                        "sTitle":"Прирост",
                        "data": "diff",
                        "mRender": function ( id, type, full )  {
                            if (id > 0) {
                                return '<div style="color:green">' + id + '</div>';
                            } else {
                                return '<div style="color:red">' + id + '</div>';
                            }
                        }
                    }
                ]
            });
        }
        if (type == 'ip') {
            return $("#datatable").dataTable({
                "nowrap": true,
                "display": "stripe",
                //searching: false,
                "pageLength": 30,
                "lengthChange": false,
                "processing": true,
                "ajax": "?r=site/get-ip-domain-table-statistic",
                "language": {
                    "zeroRecords": "Не чего не найдено - возможно Вы сломали поиск",
                    "info": "",
                    "infoEmpty": "Данные обновляются",
                    "search":    "Поиск IP:",
                    "paginate": {
                        "first":      "Первая",
                        "last":       "Последняя",
                        "next":       "Следующая",
                        "previous":   "Предыдущая"
                    },
                },
                "aoColumns":[{
                        "sTitle":"№",
                        "data": "id",
                        "mRender": function ( id, type, full )  {
                            return  '<div style="color:black">' + id + '</div>';
                        }
                    },
                    {
                        "sTitle":"IP",
                        "data": "a",
                        "mRender": function ( ip, type, full )  {
                            return  '<a href="ipinfo">' + ip + '</div>';
                        }
                    },
                    {
                        "sTitle":"AS",
                        "data": "as",
                        "mRender": function ( as, type, full )  {
                            return  '<a href="asinfo">' + as + '</div>';
                        }
                    },
                    {
                        "sTitle":"Страна",
                        "data": "country",
                        "mRender": function ( id, type, full )  {
                            return  '<div style="color:black">' + id + '</div>';
                        }
                    },
                    {
                        "sTitle":"Количество доменов",
                        "data": "end_count",
                        "mRender": function ( id, type, full )  {
                            return  '<div style="color:black">' + id + '</div>';
                        }
                    },
                    {
                        "sTitle":"Прирост",
                        "data": "diff",
                        "mRender": function ( id, type, full )  {
                            if (id > 0) {
                                return '<div style="color:green">' + id + '</div>';
                            } else {
                                return '<div style="color:red">' + id + '</div>';
                            }
                        }
                    }
                ]
            });
        }
    }


    function delete_style_from_selector() {
        $(".type-list__item_active").removeClass('type-list__item_active');
    }


    function change_table(type) {
        delete_style_from_selector();
        $("#li_table_"+type).addClass('type-list__item_active');
        global_table.DataTable().destroy();
        if (type == 'ip') {
            global_table = create_table_type('ip');
        }

        if (type == 'as') {
            global_table = create_table_type('as');
        }
    }
