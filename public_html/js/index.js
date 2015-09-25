
    (function(){
        google.load('visualization', '1', {packages: ['corechart', 'line']});
        google.setOnLoadCallback(drawBasic);

        function drawBasic() {
            var data = new google.visualization.DataTable();
            data.addColumn('number', 'X');
            data.addColumn('number', 'Домены');

            data.addRows([
                [0, 120000],   [38, 123354],  [69, 133354]
            ]);

            var options = {
                chartArea: {
                    left: 21,
                    top: 20,
                    width: '80%'

                },
                legend: {
                    position: 'none'
                }

            };

            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }

        var datePicker = $('#date-range0').dateRangePicker(
            {
                getValue: function()
                {
                    return this.innerHTML;
                },
                setValue: function(s)
                {
                    this.innerHTML = s;
                },
                separator : ' - ',
                format: 'DD.MM.YYYY',
                startOfWeek: 'monday'

            }
        ).bind('datepicker-change',function(event,obj)
        {
            var date1 = "" + obj.date1;
            var date2 = "" + obj.date2;

            if (date1 === date2) {
                this.innerHTML = this.innerHTML.slice(0, 10);
            }

        });

        var date = new Date();
        var today = date.getDate() + "." + (date.getMonth()+1) + "." + date.getFullYear();

        setTimeout(function(){
            datePicker.data('dateRangePicker').setDateRange(today,today);
        });

    }());

    (function(){
        var container = document.querySelector('.chart__graph');
        if (container !== null)  {
            google.load('visualization', '1', {packages: ['corechart', 'line']});
            google.setOnLoadCallback(drawBasic);
            function drawBasic() {

                var data = new google.visualization.DataTable();
                data.addColumn('number', 'X');
                data.addColumn('number', 'Домены');

                data.addRows([
                    [0, 120000],   [38, 123354],  [69, 133354]
                ]);

                var options = {
                    chartArea: {
                        left: 60,
                        top: 20,
                        width: '80%'

                    },
                    legend: {
                        position: 'none'
                    }

                };

                var chart = new google.visualization.LineChart(container);
                chart.draw(data, options);
            }
        }
    }());
