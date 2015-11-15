google.load('visualization', '1', {'packages':['corechart']});

google.setOnLoadCallback(drawChartHeart);
//google.setOnLoadCallback(drawChartPressure);
google.setOnLoadCallback(drawChartTemp);
//google.setOnLoadCallback(drawChartRespiratory);
//google.setOnLoadCallback(drawChartWeight);


function drawChartHeart() {
    var data = new google.visualization.DataTable(chartDataHeart);

    var options = {
        legend: 'none',
        colors: ['#2cbc24'],
        enableInteractivity: true,
        width: '100%',
        pointSize: 10,
        pointShape: { 
            type: 'circle'
        },
//        vAxis: {
//            format: '#,### '+measureHeart
//        }
    };
    
    var formatter = new google.visualization.NumberFormat(
         {negativeColor: 'red', negativeParens: true, pattern: '###,### '+measureHeart});
        formatter.format(data, 1);  

    var chart = new google.visualization.LineChart(document.getElementById('dp-chart-heart'));
    chart.draw(data, options);
}

function drawChartTemp() {
    var data = new google.visualization.DataTable(chartDataTemp);

    var options = {
        legend: 'none',
        colors: ['#2cbc24'],
        enableInteractivity: true,
        width: '100%',
        pointSize: 10,
        pointShape: { 
            type: 'circle'
        },
//        vAxis: {
//            format: '#,### '+measureTemp
//        }
    };
    
    var formatter = new google.visualization.NumberFormat(
         {negativeColor: 'red', negativeParens: true, pattern: '###,### '+measureTemp});
        formatter.format(data, 1);  

    var chart = new google.visualization.LineChart(document.getElementById('dp-chart-temp'));
    chart.draw(data, options);
}

jQuery(window).resize(function(){
    drawChartHeart();
    drawChartTemp();
});