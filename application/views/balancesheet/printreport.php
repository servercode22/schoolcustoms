<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<style type="text/css">
    .page-break	{ display: block; page-break-before: always; }
    @media print {
        .page-break	{ display: block; page-break-before: always; }
        .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
            float: left;
        }
        .col-sm-12 {
            width: 100%;
        }
        .col-sm-11 {
            width: 91.66666667%;
        }
        .col-sm-10 {
            width: 83.33333333%;
        }
        .col-sm-9 {
            width: 75%;
        }
        .col-sm-8 {
            width: 66.66666667%;
        }
        .col-sm-7 {
            width: 58.33333333%;
        }
        .col-sm-6 {
            width: 50%;
        }
        .col-sm-5 {
            width: 41.66666667%;
        }
        .col-sm-4 {
            width: 33.33333333%;
        }
        .col-sm-3 {
            width: 25%;
        }
        .col-sm-2 {
            width: 16.66666667%;
        }
        .col-sm-1 {
            width: 8.33333333%;
        }
        .col-sm-pull-12 {
            right: 100%;
        }
        .col-sm-pull-11 {
            right: 91.66666667%;
        }
        .col-sm-pull-10 {
            right: 83.33333333%;
        }
        .col-sm-pull-9 {
            right: 75%;
        }
        .col-sm-pull-8 {
            right: 66.66666667%;
        }
        .col-sm-pull-7 {
            right: 58.33333333%;
        }
        .col-sm-pull-6 {
            right: 50%;
        }
        .col-sm-pull-5 {
            right: 41.66666667%;
        }
        .col-sm-pull-4 {
            right: 33.33333333%;
        }
        .col-sm-pull-3 {
            right: 25%;
        }
        .col-sm-pull-2 {
            right: 16.66666667%;
        }
        .col-sm-pull-1 {
            right: 8.33333333%;
        }
        .col-sm-pull-0 {
            right: auto;
        }
        .col-sm-push-12 {
            left: 100%;
        }
        .col-sm-push-11 {
            left: 91.66666667%;
        }
        .col-sm-push-10 {
            left: 83.33333333%;
        }
        .col-sm-push-9 {
            left: 75%;
        }
        .col-sm-push-8 {
            left: 66.66666667%;
        }
        .col-sm-push-7 {
            left: 58.33333333%;
        }
        .col-sm-push-6 {
            left: 50%;
        }
        .col-sm-push-5 {
            left: 41.66666667%;
        }
        .col-sm-push-4 {
            left: 33.33333333%;
        }
        .col-sm-push-3 {
            left: 25%;
        }
        .col-sm-push-2 {
            left: 16.66666667%;
        }
        .col-sm-push-1 {
            left: 8.33333333%;
        }
        .col-sm-push-0 {
            left: auto;
        }
        .col-sm-offset-12 {
            margin-left: 100%;
        }
        .col-sm-offset-11 {
            margin-left: 91.66666667%;
        }
        .col-sm-offset-10 {
            margin-left: 83.33333333%;
        }
        .col-sm-offset-9 {
            margin-left: 75%;
        }
        .col-sm-offset-8 {
            margin-left: 66.66666667%;
        }
        .col-sm-offset-7 {
            margin-left: 58.33333333%;
        }
        .col-sm-offset-6 {
            margin-left: 50%;
        }
        .col-sm-offset-5 {
            margin-left: 41.66666667%;
        }
        .col-sm-offset-4 {
            margin-left: 33.33333333%;
        }
        .col-sm-offset-3 {
            margin-left: 25%;
        }
        .col-sm-offset-2 {
            margin-left: 16.66666667%;
        }
        .col-sm-offset-1 {
            margin-left: 8.33333333%;
        }
        .col-sm-offset-0 {
            margin-left: 0%;
        }
        .visible-xs {
            display: none !important;
        }
        .hidden-xs {
            display: block !important;
        }
       
        .hidden-xs.hidden-print {
            display: none !important;
        }
        #maintitle{      
        border-bottom: 1.5px solid skyblue;
        display: inline-block;
        padding-right: 300px;
        line-height: 0.85;
        font-size: 19px;
        }
        .data{
            font-size: 14px;
        }
        .total{
            font-size: 16px;
            font-weight: bold;
        }
        .profit{
            font-size: 20px;
            font-weight: bold;
        }
        .filterdate{
            font-size: 14px;
            font-weight: bold;
        }
        hr.horizantol{
            border-top: 1px solid black;
            margin-top: 0px;
            margin-bottom: 0px;
        }
    }
</style>

