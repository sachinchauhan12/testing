<!DOCTYPE html>
<html lang="en">
	<?php $this->load->view('admin/includes/head'); ?> 

	<body class="no-skin">
		<?php $this->load->view('admin/includes/header');?>
	

		<div class="main-container ace-save-state" id="main-container">
			

			<?php $this->load->view('admin/includes/sidebar');?>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?= base_url('admin/user/dashboard');?>">Dashboard</a>
							</li>

							<li>
								<a href="<?= base_url('admin/user/admin_form');?>">Add Admin</a>
							</li>
							<li class="active">Admin List</li>
						</ul><!-- /.breadcrumb -->

						
					</div>

					<div class="page-content">
						<div class="page-header">
						<div class="table-header">
											 Admin List
										</div>
									</div>
						<div class="row">
							
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
							
								<div class="row">
									 <?php if($msg=$this->session->flashdata('msg')):$msg_class=$this->session->flashdata('msg_class');?>
						<div class="alert <?=$msg_class;?> alert-dismissible mb-2" id="msg_show" role="alert"><?=$msg;?> </div>
					
							<?php endif;?>
									<div class="col-xs-12">
										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th class="center">S.N</th>
														<th>Name</th>
														<th>Email</th>
														<th>Admin Name</th>
														<th>Admin Access</th>
														<th>Status</th>
														<th>Action</th>
													</tr>
												</thead>

												<tbody>
													<?php 
													 
													if(isset($adminList) && !empty($adminList)){ $i=0 ;foreach($adminList as $result){ $i++;
														$rolelists=  $this->UserMdl->getRoleAccess($result->admin_id);
														
														
														?>
													<tr>
														<?php
														//get Admin role
														$admin_role = '';
														foreach ($rolelists as $rolelist) {
														 $admin_role.= $rolelist->role_access.',';
														 
														} 
													
														
														
														?>
														<td class="center"><?= $i ?></td>
														<td><?= $result->admin_name; ?></td>
														<td><?= $result->admin_email; ?></td>
														<td><?= $result->admin_username; ?></td>
														<td><?php 
														echo rtrim($admin_role,',');?></td>
														<td> <?php if($result->admin_status =="enable"){
															  echo "Active";
															 ?>
															 
														 <?php
														   }elseif($result->admin_status =="disable"){
														  echo "Inactive"; ?>
														<?php
														// print_data($result);
														   }
														   ?></td>

														<td>
															<div class="hidden-sm hidden-xs action-buttons">
													          <?php if($result->admin_id != '1'){
																?>
																<a class="green" href="<?= base_url('admin/user/admin_edit_form/'.$result->admin_id);?>">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
																</a>
																
																<?php
															  }
																?>
																
                                                                <?php if($this->session->userdata('admin_id') != $result->admin_id){ 
																  if($result->admin_id != '1'){
																?>
																<a class="red" href="<?= base_url('admin/user/delete_admin/'.$result->admin_id);?>" onclick="return confirm('Are you sure you want to delete user?')">
																	<i class="ace-icon fa fa-trash-o bigger-130"></i>
																</a>
																<?php }} ?>
															</div>
														</td>
														
													</tr>
													<?php }
													} ?>
													

												</tbody>
											</table>
										</div>
									</div>
								</div>


								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

				<?php $this->load->view('admin/includes/footer');?> 

			
		</div><!-- /.main-container -->

		<?php $this->load->view('admin/includes/foot');?> 
		</div><!-- /.main-container -->
	</body>
</html>
