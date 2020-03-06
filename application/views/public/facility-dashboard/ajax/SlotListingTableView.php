<table class="table1 table-hover table_cust offers_table6" id="facilityacadelisting">
<thead>
	<tr class="bg-grey">
			<th class="text-left"><strong>Basic Info</strong></th>
			<th  class="text-left"><strong>Date & Time</strong></th>
			<th  class="text-left"><strong>Working Days</strong></th>
			<th  class="text-left"><strong>Status</strong></th>
		
	</tr>
</thead>
<tbody>

<?php $i=0; if(isset($slotListing) && $slotListing) {
	foreach ($slotListing as $slotListings) { $i++;

		$sport_name = $this->CommonMdl->getRow('tbl_sport_list','sport_name',array('sport_id'=>$slotListings->sport_id));
		$label = $this->CommonMdl->getRow('tbl_batch_slot_type','batch_slot_type',array('batch_slot_type_id'=>$slotListings->batch_slot_type_id));
		 $slot_price=$this->CommonMdl->getRow('tbl_slot_package_price','slot_package_price',array('batch_slot_id'=>$slotListings->batch_slot_id));
		?>
		
		
<tr class="promoted_data text-left" >

<td class="text-left date_data_item">

<strong>Sport Name :</strong> <?=$sport_name->sport_name;?><br>

<strong>Max Bookings :</strong> <?=$slotListings->max_participanets;?><br>

<strong>Package Type :</strong> <?=$label->batch_slot_type;?><br>

	<strong>Price :</strong> <i class="fa fa-rupee"></i> <?=$slot_price->slot_package_price;?>

        </td>




<td>

  <span class="red">        <span class="date_item1">
        	<?=date('d-m-Y',strtotime($slotListings->start_date));?></span>
to
        <span class="date_item1">
        	<?=date('d-m-Y',strtotime($slotListings->end_date));?></span><br>

        		<span class="date_item1 time">
 <?=$slotListings->start_time.'</span> - <span class="time date_item1"> '.$slotListings->end_time;?></span>
</span>

</td>

<td class="table-darkblue">
<?php $weekoff=$this->CommonMdl->getResultByCond('tbl_batch_slot_weekoff',array('batch_slot_id'=>$slotListings->batch_slot_id),'batch_slot_weekoff_day',$order_by='');
$day='';
 foreach ($weekoff as $value) { 
$day .=  '<span class="daysname">'.$value->batch_slot_weekoff_day.'</span>';
}
echo rtrim($day,',');
 ?>	
</td>


<td style="text-transform: capitalize;">
<?=$slotListings->fac_batch_slot_status;?>
	<a href="javascript:void(0)" class="editslotform"><i data-toggle="modal" data-target="#editslot" class="fa fa-pencil-square-o"></i><input type="hidden" name="batch_slot_id" id="batch_slot_id" value="<?=$slotListings->batch_slot_id;?>"></a>

	<div class="switch">
		<label>
			<input type="checkbox">
			<span class="lever"></span>
		</label>
	</div>
</td>
</tr>
<?php }
} ?>
</tbody>
</table>

<div class="modal fade edit_profile_modal" id="editslot" role="dialog">
		<div class="modal-dialog modal-dialog-centered modal-lg">
          
			<!-- Modal content-->
			<div class="modal-content">
				  <div class="modal-header">
	<h5 class="modal-title pl-3" id="exampleModalLongTitle">Edit Slot</h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	<span aria-hidden="true">×</span>
	</button>
	</div>
				
				<div id="slot_edit_model"></div>
				<div class="modal-footer">
					
				</div>
			</div>

		</div>
	</div>

<script>
	$('.editslotform').on('click', function(e) {
		 var slot_id = $(this).find("input").val(); 
		var fac_id =$("#headeracademyfacility option:selected" ).val();
		var fac_name =$("#headeracademyfacility option:selected" ).text();
		showingLoader();
		
	$.ajax({
		type: "POST",
			//async: true,
			url:'<?php echo base_url();?>facility/slot/slot_edit_model',	
			data: {fac_id:fac_id,slot_id:slot_id,fac_name:fac_name},
			success:function(res){
				hiddingLoader();
				$("#slot_edit_model").html(res['_html']);
			}	
		});

});
	$('#facilityacadelisting').DataTable();
</script>