<html lang="en">
    <head>
        <title>Balance Sheet Report</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css"> 
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/AdminLTE.min.css">
    </head>
    <body>       
        <div class="container"> 
                        <div class="row">                           
                           
                            <div class="col-md-12 text-center">
                            <?php 
                            foreach($school as $schsetting){
                            $schname = $schsetting['name'];
                            $schemail = $schsetting['email'];
                            $schphone = $schsetting['phone'];
                            ?>
                            <h1><?php echo $schname?></h1>
                            <p><strong>Email</strong> &nbsp;<?php echo $schemail?></p>
                            <p><strong>Phone</strong> &nbsp;<?php echo $schphone?></p>
                            <?php
                            }
                            ?> 
                            </div>
                        </div>
                        <hr class = "horizantol">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <h2> Balance Sheet <br><span class = "filterdate"><?php echo $resultList?></span></h2>
                            </div>
                            <!-- <div class="col-sm-4">
                            <strong>Date: <?php
                                        $date = date('d-m-Y');

                                        echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($date));
                                        ?></strong>
                            </div> -->
                        </div>    
                    </div>
                        <br>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                               <p  id="maintitle">ASSESTS</p>
                               <div class="row">
                                   <?php foreach($fees as $stdfee){
                                       $amount = $stdfee['fees']; 
                                   ?>
                                    <div class="col-sm-6">
                                       <span class = "data">Fees</span>
                                    </div>
                                    <div class="col-sm-6">
                                    <spna class = "data " style="text-decoration:underline;"><?php echo $currency_symbol.$amount?></span>
                                    </div>
                                    <?php
                                }
                                ?>
                                </div>
                                <div class="row">
                                    <?php 
                                     $total = 0;
                                    foreach($income as $incomes){
                                        $incomename = $incomes['name'];
                                        $incomeamount = $incomes['amount'];
                                        $incometype = $incomes['amount_type'];
                    
                                        $total+=$incomes['amount'];
                                    ?>
                                    <div class="col-sm-6">
                                        <?php if($incometype == "Receivable"){?>
                                        <span class = "data"><?php echo $incomename.' '.'Receivable'?></span>
                                        <?php }
                                        else{
                                        ?>
                                        <span class = "data" ><?php echo $incomename?></span>
                                        <?php }?>
                                    </div>
                                    <div class="col-sm-6">
                                    <?php if($incometype == "Receivable"){?>
                                    <span class = "data" style="text-decoration: underline;"><?php echo $currency_symbol.$incomeamount?></span>
                                    <?php
                                    }
                                    else{
                                    ?>
                                     <span class = "data" style="text-decoration: underline;"><?php echo $currency_symbol.$incomeamount?></span>
                                    <?php }?>
                                    </div>
                                    <?php
                                }
                                ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <P  id="maintitle">LIABILITIES</P>
                                <div class="row">
                                   <?php  foreach($salary as $allsalary){
                                     //    $fine = $allfees['grandTotal'];
                                         $salaryamount = $allsalary['net_salary'];
                       
                                   ?>
                                    <div class="col-sm-6">
                                       <span class = "data">Salaries</span>
                                    </div>
                                    <div class="col-sm-6">
                                    <spna class = "data" style="text-decoration: underline;">
                                    <?php
                                      if($salaryamount==""){
                                         echo  $currency_symbol."0";
                                         }
                                    else{
                                          echo  $currency_symbol.$salaryamount;
                                         }
                   ?>
                                    </span>
                                    </div>
                                    <?php
                                }
                                ?>
                                </div>

                                <div class="row">
                                   <?php  foreach($loan as $allloan){
                                     //    $fine = $allfees['grandTotal'];
                                         $loanamount = $allloan['loan_amount'];
                       
                                   ?>
                                    <div class="col-sm-6">
                                       <span class = "data">Employee Loan</span>
                                    </div>
                                    <div class="col-sm-6">
                                    <spna class = "data" style="text-decoration: underline;">
                                    <?php
                                      if($loanamount==""){
                                         echo  $currency_symbol."0";
                                         }
                                    else{
                                          echo  $currency_symbol.$loanamount;
                                         }
                   ?>
                                    </span>
                                    </div>
                                    <?php
                                }
                                ?>
                                </div>
                                <div class="row">
                                    <?php 
                                    $totalexpense = 0;
                                   foreach($expense as $expenses){
                                    $expensename = $expenses['name'];
                                    $expenseamount = $expenses['amount'];
                                    $expensetype = $expenses['expense_amount_type'];

                                    $totalexpense+=$expenses['amount'];
                    
                                        
                                    ?>
                                    <div class="col-sm-6">
                                        <?php if($expensetype == "payable"){?>
                                        <span class = "data"><?php echo $expensename.' '.'Payable'?></span>
                                        <?php }
                                        else{
                                        ?>
                                        <span class = "data"><?php echo $expensename?></span>
                                        <?php }?>
                                    </div>
                                    <div class="col-sm-6">
                                    <?php if($expensetype == "payable"){?>
                                    <span class = "data"  style="text-decoration: underline;"><?php echo $currency_symbol.$expenseamount?></span>
                                    <?php
                                    }
                                    else{
                                    ?>
                                     <span class = "data" style="text-decoration: underline;"><?php echo $currency_symbol.$expenseamount?></span>
                                    <?php }?>
                                    </div>
                                    <?php
                                }
                                ?>
                                </div> 
                            </div>
                        </div>
                        <br>
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-6">
                                 <div class="row">
                                     <div class="col-sm-6">
                                     <span class = "total">Total Assests</span>
                                     </div>
                                     <div class="col-sm-6">
                                     <span  class = "total" style="text-decoration: underline;"><?php $totalassets = $amount+$total;
                                                 echo  $currency_symbol.$totalassets;?>
                                    </span>
                                     </div>
                                 </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                        <span  class = "total">
                                            Total Liabilities
                                        </span>
                                        </div>
                                        <div class="row-sm-6">
                                        <span  class = "total" style="text-decoration: underline;"><?php
                                         $totalliability = $salaryamount+$loanamount+$totalexpense;
                                        echo  $currency_symbol.$totalliability;
                                        ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row" style="margin-left: 80px;">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <span class = "profit">Net Profit</span>
                                        </div>
                                        <div class="col-sm-6">
                                            <span class = "profit"><?php
                                                $netprofit =  $totalassets-$totalliability;
                                                echo $currency_symbol.$netprofit;
                                            ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        <div class="clearfix"></div>
    </body>
</html>
