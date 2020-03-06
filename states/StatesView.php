<!DOCTYPE html>
<html>
<head>
	<title>Social Sportz</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1.0, user-scalable=no">
	<meta name="MobileOptimized" content="width">
	<meta name="HandheldFriendly" content="true">
	<meta http-equiv="x-ua-compatible" content="IE=edge">
	<!-- Fonts For Heading & SubHeadings -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<?php $this->load->view('public/common/head');?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="<?=base_url('assets/public/css/datedropper.min.css')?>">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">	
<style>
#chartdiv{width:100%; height:400px;}
#piechart{width:300px; height:400px;}

#chartdiv a{display:none !important;}

#chartdivs{width:100%; height:400px;}
#piecharts{width:300px; height:400px;}


#chartdivs a{display:none !important;}

#eventpiechart{width:300px; height:400px;}
#eventchartdiv{width:100%; height:400px;}
#eventchartdiv a{display:none !important;}


</style>
</head>

<body class="dashboard sidebar-is-expanded">
	<div class="clearfix"></div>
	
	<?php $this->load->view('public/common/dashboard-sidebar');?>
	  <main class="l-main" id="create-slotwrapper">

<ul class="nav nav-tabs" role="tablist" id="statmanage">
     <li class="nav-item active">
      <a class="nav-link  active show" data-toggle="tab" href="#statslotbatch">Slot/Batch</a>
    </li>
    <li class="nav-item ">
      <a class="nav-link" id="my_event_table" data-toggle="tab" href="#statevent" aria-expanded="true">Event</a>
    </li>

  </ul>

<div class="tab-content">

    <!-- Create Event Tabbing Start Here -->

		<div id="statslotbatch" class="container tab-pane active">
		  <div class="states_ajax_data">
			
			 
		 </div>
		</div>

        <div id="statevent" class="container tab-pane ">
    	    <div id="StatesEventAjax">
			
			 
		    </div>
       </div>
</div>



	 </main>

	

	

<div class="loader">
	<div class="">
		<span><img class="loaderGif" src="<?php echo base_url('assets/public/images/loader.gif') ?>"></span>
	</div>
</div>	
	

	<!-- Footer Include Here -->
	<?php $this->load->view('public/common/footer');?>

	


<?php $this->load->view('public/common/foot');?>
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
<script src="https://vibestest.com/wip_projects/development/socialsportz-dev/assets/public/js/datedropper.min.js"></script>
<script>
$(window).on('load',function() {
	 var fac_id=$('#headeracademyfacility option:selected').val();
	  $.ajax({
		  type: 'POST',
		  url:'<?php echo base_url();?>facility/states/StatesSlotAjax',
		  data: {fac_id:fac_id},
		  success:function(res){
			  //alert(res);
			$(".states_ajax_data").html(res['_html']);
			
			}
		  
	  });
});

$(document).on('click','#my_event_table',function(){
	    var fac_id = $('#headeracademyfacility option:selected').val();
            $.ajax({
				 type: "POST",
				 url : "<?php echo base_url();?>facility/states/statesEventAjax",
				 data: {fac_id:fac_id},
				 success:function(res){
					  $('#StatesEventAjax').html(res['_html']);
				 }
			});		
});

</script>

</body>
</html>