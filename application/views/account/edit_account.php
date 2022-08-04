<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('create_account'); ?>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
            <div class="row">
            <div class="col-md-12">
            <div class="box box-primary">
            <form id="form1" action="<?php echo site_url('admin/account/edit/'.$account['id']) ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">                       
                        <div class="">
                            <div class="bozero">
                                <h4 class="pagetitleh-whitebg"><?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('update_account'); ?> </h4>
                                <div class="around10">
                                    <?php if ($this->session->flashdata('msg')) { ?>
                                        <?php echo $this->session->flashdata('msg') ?>
                                    <?php } ?>
                                    <?php if (isset($error_message)) { ?>
                                        <div class="alert alert-warning"><?php echo $error_message; ?></div>
                                    <?php } ?>
                                    <?php echo $this->customlib->getCSRF(); ?>
                                  <div class="row">
                                   <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1"><?php echo $this->lang->line('account_no'); ?></label> <small class="req"> *</small>

                                      <input autofocus="" id="account_no" name="account_no" placeholder="" type="text" class="form-control"  value="<?php echo set_value('account_no',$account['account_no']); ?>" />
                                      <span class="text-danger"><?php echo form_error('account_no'); ?></span>
                                    </div>
                                   </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1"><?php echo $this->lang->line('bank_name'); ?></label> <small class="req"> *</small>

                                      <input autofocus="" id="bank_name" name="bank_name" placeholder="Bank Name" type="text" class="form-control"  value="<?php echo set_value('bank_name',$account['bank_name']); ?>" />
                                      <span class="text-danger"><?php echo form_error('bank_name'); ?></span>
                                    </div>
                                  </div>
                                  <div class="row">
                                   <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1"><?php echo $this->lang->line('initial_balance'); ?></label> <small class="req"> *</small>

                                      <input autofocus="" id="initial_balance" name="initial_balance" placeholder="initial balance" type="text" class="form-control"  value="<?php echo set_value('initial_balance',$account['initial_balance']); ?>" />
                                      <span class="text-danger"><?php echo form_error('initial_balance'); ?></span>
                                     </div>
                                     </div>
                                     <div class="col-md-6">
                                     <div class="form-group">
                                      <label for="exampleInputEmail1"><?php echo $this->lang->line('note'); ?></label> <small class="req"> *</small>

                                      <input autofocus="" id="note" name="note" placeholder="" type="text" class="form-control"  value="<?php echo set_value('note',$account['note']); ?>" />
                                      <span class="text-danger"><?php echo form_error('note'); ?></span>
                                      </div>
                                    </div>
                                    <div class="box-footer">
                                   <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('update'); ?></button>
                                    </div>
                                </div>
                            </div>
                            </div>
            </form>                

            </div>
            </div>
            </div>
           
</section>
</div>


<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/js/savemode.js"></script>