<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('account_statement'); ?>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
            <div class="row">
            <div class="col-md-12">
            <div class="box box-primary">
            <form id="form1" action="<?php echo site_url('admin/accountstatement/index') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">                       
                        <div class="">
                            <div class="bozero">
                                <h4 class="pagetitleh-whitebg"><?php echo $this->lang->line('accounts'); ?> <?php echo $this->lang->line('statement'); ?> </h4>
                                <div class="around10">
                                <div class="fahad">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                        <?php echo $this->session->flashdata('msg') ?>
                                    <?php } ?>
                                </div>
                                <?php if (isset($error_message)) { ?>
                                        <div class="alert alert-warning"><?php echo $error_message; ?></div>
                                    <?php } ?>   
                                    <?php echo $this->customlib->getCSRF(); ?>
                                  <div class="row">
                                   <div class="col-md-6">
                                   <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('date'); ?></label><small class="req"> *</small>
                                                <input id="dob" name="date" placeholder="" type="text" class="form-control date"  value="<?php echo set_value('date'); ?>" />
                                                <span class="text-danger"><?php echo form_error('date'); ?></span>
                                            </div>
                                   </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1"><?php echo $this->lang->line('reference'); ?></label> <small class="req"> *</small>

                                      <input autofocus="" id="reference" name="reference" placeholder="" type="text" class="form-control"  value="<?php echo set_value('reference'); ?>" />
                                      <span class="text-danger"><?php echo form_error('reference'); ?></span>
                                    </div>
                                  </div>
                                  <div class="row">
                                   <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1"><?php echo $this->lang->line('credit'); ?></label> <small class="req"> *</small>

                                      <input autofocus="" id="credit" name="credit" placeholder="" type="text" class="form-control"  value="<?php echo set_value('credit'); ?>" />
                                      <span class="text-danger"><?php echo form_error('credit'); ?></span>
                                     </div>
                                     </div>
                                     <div class="col-md-6">
                                     <div class="form-group">
                                      <label for="exampleInputEmail1"><?php echo $this->lang->line('debit'); ?></label> <small class="req"> *</small>

                                      <input autofocus="" id="debit" name="debit" placeholder="" type="text" class="form-control"  value="<?php echo set_value('debit'); ?>" />
                                      <span class="text-danger"><?php echo form_error('debit'); ?></span>
                                    </div>
                                  </div>
                                  <div class="row">
                                   <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1"><?php echo $this->lang->line('created_by'); ?></label> <small class="req"> *</small>

                                      <input autofocus="" id="created_by" name="created_by" placeholder="" type="text" class="form-control"  value="<?php echo set_value('created_by'); ?>" />
                                      <span class="text-danger"><?php echo form_error('created_by'); ?></span>
                                     </div>
                                     </div>
                                     <div class="col-md-6">
                                     <div class="form-group">
                                      <label for="exampleInputEmail1"><?php echo $this->lang->line('updated_by'); ?></label> <small class="req"> *</small>

                                      <input autofocus="" id="updated_by" name="updated_by" placeholder="" type="text" class="form-control"  value="<?php echo set_value('updated_by'); ?>" />
                                      <span class="text-danger"><?php echo form_error('updated_by'); ?></span>
                                    </div>
                                  </div>
                                  <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                                </div>
                            </div>
            </form>                

            </div>
            </div>
            </div>
            <div class="box-header ptbnull"></div>
   <h4 class="box-title box-title"><?php echo $this->lang->line('statement'); ?></h4>
  <div class="table-responsive mailbox-messages">
    <table class="table table-hover table-striped table-bordered example" id="subjects_table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Reference</th>
                <th>Credit</th>
                <th class="pull-right">Debit</th>
                <th>Balance</th>
                <th>Created By</th>
                <th>Updated By</th>
                <th>Created At</th>

            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($statementlist)) {
                foreach ($statementlist as $statement) {
                    ?>
                    <tr>

                        <td><?php echo $statement['id']; ?></td>
                        <td><?php echo $statement['date']; ?></td>
                        <td><?php echo $statement['reference']; ?></td>
                        <td><?php echo $statement['credit']; ?></td>
                        <td class="pull-right"><?php echo $statement['debit']; ?></td>
                        <td><?php echo $statement['Balance']; ?></td>
                        <td><?php echo $statement['created_by']; ?></td>
                        <td><?php echo $statement['updated_by']; ?></td>
                        <td><?php echo $statement['created_at']; ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
  </div>       
</section>
</div>


<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/js/savemode.js"></script>
<!-- runtime validation script for number field -->
<script>
     $(function (){
       $('#credit').keydown(function (er){
        if(er.altkey || er.ctrlKey || er.shiftkey){
          er.preventDefault();
        } 
        else{
          var key = er.keyCode;

          if(!((key == 8) || (key==46)|| (key >=35 && key <=40)|| (key >=48 && key <=57)|| (key >= 96 && key <=105))){

            er.preventDefault();
          }
        }

       });
     });
     $(function (){
       $('#debit').keydown(function (er){
        if(er.altkey || er.ctrlKey || er.shiftkey){
          er.preventDefault();
        } 
        else{
          var key = er.keyCode;

          if(!((key == 8) || (key==46)|| (key >=35 && key <=40)|| (key >=48 && key <=57)|| (key >= 96 && key <=105))){

            er.preventDefault();
          }
        }

       });
     });
     window.setTimeout(function() {
    $(".fahad").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
}, 2000); 
</script>