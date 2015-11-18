google.load('visualization', '1', {'packages':['corechart']});

google.setOnLoadCallback(drawChart);

function drawChart() {
    var data = new google.visualization.DataTable(chartData);

    var options = {
        legend: 'none',
        colors: ['#c0504e', '#edbe4c'],
        enableInteractivity: true,
        width: '100%',
        pointSize: 10,
        pointShape: { 
            type: 'circle'
        },
        vAxis: {
            format: '#,### '+measure
        }
    };
    
    var formatter = new google.visualization.NumberFormat(
        {negativeColor: 'red', negativeParens: true, pattern: '###,### '+measure}
    );
    formatter.format(data, 1);
    if (lines == 2) {
        formatter.format(data, 2);
    }

    var chart = new google.visualization.LineChart(document.getElementById('chart-measurement'));
    chart.draw(data, options);
}

jQuery(window).resize(function(){
    drawChart();
});