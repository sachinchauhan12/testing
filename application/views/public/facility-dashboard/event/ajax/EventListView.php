 <style>
  .col-md-121
  {
    width: 100%;
  }
 </style>

 <table class="table1 table-hover table_cust offers_table1" id="createeventlist">
  <thead>
    <tr class="bg-grey">
      
       <th>Basic Info</th>
      <th>Enrollment Date</th>
      <th>Event Date / Time</th>
      <th>Event Status</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=0; if(isset($event_list) && $event_list!=''){
      foreach ($event_list as $event) { $i++ ;
	


  $sport_name = $this->CommonMdl->getRow('tbl_sport_list','sport_name',array('sport_id'=>$event->sport_id));

        ?>
      
      
      <tr class="promoted_data">
<!--         <td class="text-center price_data_item">  
         <span class="participants"><?=$i;?></span>  
       </td> -->
       <td>
         
             
          
            <div class="media-body">
             

             
              <div class="col-sm-12" style="overflow: hidden;">
                <strong><?=$event->event_name;?></strong><br>
              <strong>Sport Name :</strong> <span class="participants"><?=$sport_name->sport_name;?></span><br> 
               <strong>Max Booking :</strong> <span class="participants"><?=$event->event_max_capicity_per_day;?></span><br> 
                    <strong>Venue :</strong>  <span class="participants"><?=$event->event_venue;?></span><br> 
                     <strong>Price :</strong>   <span class=""><i class="fa fa-inr"></i> <?=$event->event_price;?></span> 
            </div>
          </div>
           
       </td>


      

      <td class="text-center date_data_item red">
       <!-- <span class="label_date">From:</span> -->  <span class="date_item1"><i class="far fa-calendar-alt"></i> <?=date('d-m-Y',strtotime($event->application_start_date))?></span> to
       <!-- <span class="label_date">To:</span>  --> <span class="date_item1"><i class="far fa-calendar-alt"></i> <?=date('d-m-Y',strtotime($event->application_end_date))?></span>
  
     
      </td>


      <td class="text-center date_data_item red">

           <!-- <span class="label_date">From:</span>  --> <span class="date_item1"><i class="far fa-calendar-alt"></i> <?=date('d-m-Y',strtotime($event->event_start_date))?></span> to
        <!-- <span class="label_date">To:</span> -->  <span class="date_item1"><i class="far fa-calendar-alt"></i> <?=date('d-m-Y',strtotime($event->event_end_date))?></span><br>

        <span class="date_item1 time"><i class="far fa-calendar-alt"></i> <?=$event->event_start_time;?></span> - 
         <span class="date_item1 time"><i class="far fa-calendar-alt"></i> <?=$event->event_end_time;?></span>

     </td>

     <td class="text-center price_data_item">
         <span class="participants"><?=ucfirst($event->event_status);?></span> <br>
         <span class="participants"><?=ucfirst($event->event_approval);?></span> <br>
         <a href="javascript:void(0)" class="custmer_link1 event_edit edit_event_model"><span  data-toggle="modal" data-target="#editevent">Info <i class="fa fa-pencil-square-o"></i></span> <input type="hidden" name="event_id" value="<?=$event->event_id;?>"></a>

       <a href="javascript:void(0)" class="custmer_link1 event_edit edit_gallery_model"><span data-toggle="modal" data-target="#shopGallery1">Gallery <i class="fa fa-pencil-square-o"></i></span> <input type="hidden" name="event_id" value="<?=$event->event_id;?>"></a>
   
     </td>
 
 
   </tr>
   <?php  } } ?>
 </tbody>
</table>
<!-- Modal -->
<div class="modal fade edit_profile_modal" id="editevent" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div id="event_edit_div"></div>


  </div>

</div>


<!-- Model -->
<div class="modal fade modal_default view_deal edit_profile_modal" id="shopGallery1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">       
      <div class="modal-header">
        <h5 class="modal-title pl-3" id="exampleModalLongTitle">Event Gallery</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="gallery_edit_div"> </div>
    </div>
  </div>
</div>
<!-- Model End -->


<script>
  
 $('#createeventlist').DataTable(); 

  $(".datepicker").dateDropper();
  jQuery('.clockpicker').off().timeDropper();


  $('.edit_event_model').on('click', function(e) {
    var fac_id =$("#headeracademyfacility option:selected" ).val();
    var event_id =$(this).find("input").val();
	showingLoader();
    $.ajax({
      type: "POST",
      //async: true,
      url:'<?php echo base_url();?>facility/event/event_edit_model',  
      data: {event_id:event_id,fac_id:fac_id},
      success:function(res){
		  hiddingLoader();
        $("#event_edit_div").html(res['_html']);
      } 
    });

  });



  $('.edit_gallery_model').on('click', function(e) {
    var fac_id =$("#headeracademyfacility option:selected" ).val();
    var event_id =$(this).find("input").val();
	showingLoader();
    $.ajax({
      type: "POST",
      //async: true,
      url:'<?php echo base_url();?>facility/event/event_gallery_model',  
      data: {event_id:event_id,fac_id:fac_id},
      success:function(res){
		  hiddingLoader();
        $("#gallery_edit_div").html(res['_html']);
      } 
    });

  });
</script>