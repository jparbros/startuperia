daily_charts = function(months,avg_value) {
  var chart;
   chart = new Highcharts.Chart({
      chart: {
         renderTo: 'stock-chart',
         defaultSeriesType: 'line',
         marginRight: 130,
         marginBottom: 25
      },
      title: {
         text: 'Daily Average Value',
         x: -20 //center
      },
      xAxis: {
         categories: months
      },
      yAxis: {
         title: {
            text: 'Cost'
         },
         plotLines: [{
            value: 0,
            width: 1,
            color: '#808080'
         }]
      },
      tooltip: {
         formatter: function() {
                   return '<b>'+ this.series.name +'</b><br/>'+
               this.x +': '+ this.y +'Â°C';
         }
      },
      legend: {
         layout: 'vertical',
         align: 'right',
         verticalAlign: 'top',
         x: -10,
         y: 100,
         borderWidth: 0
      },
      series: [{
         name: 'Value',
         data: avg_value
      }]
   });
   
   
};