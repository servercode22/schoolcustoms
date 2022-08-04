<!-- =======Design and Developed by Amir======= -->
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

	<title>Document</title>
	<style>
		table {
			table-layout: fixed;
			width: 100%;
		}

		td,
		th {
			border: 1px solid #000;

		}

		.main-title {
			font-size: 1.25rem;
			font-weight: bolder;
		}

		td+td {
			width: auto;
		}

		.dash {
			border-right: 3px dashed black;
		}

		.slip-area {
			padding: 1px;
			border: 1px solid black;
			background-color: white;
			height: 718px;
		}

		input {
			border: 0px;
			border-bottom: 1px solid black;
			text-align: center;
			font-size: small;
		}
	</style>
</head>

<body>


			
	<div class="container">
		<?php
		
		foreach($data as $d){
		?>
		<div class="row mt-2 mb-2" style="page-break-after: always;">
		<?php $i=1;
		$bankInfo=json_decode($d['voucher'][0]->bank_info);
		$schoolInfo=json_decode($d['voucher'][0]->school_info);
		$voucher=json_decode($d['voucher'][0]->voucher_types);
		$copyTypes=explode(',',$voucher->name);
		$studentInfo=json_decode($d['voucher'][0]->students);
		$instructions=json_decode($d['voucher'][0]->instructions);
		$col = 12/(count($copyTypes)+1);
		?>

			<?php 
			
			
				/* echo '<pre>';
				print_r($d);
				exit; */
				foreach($copyTypes as $key=> $type){
				?>
				
			<div class="col-md-<?php echo $col ?> <?php echo $key === array_key_last($copyTypes)?'':'dash'?>">
				<div class="slip-area">
					<section class="text-center ">
						<div class="main-title">
						<?php if(isset($schoolInfo->image) && $schoolInfo->image!=''){ ?>
							<span class="logo-mini"><img width="33px" height="33px" src="<?php echo base_url(); ?>uploads/vouchers/<?php echo $schoolInfo->image; ?>" alt="<?php echo $schoolInfo->name ?>" /></span>
							<?php } ?> 	
						<?php echo (isset($schoolInfo->name)&&$schoolInfo->name!='')?$schoolInfo->name:'' ?></div>
						<div><?php echo (isset($schoolInfo->acInfo)&&$schoolInfo->acInfo!='')?$schoolInfo->acInfo:'' ?></div>
						<div class="font-italic">
							<?php if(isset($bankInfo->image) && $bankInfo->image!=''){ ?>
							<span class="logo-mini"><img width="33px" height="33px" src="<?php echo base_url(); ?>uploads/vouchers/<?php echo $bankInfo->image; ?>" alt="<?php echo $bankInfo->name ?>" /></span>
							<?php } ?> 
							<span>
							<?php
								echo $bankInfo->name;
							?>
							</span>

							 </div>
							 <div><?php echo (isset($bankInfo->acInfo)&&$bankInfo->acInfo!='')?$bankInfo->acInfo:'' ?></div>
						<div class="font-weight-bold"> <?php echo $type?> Copy</div>
					</section>
					<hr>
					<br>
					<?php
					if(isset($studentInfo->admission_no) && $studentInfo->admission_no=='checked'){
					?>
					<b>Admission No</b> <input type="text" class="" value="<?php echo $d['student']['admission_no']; ?>"> <br>
					<?php } ?>
					<?php
					if(isset($studentInfo->roll_no) && $studentInfo->roll_no=='checked'){
					?>
					 Roll No: <input type="text" value="<?php echo $d['student']['roll_no'];?>"> <br>
					<?php } ?>
					<?php
					if(isset($studentInfo->name) && $studentInfo->name=='checked'){
					?>
					Student Name <input type="text" value="<?php print_r($d['student']['firstname']." ".$d['student']['lastname']);?>"><br>
					<?php } ?>
					<?php
					if(isset($studentInfo->father_name) && $studentInfo->father_name=='checked'){
					?>
					Father name <input type="text" value="<?php echo $d['student']['father_name'];?>"><br>
					<?php } ?>
					<?php
					if(isset($studentInfo->class) && $studentInfo->class=='checked'){
					?>
					Class <input type="text" value="<?php echo $d['student']['class'];?>"><br>
					<?php } ?>
					<?php
					if(isset($studentInfo->section) && $studentInfo->section=='checked'){
					?>
					Section <input type="text" value="<?php echo $d['student']['section'];?>"><br>
					<?php } ?>
					issue Date <input type="text" value="<?php echo date('d-M-Y',time())?>"> <br> Due date<input type="text" value="<?php echo isset($d['student_due_fee'][0]->fees[0]->due_date)?$d['student_due_fee'][0]->fees[0]->due_date:'';?>"><br>
					<br>

					<table style="table-layout: fixed;">
						<thead class="text-center bg-secondary">
							<tr>
								<th colspan="4">Particulars</th>
								<th colspan="2">Amount</th>
							</tr>

						</thead>
						<tbody>
							<?php $total=0;
							
							foreach($d['student_due_fee'] as $key=>$item){
								foreach($item->fees as $k=>$fee){
									if($fee->student_fees_deposite_id==0){
									$total+=$fee->amount;
							?>
							
							<tr>
								<td colspan="4"><?php echo $fee->type ?></td>
								<td colspan="2" class="text-center"> <?php echo $fee->amount;?></td>
							</tr>
							<?php }
							}
						 }?>
						<?php 
						foreach($d['student_discount_fee'] as $j => $dis){
							$total-=$dis['amount'];
						?>
						<tr>
								<td colspan="4"><?php echo $dis['name']." Discount"; ?></td>
								<td colspan="2"> <?php echo $dis['amount'];?></td>
							</tr>
						<?php 
							}?>
						</tbody>
						<tfoot class="text-center bg-secondary">
							<th colspan="4">Net Payable</th>
							<th colspan="2"><?php echo $total;?></th>
						</tfoot>
					</table>

					<br>
					<br>
					<br>
					<div class="text-center"> <b>(Signature and Stamp)</b></div>
					<br>
					<br>
					<br>
				</div>
			</div>
			<?php }  ?>
			<div class="col-md-<?php echo $col ?>">
				<?php echo $instructions->instruction ?>
			</div>
		</div>
				<?php } ?>
		
	</div>
</body>

</html>
