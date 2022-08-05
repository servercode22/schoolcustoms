<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Account extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('account_model');
    }

     function index(){
        $this->session->set_userdata('top_menu', 'Accounts');
        $this->session->set_userdata('sub_menu', 'account/index');
        $this->session->set_userdata('sub_menu', 'account/balancesheet');
        $data['title'] = 'Accounts';
        $data['title_list'] = 'Account List';
       $this->form_validation->set_message('is_unique','Account number already Exist. ');

       $this->form_validation->set_rules('account_no', $this->lang->line('account_no'),'required|min_length[10]|max_length[18]|is_unique[account.account_no]');
       $this->form_validation->set_rules('bank_name', $this->lang->line('bank_name'),'required');
       $this->form_validation->set_rules('initial_balance', $this->lang->line('initial_balance'),'required');
       $this->form_validation->set_rules('note', $this->lang->line('note'));

       if ($this->form_validation->run()==false) {
        
       }
       else {
         $data = array();
         $data['account_no'] = $this->input->post('account_no');
         $data['bank_name'] = $this->input->post('bank_name');
         $data['initial_balance'] = $this->input->post('initial_balance');
         $data['note'] = $this->input->post('note');
         $data['created_at'] = date('Y-m-d H:i:s');
         $this->account_model->create($data);
         $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/account');
       }//end else

       $data['accountlist'] = $this->account_model->get(); //get data from db to view

       $this->load->view('layout/header', $data);
       $this->load->view('account/add_account', $data);
       $this->load->view('layout/footer', $data);
    }
         
    function edit($id) {
        
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'accounts/index');
        $data['title'] = 'Edit account';
        $data['id'] = $id;
        

       $this->form_validation->set_rules('account_no', $this->lang->line('account_no'),'required|min_length[10]|max_length[18]');
       $this->form_validation->set_rules('bank_name', $this->lang->line('bank_name'),'required');
       $this->form_validation->set_rules('initial_balance', $this->lang->line('initial_balance'),'required');
       $this->form_validation->set_rules('note', $this->lang->line('note'));
        if ($this->form_validation->run() == FALSE) {
            $data['account'] = $this->account_model->get($id);
            
            
        }
        else {
            $branch_array =[
				'id' => $id,
				'account_no' => $this->input->post('account_no'),
                'bank_name' => $this->input->post('bank_name'),
                'initial_balance' => $this->input->post('initial_balance'),
                'note' => $this->input->post('note'),
			];
            $this->account_model->edit($branch_array);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
               redirect('admin/account');
          }//end else 
        $this->load->view('layout/header', $data);
        $this->load->view('account/edit_account', $data);
        $this->load->view('layout/footer', $data);
        
         
    }
 
}    