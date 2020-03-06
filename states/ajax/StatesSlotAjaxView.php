
		
	<div class="collapse show" id="reportsCollapse">
								<div class="cus_modal_body row">
<div class="form-group selectdiv is-filled col-md-3"style="margin-left:17px;">
												<label for="exampleSelect1" class="bmd-label-floating">Please Select Sports</label>
												  <select class="form-control slot_port_id" id="batch_sport_id" name="book_sport_id">
                                            <option value="">Please select sport</option>
                                            <?php 
											if (isset($sport_list) && !empty($sport_list)) {
                                               foreach ($sport_list as $sportlists) { ?>
                                            <option value="<?=$sportlists->sport_id;?>" <?php if($sportlists->sport_id==@$sport_details->sport_id) echo "selected"; ?>><?=$sportlists->sport_name;?></option>
                                                
                                                   <?php  }
                                                    } ?>
                                            </select>
												<i class="fas fa-calendar-alt prefix"></i>
											</div>	


     <div class="col-md-3">
      <div class="form-group bmd-form-group">
       <label for="end date" class="bmd-label-floating">Please Select Year<span class="required">*</span></label>
       <select class="form-control" id="states_year">
       	<option>2020</option>
       	<option>2019</option>
       	<option>2018</option>
       	<option>2017</option>
       </select>
       <i class="fa fa-calendar prefix" aria-hidden="true"></i>
       <span id="errEnddate" class="error"> </span>
     </div>
   </div>

   <li class="list-inline-item ">
									<div class="btn-container">
										<a href="javascript:void(0)" class="btn btn-raised btn-sm btn_proceed search_btn" id="slot_search"><i class="fa fa-search"></i> Search</a>
									</div>
								</li>

</div>


 
									<div class="row" id="statusAjaxchart">
									
                                      
										<div class="col-md-7">
											
											<div id="chartdiv"></div>
										</div>
										
										<div class="col-md-5">
										<div id="piechart"></div>
										</div>
										
										
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
	

		
		
	var chart = AmCharts.makeChart( "chartdiv", {
		"type": "serial",
		"theme": "light",
		"dataProvider": [ <?php foreach($getSunResultLimitBooking as $MounthKey=>$PriceVal){?>{
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
var chart = am4core.create("piechart", am4charts.PieChart);

// Add data
chart.data = [{
  "heading": "Offline Booking",
  "litres": "<?=$BookingOrderCountOffline;?>"
}, {
  "heading": "Online Booking",
  "litres": "<?=$BookingOrderCountOnline;?>"
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
$("g[aria-labelledby='id-61-title'], textpath, #chartdiv a ").hide();
},900);

 $(".datepicker").dateDropper();

$(document).ready(function(){
	$(document).on('click','#slot_search',function(){
		var book_sport_id= $('#batch_sport_id').val();
		var states_year= $('#states_year').val();
		var fac_ids=$('#headeracademyfacility option:selected').val();
		$.ajax({
			 type : "POST",
			 url : "<?=base_url('facility/states/StatesSlotAjax');?>",
			 data : {book_sport_id:book_sport_id,states_year:states_year,fac_ids:fac_ids},
			 success:function(res){
				$("#statusAjaxchart").html(res['_html']);
			 }
		});
		 
	});
});
</script>


