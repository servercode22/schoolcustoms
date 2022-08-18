

<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
$language = $this->customlib->getLanguage();
$language_name = $language["short_code"];
?><style type="text/css">
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
      
    }
    #amountpercentage{
            display: none ;
            
        }
        #amountfix{
            display: none;
        }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <i class="fa fa-usd"></i> <?php echo $this->lang->line('loanadd'); ?></h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php
            if ($this->rbac->hasPrivilege('loan_management', 'can_add')) {
                ?>
                <div class="col-md-4">
                    <!-- Horizontal Form -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('add_loan'); ?></h3>
                        </div><!-- /.box-header -->

                        <form id="form1" action="<?php echo base_url() ?>admin/loan"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                            <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>
                                <?php echo $this->customlib->getCSRF(); ?>

                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('emprole'); ?></label><small class="req"> *</small>
                                    <select name="role" id="role"  class="form-control" onchange="getEmployeeName(this.value)">
                                <option value="" ><?php echo $this->lang->line('select') ?></option>
                                <?php foreach ($roletype as $rolekey => $rolevalue) {
                                    ?>
                                    <option value="<?php echo $rolevalue["id"] ?>"><?php echo $rolevalue["type"] ?></option>
                                <?php } ?>
                            </select>

                                   <span class="text-danger"><?php echo form_error('role'); ?></span>

                                </div>
								<div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('empname'); ?></label><small class="req"> *</small>

                                    <select autofocus="" id="employername" name="employername" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                     
                                    </select><span class="text-danger"><?php echo form_error('employername'); ?></span>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('date'); ?><small class="req"> *</small></label>
                                    <input id="date" name="date" placeholder="" type="text" class="form-control date"  value="<?php echo set_value('date'); ?>" readonly="readonly" />
                                    <span class="text-danger"><?php echo form_error('date'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('loanamount'); ?><small class="req"> *</small></label>
                                    <input id="amount" name="amount" placeholder="" type="text" class="form-control"  value="<?php echo set_value('amount'); ?>" />
                                    <span class="text-danger"><?php echo form_error('amount'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for=""><?php echo $this->lang->line('deductiontype')?></label><small class="req"> *</small>
                                    <select name="deductions" id="deductions" class = "form-control">
                                        <option value="">Select</option>
                                        <option value="none">None</option>
                                        <option value="fix">Fix</option>
                                        <option value="percentage">Percentage</option>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('deductions'); ?></span>
                                    <span class="text-danger"><?php echo form_error('fix_amount'); ?></span>
                                    <span class="text-danger"><?php echo form_error('percentage_amount'); ?></span>
                                </div>
                                <div class="form-group" id="amountfix">
                                     <label for="">Enter Fix</label><small class="req"> *</small>
                                     <input type="number" id="fix_amount" class = "form-control" value = "" name = "fix_amount">
                                 </div>
                                 <div class="form-group" id="amountpercentage">
                                     <label for="">Enter Percentage</label><small class="req"> *</small>
                                     <input type="number" class = "form-control" value = "" min = "1" max = "100" name="percentage_amount">
                                 </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
                                    <textarea class="form-control" id="description" name="description" placeholder="" rows="3" placeholder="Enter ..."><?php echo set_value('description'); ?></textarea>
                                    <span class="text-danger"></span>
                                </div>
                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </form>
                    </div>

                </div><!--/.col (right) -->
                <!-- left column -->
            <?php } ?>
            <div class="col-md-<?php
            if ($this->rbac->hasPrivilege('loan_management', 'can_add')) {
                echo "8";
            } else {
                echo "12";
            }
            ?>">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"> <?php echo $this->lang->line('loan_list'); ?></h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="download_label"><?php echo $this->lang->line('loan_list'); ?></div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped table-bordered example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('emprole'); ?>
                                        </th>
                                        <th><?php echo $this->lang->line('empname'); ?>
                                        </th>
                                        <th><?php echo $this->lang->line('date'); ?>
                                        </th>
                                        <th><?php echo $this->lang->line('loanamount'); ?>
										</th>
                                        <th><?php echo $this->lang->line('loanamountval'); ?>
										</th>
                                        <th><?php echo $this->lang->line('loanamountpercen'); ?>
										</th>
                                        <th><?php echo $this->lang->line('deductiontype'); ?>
                                        </th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php
                                   if(empty($alldata)){
                                   ?>

                                <?php
                                   }
                                   else{
                                foreach($alldata as $loaddata){
                                ?>
                                    <tr>
                                    <td>
                                         <?php echo $loaddata['role'];?>
                                    </td>
                                    <td>
                                        <?php echo $loaddata['employee_name'];?>
                                    </td>
                                    <td>
                                        <?php echo $loaddata['date'];?>
                                    </td>
                                    <td>
                                        <?php echo $currency_symbol.$loaddata['loan_amount'];?>
                                    </td>
                                        <td>
                                        <?php
                                        if($loaddata['deduct_amount'] ==  ''){
                                       ?>
                                        <?php echo $currency_symbol.'0'?>
                                     <?php
                                    }
                                    else{
                                    ?>
                                        <?php echo $currency_symbol.$loaddata['deduct_amount']?>
                                    <?php
                                    }?>
                                    </td>
                                    <td>
                                        <?php
                                        if($loaddata['loan_percentage'] ==  ''){
                                       ?>
                                        <?php echo '0%'?>
                                     <?php
                                    }
                                    else{
                                    ?>
                                        <?php echo $loaddata['loan_percentage'].'%'?>
                                    <?php
                                    }?>
                                    </td>
                                    <td>
                                        <?php echo $loaddata['deduct_type'];?>
                                    </td>
                                    <td>
                                    <a data-placement="left" href="<?php echo base_url(); ?>admin/loan/edit/<?php echo $loaddata['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                    <i class="fa fa-pencil"></i>
                                    </a>

                                    <a data-placement="left" href="<?php echo base_url(); ?>admin/loan/delete/<?php echo $loaddata['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
                                    <i class="fa fa-remove"></i>
                                    </a>
                                    </td>
                                    </tr>
                                <?php 
                                   }
                                }
                                ?>
                                </tbody>
                            </table><!-- /.table -->



                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                </div>
            </div><!--/.col (left) -->
            <!-- right column -->

        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
    $(document).ready(function () {




        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });

    });

    $(document).ready(function () {
        $('.detail_popover').popover({
            placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
    });
    $(document).ready(function () {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'print',
                    customize: function (win) {
                        alert();
                    }
                }
            ]
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#deductions").change(function(){
        var deduction = $("#deductions").val();
        if(deduction!="fix"){
           $("#amountfix").hide()
        }
           else{
            $("#amountfix").show()
           }
        
        if(deduction!="percentage"){
            $("#amountpercentage").hide()
        }
            else{
                $("#amountpercentage").show()
            
        }    
    });
});



function getEmployeeName(role) {
        var ne = "";
        var base_url = '<?php echo base_url() ?>';
        $("#employername").html('<option value=><?php echo $this->lang->line('select') ?></option>');
        var div_data = "";
        $.ajax({
            type: "POST",
            url: base_url + "admin/staff/getEmployeeByRole",
            data: {'role': role},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj)
                {
                    div_data += "<option value='" + obj.id + "' >" + obj.name + " " + obj.surname + " " + "(" + obj.employee_id + ")</option>";
                });

                $('#employername').append(div_data);
            }
        });
    }
</script>
