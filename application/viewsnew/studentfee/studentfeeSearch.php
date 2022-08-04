<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper" style="min-height: 946px;">   
    <section class="content-header">
        <h1>
            <i class="fa fa-money"></i> <?php echo $this->lang->line('fees_collection'); ?> </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="row">
                                    <form role="form" action="<?php echo site_url('studentfee/search') ?>" method="post" class="">
                                        <?php echo $this->customlib->getCSRF(); ?>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('class'); ?></label><small class="req">  *</small>
                                                <select autofocus="" id="class_id" name="class_id" class="form-control" >
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php
                                                    foreach ($classlist as $class) {
                                                        ?>
                                                        <option value="<?php echo $class['id'] ?>" <?php if (set_value('class_id') == $class['id']) echo "selected=selected" ?>><?php echo $class['class'] ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                            </div> 
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('section'); ?></label>
                                                <select  id="section_id" name="section_id" class="form-control" >
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                            </div> 
                                        </div>
                                        <div class="col-sm-12">  
                                            <div class="form-group">
                                                <button type="submit" name="search" value="search_filter" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>  
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="row">
                                    <form role="form" action="<?php echo site_url('studentfee/search') ?>" method="post" class="">
                                        <?php echo $this->customlib->getCSRF(); ?>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('search_by_keyword'); ?></label>
                                                <input type="text" name="search_text" class="form-control" value="<?php echo set_value('search_text'); ?>" placeholder="<?php echo $this->lang->line('search_by_student_name'); ?>">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <button type="submit" name="search" value="search_full" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>  
                            </div>
                        </div>
                    </div>

                    <?php
                    if (isset($resultlist)) {
                        ?>
                        <div class="">
                            <div class="box-header ptbnull"></div> 
                            <div class="box-header ptbnull">
                                <h3 class="box-title titlefix"><i class="fa fa-users"></i> <?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('list'); ?>
									<?php echo form_error('student'); ?></h3>


									<!-- ======start Amir Code===== -->


								<div class="box-tools pull-right">
									<form class="miltiForm" action="<?php echo site_url('studentfee/invoice') ?>" method="post">
									<?php echo $this->customlib->getCSRF(); ?>
									<input type="hidden" id="students" name="check" >
									
									<button type="submit" class="btn btn-warning multiSelector">Print Selected</button>
									<a href="#siblingModal"  data-toggle="modal" data-target="#siblingModal" class="btn btn-danger">Print Sibling Voucher</a>
							</form>

							
						
						</div>


						<!-- ========End Amir Code====== -->


                            </div>
                            <div class="box-body table-responsive">

                                <div class="download_label"><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('list'); ?></div>
                                <table class="table table-striped table-bordered table-hover example">
                                    <thead>

                                        <tr>
											<th><input type="checkbox" name="" id="allSelector"></th>
                                            <th><?php echo $this->lang->line('class'); ?></th>
                                            <th><?php echo $this->lang->line('section'); ?></th>

                                            <th><?php echo $this->lang->line('admission_no'); ?></th>

                                            <th><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('name'); ?></th>
                                            <?php if ($sch_setting->father_name) { ?>
                                                <th><?php echo $this->lang->line('father_name'); ?></th>
											<?php } ?>


												<!-- ======Start Amir Code===== -->

											<?php if ($sch_setting->father_name) { ?>
                                                <th>Patent Id</th>
											<?php } ?>
											
											<!-- ======Amir Code End======= -->


                                            <th><?php echo $this->lang->line('date_of_birth'); ?></th>
                                            <th><?php echo $this->lang->line('phone'); ?></th>
                                            <th class="text-right"><?php echo $this->lang->line('action'); ?></th>

                                        </tr>
                                    </thead>            
                                    <tbody>    
                                        <?php
										$count = 1;
										
                                        foreach ($resultlist as $student) {
                                            ?>
                                            <tr>
												<td>
												<input name="selector[]" class="checkbox"  type="checkbox" value="<?php echo $student['student_session_id'] ?>" />
												</td>
                                                <td><?php echo $student['class']; ?></td>
                                                <td><?php echo $student['section']; ?></td>

                                                <td><?php echo $student['admission_no']; ?></td>

                                                <td><?php echo $student['firstname'] . " " . $student['lastname']; ?></td>
                                                <?php if ($sch_setting->father_name) { ?>
                                                    <td><?php echo $student['father_name']; ?></td>
												<?php } ?>


												<!-- =======Amir code======= -->


												<?php if ($sch_setting->father_name) { ?>
                                                    <td><?php echo base64_encode(base64_encode($student['parent_id'])); ?></td>
												<?php } ?>
												
												<!-- ========end Amir Code======= -->



                                                <td><?php
                                                    if (!empty($student['dob'])) {
                                                        echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['dob']));
                                                    }
                                                    ?></td>
                                                <td><?php echo $student['guardian_phone']; ?></td>
                                                <td class="pull-right">
                                                    <?php if ($this->rbac->hasPrivilege('collect_fees', 'can_add')) { ?>


														<!-- ========Amir code========= -->


														<a  href="<?php echo base_url(); ?>studentfee/invoice/<?php echo $student['student_session_id'] ?>" class="btn btn-success btn-xs" data-toggle="tooltip" title="" data-original-title="">
                                                            <?php echo $currency_symbol; ?> Print voucher
														</a>
														

														<!-- ======End Amir code======= -->


														<a  href="<?php echo base_url(); ?>studentfee/addfee/<?php echo $student['student_session_id'] ?>" class="btn btn-info btn-xs" data-toggle="tooltip" title="" data-original-title="">
                                                            <?php echo $currency_symbol; ?> <?php echo $this->lang->line('collect_fees'); ?>
														</a>
														
                                                    <?php } ?>
                                                </td>

                                            </tr>
                                            <?php
                                        }
                                        $count++;
                                        ?>
                                    </tbody>
                                </table>
                            </div><!--./box-body-->
                        </div>
                    </div>  
                    <?php
                }
                ?>
            </div>

        </div> 

    </section>
