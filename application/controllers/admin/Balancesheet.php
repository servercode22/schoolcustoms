<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Balancesheet extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('statement_model');
        $this->load->model('Balancesheet_model');
    }
    function balancesheetreport(){
        // if (!$this->rbac->hasPrivilege('collect_fees', 'can_view')) {
        //     access_denied();
        // }
        $this->session->set_userdata('top_menu', 'Accounts');
        $this->session->set_userdata('sub_menu', 'accounts/index');
        $this->session->set_userdata('sub_menu', 'accounts/balancesheet');
        $data['title'] = 'Balance Sheet Report';
        $data['searchlist'] = $this->customlib->get_searchtype();
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            $this->load->view('layout/header',$data);
        $this->load->view('balancesheet/balancesheetlist',$data);
        $this->load->view('layout/footer',$data);   
        }
        else{
        $data['search_type'] = $_POST['search_type'];
        
        if (isset($_POST['search_type']) && $_POST['search_type'] != '') {
            if ($_POST['search_type'] == 'all') {
                $dates = $this->customlib->get_betweendate('this_year');
            } else {
                $dates = $this->customlib->get_betweendate($_POST['search_type']);
            }
    
            $data['search_type'] =  $_POST['search_type'];
        } else {
    
            $dates = $this->customlib->get_betweendate('this_year');
            $data['search_type'] = '';
        }
        $dateformat = $this->customlib->getSchoolDateFormat();
         $this->customlib->dateFormatToYYYYMMDD($dates['from_date']);
         $date_from = date('Y-m-d', strtotime($dates['from_date']));
        $date_to = date('Y-m-d', strtotime($dates['to_date']));
        $date_from = date('Y-m-d', $this->customlib->dateYYYYMMDDtoStrtotime($date_from));
        $date_to = date('Y-m-d', $this->customlib->dateYYYYMMDDtoStrtotime($date_to));
        // $studentID = $this->Balancesheet_model->getstdid($date_from, $date_to);
        // foreach($studentID as $value){
        //     $stdID = $value['student_id'];
        //     print_r($stdID);
        
        //      $totalfine = $this->Balancesheet_model->getTotalFine($stdID);
        // }
        $staffsalary = $this->Balancesheet_model->staffsalary($date_from, $date_to);
        $studentallfee = $this->Balancesheet_model->Allfee($date_from, $date_to);
        $income = $this->Balancesheet_model->AllIncome($date_from, $date_to);
        $expense = $this->Balancesheet_model->AllExpense($date_from, $date_to);
        $loanAmount = $this->Balancesheet_model->Allloan($date_from, $date_to);
        $data['expense'] = $expense;
        $data['income'] = $income;
        $data['salary'] =  $staffsalary;
        $data['fees'] = $studentallfee;
        $data['loan'] = $loanAmount;
        $data['resultList'] = $date_from.' '.'To'.' '. $date_to;
        $this->load->view('layout/header',$data);
        $this->load->view('balancesheet/balancesheetlist',$data);
        $this->load->view('layout/footer',$data);   
    }
}
    function printReport(){

        $input = $this->input->post('datevalue');

        if (isset($input) && $input != '') {
            if ($input == 'all') {
                $dates = $this->customlib->getdatesforbalancesheet('this_year');
            } else {
                $dates = $this->customlib->getdatesforbalancesheet($input);
            }
    
            $input =  $this->input->post('datevalue');
        } else {
    
            $dates = $this->customlib->getdatesforbalancesheet('this_year');
            $data['search_type'] = '';
        }
        $dateformat = $this->customlib->getSchoolDateFormat();
         $this->customlib->dateFormatToYYYYMMDD($dates['from_date']);
         $date_from = date('Y-m-d', strtotime($dates['from_date']));
        $date_to = date('Y-m-d', strtotime($dates['to_date']));
        $date_from = date('Y-m-d', $this->customlib->dateYYYYMMDDtoStrtotime($date_from));
        $date_to = date('Y-m-d', $this->customlib->dateYYYYMMDDtoStrtotime($date_to));
        // $studentID = $this->Balancesheet_model->getstdid($date_from, $date_to);
        // foreach($studentID as $value){
        //     $stdID = $value['student_id'];
        //     print_r($stdID);
        
        //      $totalfine = $this->Balancesheet_model->getTotalFine($stdID);
        // }
        $staffsalary = $this->Balancesheet_model->staffsalary($date_from, $date_to);
        $studentallfee = $this->Balancesheet_model->Allfee($date_from, $date_to);
        $income = $this->Balancesheet_model->AllIncome($date_from, $date_to);
        $expense = $this->Balancesheet_model->AllExpense($date_from, $date_to);
        $schsetting = $this->Balancesheet_model->Getschool();
        $emploan = $this->Balancesheet_model->Allloan($date_from, $date_to);

        $data['school'] = $schsetting;
        $data['expense'] = $expense;
        $data['income'] = $income;
        $data['salary'] =  $staffsalary;
        $data['fees'] = $studentallfee;
        $data['loan'] = $emploan;
        $data['resultList'] =  $date_from.' '.'To'.' '. $date_to;
        $this->load->view('balancesheet/printreport',$data);
   
        
    }
}