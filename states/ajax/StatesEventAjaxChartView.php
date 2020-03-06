
                                      
										<div class="col-md-7">
											
											<div id="eventchartdiv"></div>
										</div>
										
										<div class="col-md-5">
										<div id="eventpiechart"></div>
										</div>
										
										
									</div>										
										
								
								<script>

	$(window).on('load',function() {
	$(".loader").fadeOut('slow');
	});

	function showingLoader(){
	$(".loader").fadeIn(200);
	//$(".loader").fadeOut(1000);
	}
	function hiddingLoader(){
	//$(".loader").fadeIn(200);
	$(".loader").fadeOut(1000);
	}
	

		
		
	var chart = AmCharts.makeChart( "eventchartdiv", {
		"type": "serial",
		"theme": "light",
		"dataProvider": [ <?php foreach($getSunResultEventBooking as $MounthKey=>$PriceVal){?>{
			"country": "<?php echo $MounthKey;?>",
			"visits": "<?=$PriceVal;?>",
		}, <?php }  ?> ],
		"colorField":"#CCCCCC",
		"gridAboveGraphs": true,
		"startDuration": 1,
		"graphs": [ {
			"balloonText": "[[category]]: <b>[[value]]</b>",
			"fillAlphas": 0.8,
			"lineAlpha": 0.2,
			"type": "column",
			"valueField": "visits"
		} ],
		"chartCursor": {
			"categoryBalloonEnabled": false,
			"cursorAlpha": 0,
			"zoomable": false
		},
		"categoryField": "country",
		"categoryAxis": {
			"gridPosition": "start",
			"gridAlpha": 0,
			"tickPosition": "start",
			"tickLength": 20
		},
		"export": {
			"enabled": false
		}

	} );
</script>


<script>
var chart = am4core.create("eventpiechart", am4charts.PieChart);

// Add data
chart.data = [{
  "heading": "Offline Booking",
  "litres": "<?=$BookingOrderCountEventOffline;?>"
}, {
  "heading": "Online Booking",
  "litres": "<?=$BookingOrderCountEventOnline;?>"
}];

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "litres";
pieSeries.dataFields.category = "heading";

pieSeries.ticks.template.disabled = true;
pieSeries.alignLabels = false;
pieSeries.labels.template.text = "{value.percent.formatNumber('#.0')}%";
pieSeries.labels.template.radius = am4core.percent(-40);
pieSeries.labels.template.fill = am4core.color("white");

chart.legend = new am4charts.Legend();

setTimeout(function(){
$("g[aria-labelledby='id-61-title'], textpath, #eventchartdiv a ").hide();
},900);

 $(".datepicker").dateDropper();

</script>