</div>

<!-- ========Amir code======== -->
<div class="modal fade" id="siblingModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title title text-center discount_title">Sibling Voucher</h4>
            </div>
            <div class="modal-body pb0">
                <div class="form-horizontal">
                    <div class="box-body">
                        <input  type="hidden" class="form-control" id="student_fees_discount_id"  value=""/>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Parent Id <small class="req">*</small></label>
                            <div class="col-sm-9">

                                <input type="text" class="form-control" id="parent_id" >

                                <span class="text-danger" id="parent_id_error"></span>
                            </div>
                        </div>

                        <div class="form-group">
							<span class="text-danger" id="parent_id_reuslt"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                <button type="button" class="btn cfees dis_apply_button" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> Check Siblings</button>
            </div>
        </div>

    </div>
</div>

<!-- =========End Amir code======== -->

<script type="text/javascript">
    function getSectionByClass(class_id, section_id) {
        if (class_id != "" && section_id != "") {
            $('#section_id').html("");
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        var sel = "";
                        if (section_id == obj.section_id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
                    });
                    $('#section_id').append(div_data);
                }
            });
        }
    }
	/* =========Amir Code========= */
    $(document).ready(function () {
        var class_id = $('#class_id').val();
        var section_id = '<?php echo set_value('section_id') ?>';
        getSectionByClass(class_id, section_id);
        $(document).on('change', '#class_id', function (e) {
            $('#section_id').html("");
            var class_id = $(this).val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                    });
                    $('#section_id').append(div_data);
                }
            });
        });
		$('.multiSelector').click(function(e){
			e.preventDefault();
			$('#students').val($('.checkbox:checked').map(function() {return this.value;}).get().join(','));
			if($('#students').val()==''){
				alert('No row selected!');
				return;
			}
			$('.miltiForm').submit();
		});
		$("#allSelector").click(function(){
			$('input:checkbox').not(this).prop('checked', this.checked);
		});
		
	});
	$(document).on('click', '.dis_apply_button', function (e) {
        var $this = $(this);
        $this.button('loading');

        var parent_id = $('#parent_id').val();
        if(parent_id==''){
			alert('Parent Id can not be empty!');
			$this.button('reset');
            return 0;
		}

        $.ajax({
            url: '<?php echo site_url("studentfee/checkSibling") ?>'+'/'+parent_id,
            type: 'post',
            
            dataType: 'json',
            success: function (response) {
                $this.button('reset');
                if (response > 1) {
                    $('#parent_id_reuslt').html('We have found '+response+' siblings Record <a href="<?php echo site_url("studentfee/siblingInvoice/") ?>'+parent_id+'">Click here</a> to print voucher')
                } else{
                    $('#parent_id_reuslt').html('We have found 0 other siblings');
                }
            }
        });
    });
	/* ============End Amir Code========= */
</script>
