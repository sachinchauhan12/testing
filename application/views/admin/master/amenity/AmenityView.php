<!DOCTYPE html>

<html lang="en">

	<?php $this->load->view('admin/includes/head');?> 

	<body class="no-skin">

		<?php $this->load->view('admin/includes/header');?> 

		<div class="main-container ace-save-state" id="main-container">

			<?php $this->load->view('admin/includes/sidebar');?>

			<div class="main-content">

					<div class="page-content">

            <div class="main-content">

				    <div class="main-content-inner">
				    	<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?= base_url('admin/user/dashboard');?>">Dashboard</a>
							</li>
							<li class="active">Aminity</li>
						</ul><!-- /.breadcrumb -->

						
					</div>

					<div class="page-content">

                    <div class="page-header">

							<div class="table-header">
											Add / Edit Aminity
										</div>						

						</div>

					<div class="row">

                    <?php if($msg=$this->session->flashdata('msg')):$msg_class=$this->session->flashdata('msg_class');?>

				<div class="alert <?=$msg_class;?> alert-dismissible mb-2" id="msg_show" role="alert"><?=$msg;?> </div>					

				<?php endif;?>	

							<div class="col-md-12">

								<!-- PAGE CONTENT BEGINS -->                               
								<!-- Add banner -->
                                <?php if($this->uri->segment(4)==''){
                     
                                echo form_open_multipart('admin/master/add_amenity',array('class'=>'form-horizontal')); ?>

                              <div class="row">

											<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-2 control-label no-padding-right" for="form-field-1">Amenity Title</label>


												<div class="col-md-10">

													<?php echo form_input(array('name'=>'amenity_name','id'=>'amenity_name','class'=>'col-xs-12','Placeholder'=>'Amenity Title')); ?>

													<span id="errTitle" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>


										<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-2 control-label no-padding-right" for="form-field-1"> Icon</label>


												<div class="col-md-10">

													<label class="ace-file-input"><input type="file" id="id-input-file-1" name="icon_image"></label>

													<span id="errIcon" class="error col-xs-12">  </span>


												</div>
											</div>

										</div>

											

									<div class="col-md-6">
											
									<div class="form-group status-align">
                            		<label class="col-sm-2 control-label no-padding-right stausLink" for="form-input-readonly"> Status </label>
                            		<div class="col-sm-10">									
                            			<span class="help-inline col-xs-12 col-sm-10">
                            			<label class="middle">
                            					<?php echo form_checkbox('status','enable',TRUE,['class'=>'ace','id'=>'status']); ?>												
                            					<span class="lbl"> Active</span>

                            				</label>
                            				<span id="errPageStatus" class="error">  </span>
                            			</span>
                            		</div>
                            	</div>

										</div>
								<div class="col-md-6">
<div class=""style="width:130px; float:right;"> 								
                            		<?php echo form_submit(['class'=>'btn btn-info','name'=>'aminity_submit','id'=>'aminity_submit','value'=>'Submit']); ?>											

                            	</div>
                            	</div>
									

									</div>


                           
                            

                       

														

                             <?php echo form_close(); }
                             //Edit sports
                             	else{
                             
								echo form_open_multipart('admin/master/edit_amenity',array('class'=>'form-horizontal')); ?>

								  <div class="row">

											<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Amenity Title</label>


												<div class="col-md-9">

													<?php echo form_input(array('name'=>'amenity_name','id'=>'amenity_name','class'=>'col-xs-12','Placeholder'=>'Amenity Title','value'=>$edit_amenity[0]->amenity_name)); ?>

													<span id="errTitle" class="error col-xs-12"> </span>


												</div>
											</div>

										</div>


										<div class="col-md-6">


											<div class="form-group">

												<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Icon</label>


												<div class="col-md-9">

													<label class="ace-file-input"><input type="file" id="id-input-file-1" name="icon_image"></label>

													<span id="errIcon" class="error col-xs-12">  </span>

										<input type="hidden" id="amenity_id" name="amenity_id" value="<?=$edit_amenity[0]->amenity_id;?>" />

										<input type="hidden" id="old_icon_image" name="old_icon_image" value="<?=$edit_amenity[0]->amenity_icon;?>" />

										<?php if($edit_amenity[0]->amenity_icon!=''){ ?>
										<img src="<?=base_url('assets/public/images/amenity/'.$edit_amenity[0]->amenity_icon);?>" height="50px" width="50px">
										<?php } ?>


												</div>
											</div>

										</div>


									<div class="col-md-6">
											
									<div class="form-group">
                            		<label class="col-sm-3 control-label no-padding-right stausLink" for="form-input-readonly"> Status </label>
                            		<div class="col-sm-9">									
                            			<span class="help-inline col-xs-12 col-sm-10">
                            			<label class="middle">
                            					<?php
                            				 if($edit_amenity['0']->amenity_status=='enable'){  
                            					echo form_checkbox('status','enable',TRUE,['class'=>'ace','id'=>'status']); }
                            						else{
                            							echo form_checkbox('status','enable',false,['class'=>'ace','id'=>'status']);

                            						}



                            					 ?>													
                            					<span class="lbl"> Active</span>

                            				</label>
                            				<span id="errPageStatus" class="error">  </span>
                            			</span>
                            		</div>
                            	</div>

										</div>
								<div class="col-md-6">
                                      <div class=""style="width:130px; float:right;"> 								
                            		<?php echo form_submit(['class'=>'btn btn-info','name'=>'amenity_edit','id'=>'amenity_edit','value'=>'Submit']); ?>											

                            	</div>
                            	</div>
									

									</div>
														

                             <?php echo form_close();} ?>						

							</div><!-- /.col -->

						</div>

                        <hr />

                        	<table id="dynamic-table" class="table table-striped table-bordered table-hover">

												<thead>

													<tr>

														<th>S.No.</th>
														<th>Title</th>
														<th>Icon Image</th>
														<th>Status </th>
														<th>Action</th>

													</tr>

												</thead>

												<tbody>

												<?php if(isset($alldata) && !empty($alldata)){ $i=1 ;foreach($alldata as $result){?>

													<tr>

														<td><?php echo $i; ?></td>

														<td><a><?php echo $result->amenity_name; ?></a></td>

													<td><img src="<?php echo base_url(); ?>assets/public/images/amenity/<?php echo $result->amenity_icon; ?>" height="50px" width="50px" /></td>
													

														<td><?php echo ucwords($result->amenity_status); ?></td>					

														<td>

															<div class="hidden-sm hidden-xs action-buttons">

															<a class="green" href="<?php echo base_url('admin/master/amenity/'.$result->amenity_id); ?>">

																	<i class="ace-icon fa fa-pencil bigger-130"></i>

																</a>

																<!--<a class="red" href="<?php echo base_url('admin/master/delete_amenity/'.$result->amenity_id); ?>" onclick="return confirm('Are you sure you want to delete amenity?')">

																	<i class="ace-icon fa fa-trash-o bigger-130"></i>

																</a>-->

															</div>

														</td>

													</tr>

													<?php  $i++;	}

												} ?>

												</tbody>

											</table>

								<!-- PAGE CONTENT ENDS -->

							</div><!-- /.col -->

						</div><!-- /.row -->

					</div><!-- /.page-content -->

				</div>

			</div><!-- /.main-content -->

					</div><!-- /.page-content -->

				</div>

			</div><!-- /.main-content -->

			<?php //include('includes/footer.php');?>

			<?php $this->load->view('admin/includes/footer'); ?>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">

				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>

			</a>

		</div><!-- /.main-container -->



		<?php $this->load->view('admin/includes/foot'); ?>

		<!-- inline scripts related to this page -->

	</body>

