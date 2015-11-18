google.load('visualization', '1', {'packages':['corechart']});
google.setOnLoadCallback(drawChartHeart);
google.setOnLoadCallback(drawChartPressure);
google.setOnLoadCallback(drawChartTemp);
google.setOnLoadCallback(drawChartRespiratory);
google.setOnLoadCallback(drawChartWeight);


function drawChartHeart() {
    var data = new google.visualization.DataTable(chartDataHeart);

    var options = {
        legend: 'none',
        colors: ['#ed3c18'],
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

function drawChartPressure() {
    var data = new google.visualization.DataTable(chartDataPressure);

    var options = {
        legend: 'none',
        colors: ['#6395a6', '#edbe4c'],
        enableInteractivity: true,
        width: '100%',
        pointSize: 10,
        pointShape: { 
            type: 'circle'
        },
    };
    
    var formatter = new google.visualization.NumberFormat(
        {negativeColor: 'red', negativeParens: true, pattern: '###,### '+measurePressure}
    );
    formatter.format(data, 1);
    formatter.format(data, 2);

    var chart = new google.visualization.LineChart(document.getElementById('dp-chart-pressure'));
    chart.draw(data, options);
}

function drawChartTemp() {
    var data = new google.visualization.DataTable(chartDataTemp);

    var options = {
        legend: 'none',
        colors: ['#c0504e'],
        enableInteractivity: true,
        width: '100%',
        pointSize: 10,
        pointShape: { 
            type: 'circle'
        },
        curveType: 'function',
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

function drawChartRespiratory() {
    var data = new google.visualization.DataTable(chartDataRespiratory);

    var options = {
        legend: 'none',
        colors: ['#5f98ca'],
        enableInteractivity: true,
        width: '100%',
    };
    
    var formatter = new google.visualization.NumberFormat(
         {negativeColor: 'red', negativeParens: true, pattern: '###,### '+measureRespiratory});
        formatter.format(data, 1);  

    var chart = new google.visualization.ColumnChart(document.getElementById('dp-chart-respiratory'));
    chart.draw(data, options);
}
function drawChartWeight() {
    var data = new google.visualization.DataTable(chartDataWeight);

    var options = {
        legend: 'none',
        colors: ['#2cbc24'],
        enableInteractivity: true,
        width: '100%',
        pointSize: 10,
        pointShape: { 
            type: 'circle'
        },
        lineDashStyle: [7, 2, 4, 3]
//        vAxis: {
//            format: '#,### '+measureTemp
//        }
    };
    
    var formatter = new google.visualization.NumberFormat(
         {negativeColor: 'red', negativeParens: true, pattern: '###,### '+measureWeight});
        formatter.format(data, 1);  

    var chart = new google.visualization.LineChart(document.getElementById('dp-chart-weight'));
    chart.draw(data, options);
}
jQuery(window).resize(function(){
    drawChartHeart();
    drawChartTemp();
    drawChartPressure();
    drawChartRespiratory();
    drawChartWeight();
});