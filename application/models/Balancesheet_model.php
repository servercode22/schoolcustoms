<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Balancesheet_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }
    function Allfee($start_date,$end_date){
        $this->db->select_sum("fees");
		$this->db->where('validity_date >=', $start_date);
		$this->db->where('validity_date <=', $end_date);
		 $this->db->from('fee_vouchers');
         $query = $this->db->get();
        
		return $query->result_array();
	}
    // function getstdid($start_date,$end_date){
    //     $this->db->select("student_id");
	// 	$this->db->where('validity_date >=', $start_date);
	// 	$this->db->where('validity_date <=', $end_date);
	// 	 $this->db->from('fee_vouchers');
    //      $query = $this->db->get();
	// 	 return $query->result_array();
    //     //  $result = array_values(array_column($q, 'student_id'));
    //     //  return $result;
         
    // }
    // function getTotalFine($studentID){
    //     $this->db->select_sum("grandTotal");
	// 	$this->db->where('student_id',$studentID);
	// 	 $this->db->from('grandtotal_fine');
    //      $query = $this->db->get();
	// 	return $query->result_array();
    // }


    function staffsalary($start_date,$end_date){
        $this->db->select_sum("net_salary");
		$this->db->where('payment_date >=', $start_date);
		$this->db->where('payment_date <=', $end_date);
		 $this->db->from('staff_payslip');
         $query = $this->db->get();
		return $query->result_array();
    }
    function AllIncome($start_date,$end_date){
        $this->db->select("*");
		$this->db->where('date >=', $start_date);
		$this->db->where('date <=', $end_date);
		 $this->db->from('income');
         $query = $this->db->get();
		return $query->result_array();
    }
    function AllExpense($start_date,$end_date){
        $this->db->select("*");
		$this->db->where('date >=', $start_date);
		$this->db->where('date <=', $end_date);
		 $this->db->from('expenses');
         $query = $this->db->get();
		return $query->result_array();
    }

    function Getschool(){
        $this->db->select("*");
        $this->db->from("sch_settings");
        $query = $this->db->get();
		return $query->result_array();
    }

    function Allloan($start_date,$end_date){
        $this->db->select_sum("loan_amount");
		$this->db->where('date >=', $start_date);
		$this->db->where('date <=', $end_date);
		 $this->db->from('manage_loan');
         $query = $this->db->get();
		return $query->result_array();
    }
    
}
