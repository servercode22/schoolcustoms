<style type="text/css">
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    } 
    #printreport{
        margin-left: 480px;
    }
</style>
<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-usd"></i> <?php echo $this->lang->line('income'); ?></h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <form role="form" action="<?php echo site_url('admin/balancesheet/balancesheetreport')?>" method="post" class="">
                                        <?php echo $this->customlib->getCSRF(); ?>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('search') . " " . $this->lang->line('type'); ?></label>
                                                <select class="form-control" id="searchdate" name='search_type' onchange="showdate(this.value)">

                                                    <?php foreach ($searchlist as $key => $search) {
                                                        ?>
                                                        <option value="<?php echo $key ?>" <?php
                                                        if ((isset($search_type)) && ($search_type == $key)) {
                                                            echo "selected";
                                                        }
                                                        ?>><?php echo $search ?></option>
                                                            <?php } ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('search_type'); ?></span>
                                            </div>
                                        </div>

                                        <div id='date_result'>

                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <button type="submit" name="search"  value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

            <!-- /.row -->
        <?php
        if (isset($resultList)){
        ?>

            <h2 class = "text-center">Balance Sheet Report of <br> <?php echo $resultList?></h2><br>
            <button class = "btn btn-success text-center" id="printreport">Generate Report</button>
            <br>
            <div class="container" style="margin-left: 200px;" id="maincontent">
           <div class="row">
               <div class="col-md-6">
                   <h3>Assests</h3>
                   <?php 
                   foreach($fees as $allfees){
                    //    $fine = $allfees['grandTotal'];
                    
                       $amount = $allfees['fees'];  
                       
                   ?>
                    <br>
                    <h4>Fees</h4> <?php echo $currency_symbol.$amount?>

                <?php
                }
                ?>
                <?php 
                $total = 0;
                foreach($income as $incomes){
                    $incomename = $incomes['name'];
                    $incomeamount = $incomes['amount'];
                    $incometype = $incomes['amount_type'];

                    $total+=$incomes['amount'];
                ?>
                <?php if($incometype == "Receivable"){?>
                    <h4><?php echo $incomename .' '.'Receivable'?></h4><?php echo  $currency_symbol.$incomeamount?>
                <?php
                }
                else{
                ?>
                <h4><?php echo $incomename?></h4><?php echo  $currency_symbol.$incomeamount?>
                <?php
                }
                ?>
                <?php
                }
                ?>
               
               </div>
               <div class="col-md-6">
                   <h3>Liabilities</h3>
                   <?php 
                   foreach($salary as $allsalary){
                    //    $fine = $allfees['grandTotal'];
                       $salaryamount = $allsalary['net_salary'];
                       
                       
                   ?>
                    <br>
                    
                    <h4>$Salaries</h4> <?php
                        if($salaryamount==""){
                            echo  $currency_symbol."0";
                        }
                        else{
                            echo  $currency_symbol.$salaryamount;
                        }
                   ?>
                
                <?php
                }
                ?>


                    <?php 
                   foreach($loan as $allloan){
                    //    $fine = $allfees['grandTotal'];
                       $loanvalue = $allloan['loan_amount'];
                       
                       
                   ?>
                    <br>
                    
                    <h4>$Employee Loan</h4> <?php
                        if($loanvalue==""){
                            echo  $currency_symbol."0";
                        }
                        else{
                            echo  $currency_symbol.$loanvalue;
                        }
                   ?>
                
                <?php
                }
                ?>
                  <?php 
                  $totalexpense = 0; 
                foreach($expense as $expenses){
                    $expensename = $expenses['name'];
                    $expenseamount = $expenses['amount'];
                    $expensetype = $expenses['expense_amount_type'];
                    $totalexpense+=$expenses['amount'];
                ?>
                <?php if($expensetype == "payable"){?>
                    <h4><?php echo $expensename .' '.'Payable'?></h4><?php echo  $currency_symbol.$expenseamount?>
                <?php
                }
                else{
                ?>
                <h4><?php echo $expensename?></h4><?php echo  $currency_symbol.$expenseamount?>
                <?php
                }
                ?>
                <?php
                }
                ?>
               </div>
           </div>
           <div class="row">
               <div class="col-md-6">
               <h4>Total Assests</h4>
                <?php 
                 $totalassets = $amount+$total;
                echo  $currency_symbol.$totalassets;         
                ?>
               </div>
                <div class="col-md-6">
                    <h4>Total Liabilities</h4>
                    <?php 
                 $totalliability = $salaryamount+$loanvalue+ $totalexpense;
                echo  $currency_symbol.$totalliability;         
                ?>
                </div>
           </div><br>
           <div class="row">
               <div class="col-md-6">
                   <h2>Net Profit</h2>
               </div>
               <div class="col-md-6">
                   <h2>
                   <?php 
                   $netprofit = $totalassets-$totalliability;
                   echo  $currency_symbol.$netprofit;
                    ?>
                    </h2>
               </div>
           </div>
       </div> 
    </div>
    <br>
    <div class="container">
           <div class="row">
               <div class="col-md-6">

               </div>
               <div class="col-md-6">
                   
               </div>
           </div>
       </div> 
</div>
       <?php
                }
                
                ?>
    </section><!-- /.content -->
</div>
<script>
    <?php
if ($search_type == 'period') {
    ?>

        $(document).ready(function () {
            showdate('period');
        });

    <?php
}
?>
</script>

<script>
    $("#printreport").on('click', function(e){
        e.preventDefault();
        var datevalue = $('#searchdate').val();
        $.ajax({
            url:'<?php echo base_url(); ?>admin/balancesheet/printReport/',
            type:'post',
            data:{datevalue:datevalue},
            success:function(response){
                Popup(response);
            }
        });
    });





    function Popup(data, winload = false)
    {
        var frame1 = $('<iframe />').attr("id", "printDiv");
        frame1[0].name = "frame1";
        frame1.css({"position": "absolute", "top": "-1000000px"});
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html>');
        frameDoc.document.write('<head>');
        frameDoc.document.write('<title></title>');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/font-awesome.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/ionicons.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/AdminLTE.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/skins/_all-skins.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/iCheck/flat/blue.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/morris/morris.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/datepicker/datepicker3.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/daterangepicker/daterangepicker-bs3.css">');
        frameDoc.document.write('</head>');
        frameDoc.document.write('<body>');
        frameDoc.document.write(data);
        frameDoc.document.write('</body>');
        frameDoc.document.write('</html>');
        frameDoc.document.close();
        setTimeout(function () {
        document.getElementById('printDiv').contentWindow.focus();
        document.getElementById('printDiv').contentWindow.print();
            // frame1.remove();
            if (winload) {
                window.location.reload(true);
            }
        }, 500);


        return true;
    }
</script>