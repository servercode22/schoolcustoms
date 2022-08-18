<?php


class Loan extends Admin_Controller {

    function __construct() {

        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model("staff_model");
        $this->load->model("loan_model");
        $this->load->library('customlib');  
      
    }

    function index() {
        $this->session->set_userdata('top_menu', 'HR');
        $this->session->set_userdata('sub_menu', 'admin/loanmanage');

        $user_type = $this->staff_model->getStaffRole();
        $data['roletype'] = $user_type;
        $data['alldata'] = $this->loan_model->getresult();
        $this->form_validation->set_rules('role', 'role', 'required');
        $this->form_validation->set_rules('employername', 'employername', 'required');
        $this->form_validation->set_rules('date', 'date', 'required');
        $this->form_validation->set_rules('amount', 'amount', 'required');
        $this->form_validation->set_rules('amount', 'amount', 'required');
        $this->form_validation->set_rules('deductions', 'deductions', 'required');
        

        if($this->input->post("deductions") == "fix"){
            $this->form_validation->set_rules('fix_amount', 'fix_amount', 'required');
        }
        elseif($this->input->post("deductions") == "percentage"){
            $this->form_validation->set_rules('percentage_amount', 'percentage_amount', 'required');
        }
        
        if ($this->form_validation->run() == FALSE)
        {

            
        }
        else{
            $loanprice = $this->input->post("amount");
            $fixamount = $this->input->post("fix_amount");
            $percent_amount = $this->input->post("percentage_amount");
            $deductionTypeInput = $this->input->post("deductions");
            if($fixamount >  $loanprice){
                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">' .'Wait ! <br> Deduction Amount Cannot be greater then loan Amount ' . '</div>');
                redirect('admin/loan/index');
            }
            else{

           
            $id =  $this->input->post("role");
            $emprolename = $this->loan_model->getRolename($id);

            $empid = $this->input->post("employername");
            $getempname =  $this->loan_model->getempid($empid);
            
            $checkexist = $this->loan_model->checkexistence($empid);

           if($empid == $checkexist){

               $userDetails = $this->loan_model->getUser($empid);
               $getloanamount = $userDetails->loan_amount;
               $deductionType = $userDetails->deduct_type;
               $updatedamount = $loanprice + $getloanamount;

               if($deductionType == "fix" && $deductionTypeInput == "fix"){
                $percent_amount = "0";
               }
               elseif($deductionType == "percentage" && $deductionTypeInput == "percentage"){
                $fixamount = "0";
               }
              
                 $update_array = array(
                    "role" => $emprolename,
                    "role_id" => $id,
                    "employee_name" => $getempname,
                    "emp_id" =>  $this->input->post("employername"),
                    "date" => $this->customlib->dateFormatToYYYYMMDD($this->input->post('date')),
                    "loan_amount" => $updatedamount,
                    "deduct_type" =>  $this->input->post("deductions"),
                    "deduct_amount" => $fixamount,
                    "loan_percentage" =>  $percent_amount,
                    "description" => $this->input->post("description")

                );
               $update_data = $this->loan_model->updateUser($update_array,$empid);
               $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . 'Record of this Employee <br> Updated Successfully' . '</div>');
               redirect('admin/loan/index');
               
           }
           else{
         
                $insert_array = array(
                    "role" => $emprolename,
                    "role_id" => $id,
                    "employee_name" => $getempname,
                    "emp_id" =>  $this->input->post("employername"),
                    "date" => $this->customlib->dateFormatToYYYYMMDD($this->input->post('date')),
                    "loan_amount" => $this->input->post("amount"),
                    "deduct_type" =>  $this->input->post("deductions"),
                    "deduct_amount" => $this->input->post("fix_amount"),
                    "loan_percentage" => $this->input->post("percentage_amount"),
                    "description" => $this->input->post("description")

                );
               $insert_data = $this->loan_model->Add($insert_array);
               $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
               redirect('admin/loan/index');
            }
        }
    }
        $this->load->view("layout/header",$data);
        $this->load->view("admin/loan/loanlist",$data);
        $this->load->view("layout/footer",$data);
    }

    function delete($id){
        if (!$this->rbac->hasPrivilege('loanmanage', 'can_delete')) {
            access_denied();
        }
        $deleterecord = $this->loan_model->remove($id);
        $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">' . $this->lang->line('delete_message') . '</div>');
        redirect('admin/loan/index');   
    }

    function edit($id){
    

        $user_type = $this->staff_model->getStaffRole();;
        $data['editdata'] = $this->loan_model->getresultedit($id);
        $data['alldata'] = $this->loan_model->getresult();
        $data['roletype'] = $user_type;
        $this->form_validation->set_rules('role', 'role', 'required');
        $this->form_validation->set_rules('employername', 'employername', 'required');
        $this->form_validation->set_rules('date', 'date', 'required');
        $this->form_validation->set_rules('amount', 'amount', 'required');
        $this->form_validation->set_rules('amount', 'amount', 'required');
        $this->form_validation->set_rules('deductions', 'deductions', 'required');
        

        if($this->input->post("deductions") == "fix"){
            $this->form_validation->set_rules('fix_amount', 'fix_amount', 'required');
        }
        elseif($this->input->post("deductions") == "percentage"){
            $this->form_validation->set_rules('percentage_amount', 'percentage_amount', 'required');
        }
        
        if ($this->form_validation->run() == FALSE)
        {

            $this->load->view("layout/header",$data);
            $this->load->view("admin/loan/editloan",$data);
            $this->load->view("layout/footer",$data);
        }
        else{
            $updatedDeductType = $this->input->post("deductions");
            $UpdatedFixAmount = $this->input->post("fix_amount");
            $UpdatedPrecentAmount = $this->input->post("percentage_amount");

            if($updatedDeductType == "fix"){
                $UpdatedPrecentAmount = 0;
            }
            elseif($updatedDeductType == "percentage"){
                $UpdatedFixAmount = 0;
            }

            $idforrolename =  $this->input->post("role");
            $emprolename = $this->loan_model->getRolename($idforrolename);

            $empid = $this->input->post("employername");
            $getempname =  $this->loan_model->getempid($empid);
           
                $updated_data = array(
                    "role" => $emprolename,
                    "employee_name" => $getempname,
                    "emp_id" =>  $this->input->post("employername"),
                    "date" => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                    "loan_amount" => $this->input->post("amount"),
                    "deduct_type" =>  $this->input->post("deductions"),
                    "deduct_amount" => $UpdatedFixAmount,
                    "loan_percentage" =>$UpdatedPrecentAmount,
                    "description" => $this->input->post("description")

                );
               $insert_data = $this->loan_model->update($updated_data,$id);
               $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . 'Record Update Successfullyy' . '</div>');
               redirect('admin/loan/index');
            }
        
        
    }
        
}

?>