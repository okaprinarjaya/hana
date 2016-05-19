function request_data()
{
    spinner.spin(target);

    $.ajax({
        url: base_url+'reports_service/ticket_transactions',
        type: 'GET',
        dataType: 'json',
        data: {}
    }).done(function(data) {
        spinner.stop(target);
        
        window.chart.xAxis[0].setCategories(data.content[0]);

        for (var i=1; i<=3; i++) {
            window.chart.addSeries(data.content[i]);
        }

    }).fail(function(data) {
        alert('Failed requesting data');
    });

 
}

$(document).ready(function () {
    window.chart = new Highcharts.Chart({
        chart: {
            renderTo: 'line',
            type: 'column',
            events: {
                load: request_data
            }
        },
        title: {
            text: 'Ticket transaction chart'
        },
        xAxis: {
            categories: []
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total created tickets'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        legend: {
            align: 'right',
            x: -70,
            verticalAlign: 'top',
            y: 20,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
            formatter: function() {
                return '<b>'+ this.x +'</b><br/>'+
                    this.series.name +': '+ this.y +'<br/>'+
                    'Total: '+ this.point.stackTotal;
            }
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                    style: {
                        textShadow: '0 0 3px black, 0 0 3px black'
                    }
                }
            }
        },
        series: []
    });

});
    
