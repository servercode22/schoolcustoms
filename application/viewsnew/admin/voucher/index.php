<style type="text/css">
    .table .pull-right {text-align: initial; width: auto; float: right !important}
</style>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">

		<h1><i class="fa fa-gears"></i> <?php echo $this->lang->line('system_settings'); ?> <small class="pull-right">
				<a type="button" onclick="test_mail()" class="btn btn-primary btn-sm">Test Email --r</a>
			</small>
		</h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<!-- Horizontal Form -->
				<?php if ($this->session->flashdata('msg')) { ?>
						<?php echo $this->session->flashdata('msg') ?>
					<?php } ?>
					<?php if (isset($error_message)) { ?>
						<div class="alert alert-warning"><?php echo $error_message; ?></div>
					<?php } ?>
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Set voucher</h3>
					</div><!-- /.box-header -->
					<!-- form start -->
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item active">
							<a class="nav-link " id="school-tab" data-toggle="tab" href="#school" role="tab" aria-controls="school" aria-expanded="true" aria-selected="true">School info</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="bank-tab" data-toggle="tab" href="#bank" role="tab" aria-controls="bank" aria-selected="false">Bank Info</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="type-tab" data-toggle="tab" href="#type" role="tab" aria-controls="type" aria-selected="false">Voucher Types</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="student-tab" data-toggle="tab" href="#student" role="tab" aria-controls="student" aria-selected="false">Student Info</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="student-tab" data-toggle="tab" href="#instructions" role="tab" aria-controls="student" aria-selected="false">Instructions</a>
						</li>

					</ul>
					
					<?php
					$bankInfo=json_decode($voucher[0]->bank_info);
					$schoolInfo=json_decode($voucher[0]->school_info);
					$voucherTypes=json_decode($voucher[0]->voucher_types);
					
					$students=json_decode($voucher[0]->students);
					$instructions = json_decode($voucher[0]->instructions)
					//print_r($students)
					
					?>
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade in active" id="school" role="tabpanel" aria-expanded="true" aria-labelledby="school-tab">
							<form id="form1" action="<?php echo site_url('voucher/update/school_info') ?>" name="employeeform" method="post" enctype="multipart/form-data">
								<div class="box-body">
									<div class="col-md-4">
									<div class="form-group">
                                                    <label for="exampleInputFile">school logo</label>
                                                    <div><input class="filestyle form-control" type='file' name='userfile' id="file" size='40' />
                                                    </div>
													<span class="text-danger"><?php echo form_error('userfile'); ?></span>
											</div>
									</div>
									<div class="col-md-8">
									<div class="form-group">
										<label for="exampleInputEmail1">School Name</label><small class="req"> *</small>
										<input autofocus="" id="amount" name="name" required placeholder="" value="<?php echo $schoolInfo?$schoolInfo->name:'' ?>" type="text" class="form-control" value="" autocomplete="off">
										<span class="text-danger"></span>
									</div>
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Address and Contact info</label>
										<textarea class="form-control" id="description"  name="acInfo" placeholder="" rows="3"><?php echo $schoolInfo?$schoolInfo->acInfo:'' ?></textarea>
										<span class="text-danger"></span>
									</div>
									
									
								</div><!-- /.box-body -->
								<div class="box-footer">
									<button type="submit" class="btn btn-info pull-right">Save</button>
								</div>
							</form>
						</div>
						<div class="tab-pane fade" id="bank" role="tabpanel" aria-labelledby="bank-tab">
							<form id="form1" action="<?php echo site_url('voucher/update/bank_info') ?>" name="employeeform" method="post" enctype="multipart/form-data" 	accept-charset="utf-8">
								<div class="box-body">
									<div class="col-md-4">
									<div class="form-group">
                                                    <label for="exampleInputFile">Bank logo</label>
                                                    <div><input class="filestyle form-control" type='file' name='userfile' id="file" size='40' />
                                                    </div>
													<span class="text-danger"><?php echo form_error('userfile'); ?></span>
											</div>
									</div>
									<div class="col-md-8">
									<div class="form-group">
										<label for="exampleInputEmail1">Bank Name</label><small class="req"> *</small>
										<input autofocus="" id="amount" name="name" required placeholder=""  type="text" class="form-control" value="<?php echo $bankInfo?$bankInfo->name:'' ?>" autocomplete="off">
										<span class="text-danger"></span>
									</div>
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Address and Contact info</label>
										<textarea class="form-control" id="description" name="acInfo" placeholder="" rows="3"><?php echo $bankInfo?$bankInfo->acInfo:'' ?></textarea>
										<span class="text-danger"></span>
									</div>
									
									
								</div><!-- /.box-body -->
								<div class="box-footer">
									<button type="submit" class="btn btn-info pull-right">Save</button>
								</div>
							</form>
						</div>
						<div class="tab-pane fade" id="type" role="tabpanel" aria-labelledby="type-tab">
							<form id="form1" action="<?php echo site_url('voucher/update/voucher_types') ?>" name="employeeform" method="post" 	accept-charset="utf-8">
								<div class="box-body">
									
									<div class="col-md-12">
										<div class="form-group">
											<label for="exampleInputEmail1">Voucher Copy Names</label><small class="req"> *</small>
											<input autofocus="" id="amount" name="name" required placeholder="Enter Names in format like: Bank,Office,Student" type="text" class="form-control" value="<?php echo $voucherTypes?$voucherTypes->name:'' ?>" autocomplete="off">
											<span class="text-danger"></span>
										</div>
									</div>
									
									
									
								</div><!-- /.box-body -->
								<div class="box-footer">
									<button type="submit" class="btn btn-info pull-right">Save</button>
								</div>
							</form>
						</div>
						<div class="tab-pane fade" id="student" role="tabpanel" aria-labelledby="student-tab">
							<form id="form1" action="<?php echo site_url('voucher/update/students') ?>" name="employeeform" method="post" 	accept-charset="utf-8">
								<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('name'); ?></th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>									
                                    <tr>
                                        <td>Name</td>
                                        <td>
                                            <div class="material-switch pull-right">
                                                <input id="name" name="name" type="checkbox" <?php echo isset($students->name) && $students->name=='checked'?"checked='checked'":''?> class="chk" data-rowid="1" value="checked"  />
                                                <label for="name" class="label-success"></label>
                                            </div>																			
                                        </td>                                                
									</tr> 
									<tr>
                                        <td>Father Name</td>
                                        <td>
                                            <div class="material-switch pull-right">
                                                <input id="father_name" name="father_name" <?php echo isset($students->father_name) && $students->father_name=='checked'?"checked='checked'":''?> type="checkbox" class="chk" data-rowid="1" value="checked"  />
                                                <label for="father_name" class="label-success"></label>
                                            </div>																			
                                        </td>                                                
                                    </tr> 
                                    <tr>
                                        <td>Admission No</td>
                                        <td>
                                            <div class="material-switch pull-right">
                                                <input id="admission" name="admission_no" <?php echo isset($students->admission_no) && $students->admission_no=='checked'?"checked='checked'":''?> type="checkbox" data-role="amdission" class="chk" data-rowid="1" value="checked"  />
                                                <label for="admission" class="label-success"></label>
                                            </div>																			
                                        </td>                                                
                                    </tr>
                                    <tr>
                                        <td>Roll Number</td>
                                        <td>
                                            <div class="material-switch pull-right">
                                                <input id="roll_number" name="roll_no" <?php echo isset($students->roll_no) && $students->roll_no=='checked'?"checked='checked'":''?> type="checkbox" data-role="roll_number" class="chk" data-rowid="1" value="checked"  />
                                                <label for="roll_number" class="label-success"></label>
                                            </div>																			
                                        </td>                                                
                                    </tr>
                                    <tr>
                                        <td>Class</td>
                                        <td>
                                            <div class="material-switch pull-right">
                                                <input id="class" name="class" type="checkbox" <?php echo isset($students->class) && $students->class=='checked'?"checked='checked'":''?>  class="chk" value="checked" />
                                                <label for="class" class="label-success"></label>
                                            </div>																			
                                        </td>                                                
                                    </tr>
                                    <tr>
                                        <td>Section</td>
                                        <td>
                                            <div class="material-switch pull-right">
                                                <input id="section" name="section" type="checkbox" <?php echo isset($students->section) && $students->section=='checked'?"checked='checked'":''?> data-role="section" class="chk" data-rowid="1" value="checked"  />
                                                <label for="section" class="label-success"></label>
                                            </div>																			
                                        </td>                                                
                                    </tr>
                                    
                                </tbody>
                            </table>
									
									
								</div><!-- /.box-body -->
								<div class="box-footer">
									<button type="submit" class="btn btn-info pull-right">Save</button>
								</div>
							</form>
						</div>
						<div class="tab-pane fade" id="instructions" role="tabpanel" aria-labelledby="type-tab">
							<form id="form1" action="<?php echo site_url('voucher/update/instructions') ?>" name="employeeform" method="post" 	accept-charset="utf-8">
								<div class="box-body">
									
								<div class="row">
                                    <div class="col-md-12">     
                                        
                                        <div class="form-group"><label>Instructions<small class="req"> *</small></label>
                                            <textarea id="instruction" name="instruction" class="form-control" style="height: 250px">
											<?php echo set_value('instruction', $instructions->instruction); ?>
                                            </textarea>
                                            <span class="text-danger"><?php echo form_error('instruction'); ?></span>
                                        </div>

                                    </div>
                                      
                                </div>  
									
									
									
								</div><!-- /.box-body -->
								<div class="box-footer">
									<button type="submit" class="btn btn-info pull-right">Save</button>
								</div>
							</form>
						</div>
					</div>
					
				</div>

			</div>
		</div>
	</section>
</div>

<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
    $(function () {
        $("#instruction").wysihtml5();

    });
</script>

<script type="text/javascript">
    $(document).ready(function () {

        $(document).on('click', '.chk', function () {
            var checked = $(this).is(':checked');
            var rowid = $(this).data('rowid');
            var role = $(this).data('role');

            if (checked) {
                if (!confirm('<?php echo $this->lang->line('confirm_status'); ?>')) {
                    $(this).removeAttr('checked');
                } else {
                    var status = "yes";
                    changeStatus(rowid, status, role);

                }
            } else if (!confirm('<?php echo $this->lang->line('confirm_status'); ?>')) {
                $(this).prop("checked", true);
            } else {
                var status = "no";
                changeStatus(rowid, status, role);

            }
        });
    });

    function changeStatus(rowid, status, role) {

        var base_url = '<?php echo base_url() ?>';

        $.ajax({
            type: "POST",
            url: base_url + "admin/systemfield/changeStatus",
            data: {'id': rowid, 'status': status, 'role': role},
            dataType: "json",
            success: function (data) {
                successMsg(data.msg);
            }
        });
    }


</script>
