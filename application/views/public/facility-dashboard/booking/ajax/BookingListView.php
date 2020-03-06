<style>

</style>
<table class="table1 table-hover table_cust offers_table6" id="listbookingdetail1">
<thead>
<tr class="bg-grey">
	

		<th class="text-left"><strong>Basic Info</strong></th>
		<th class="text-left"><strong>Booking Date & Time</strong></th>
		<th class="text-left"><strong>Sport/Price</strong></th>
		<th><strong>Booking Mode/Status</strong></th>
	</tr>
</thead>
<tbody>
	<?php $i=0; if(isset($booking_list) && $booking_list!=''){
		foreach ($booking_list as $list) { $i++; ?>
	<tr>
			
				
				<td class="text-left price_data_item">

					<strong>Booking Id :</strong> <a href="javascript:void(0)" data-toggle="modal" data-target="#bookingdetaillist" class="view_single_booking"><span class="participants red"><?=$list->booking_order_no;?></span><input type="hidden" id="order_id" value="<?=$list->booking_order_id;?>"></a><br>

					<strong>Name :</strong><br>	

					<strong>Email :</strong> <span class="participants table-darkblue"><?=$list->email;?></span><br>

					<strong>Mobile :</strong> <span class="participants"><?=$list->mobile;?></span><br>

								
				</td>
		
				
			
				
				
				<td class="text-left date_data_item red">
       <span class="date_item1">
       	<span class="date_item1"><?=date('d-m-Y',strtotime($list->start_date));?></span><br>
					<span class="time"><?=$list->batch_slot_start_time;?></span>
						</span> -
          <span class="date_item1">
					<span class="time"><?=$list->batch_slot_end_time;?></span>	</span>
				
				</td>
				
				<td class="text-left price_data_item">
					 <span class="participants table-darkblue"><?=$list->sport_name;?></span><br>	
					<span class="participants red"><i class="fa fa-inr"></i> <?=$list->booking_detail_final_amount;?></span>		
				</td>
				<td class="text-center price_data_item">
					<span class="participants"> <?=$list->booking_type;?></span><br>
					<span class="participants"><?=$list->booking_detail_status;?></span><br>
						<a href="javascript:void(0)" data-toggle="modal" data-target="#bookingdetaillist" class="view_single_booking"><span class="participants custmer_link1">View</span><input type="hidden" id="order_id" value="<?=$list->booking_order_id;?>"></a>		
				</td>
				
				
				
			</tr>
		<?php }
	} ?>
			
		</tbody>
	</table>

	<div class="modal fade edit_profile_modal" id="bookingdetaillist" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
    <div id="booking_detail_view"></div>

</div>
</div>
	<script>
		$(".datepicker").dateDropper();
	$('#listbookingdetail1').DataTable();
		
		$(document).on('click','.view_single_booking', function(e) {
		var order_id = $(this).find("input").val();
		showingLoader();
		//var order_id = $(this).find("#order_id").val();
		//alert(order_id);
	$.ajax({
		type: "POST",
			//async: true,
			url:'<?php echo base_url();?>facility/booking/booking_view_model',	
			data: {order_id:order_id},
			success:function(res){
				hiddingLoader();
				$("#booking_detail_view").html(res['_html']);
			}	
		});

});

	</script>