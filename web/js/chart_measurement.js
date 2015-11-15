google.load('visualization', '1', {'packages':['corechart']});

google.setOnLoadCallback(drawChart);

function drawChart() {
    var data = new google.visualization.DataTable(chartData);

    var options = {
        legend: 'none',
        colors: ['#2cbc24'],
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
         {negativeColor: 'red', negativeParens: true, pattern: '###,### '+measure});
        formatter.format(data, 1);  

    var chart = new google.visualization.LineChart(document.getElementById('chart-measurement'));
    chart.draw(data, options);
}

jQuery(window).resize(function(){
    drawChart();
});