</html>

<script>

 $('#aminity_submit').click(function(e) {
    var amenity_name = $('#amenity_name').val();
     var icon_image = $("input[name=icon_image]").val();
	var ext_icon_image = icon_image.split('.').pop();      
//alert(sport_image);
 if(amenity_name == ''){
        $('#amenity_name').show();
        $('#errTitle').html('Please Enter Aminity Title');
		return false;
    }
    else{
        $('#errTitle').html('');
    }

   if(icon_image==''){
	$('#errIcon').html('Please Attach icon Image');
		return false;
	}

		if(icon_image!=''){
		var icon_iamge_size = parseFloat($("#id-input-file-1")[0].files[0].size / 1024).toFixed(2);
		if(icon_iamge_size>500)
		{
			$('#errIcon').html('Please Attach Image below 500 kb');
			return false;
		}
		else
		{
			$('#errIcon').html('');
		}

		if($.inArray(ext_icon_image, ['png','jpg','jpeg','webp','svg']) == -1) {
			$('#errIcon').html('Please Attach Image in png , jpg or jpeg format only');			
			return false;
		} 
		else{
			$('#errIcon').html('');
		}
	}



	 else{

		$('#errbannerImg').html('');

	}

    return true;

  }); 


  /*Edit form validation*/

  $('#amenity_edit').click(function(e) {
    var amenity_name = $('#amenity_name').val();
     var icon_image = $("input[name=icon_image]").val();
	var ext_icon_image = icon_image.split('.').pop();     
//alert(sport_image);
 if(amenity_name == ''){
        $('#amenity_name').show();
        $('#errTitle').html('Please Enter Amenity');
		return false;
    }
    else{
        $('#errTitle').html('');
    }


		if(icon_image!=''){
		var icon_iamge_size = parseFloat($("#id-input-file-1")[0].files[0].size / 1024).toFixed(2);
		if(icon_iamge_size>500)
		{
			$('#errIcon').html('Please Attach Image below 500 kb');
			return false;
		}
		else
		{
			$('#errIcon').html('');
		}

		if($.inArray(ext_icon_image, ['png','jpg','jpeg','webp','svg']) == -1) {
			$('#errIcon').html('Please Attach Image in png , jpg or jpeg format only');			
			return false;
		} 
		else{
			$('#errIcon').html('');
		}
	}

	

    return true;

  }); 

$('#id-input-file-1,#id-input-file-2').ace_file_input({
	no_file:'No File ...',
	btn_choose:'Choose',
	btn_change:'Change',
	droppable:false,
	onchange:null,
	thumbnail:false //| true | large				
});
</script>