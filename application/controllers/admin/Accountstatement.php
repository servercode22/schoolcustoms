<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Accountstatement extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('statement_model');
    }
    function index(){
    
        $this->session->set_userdata('top_menu', 'Accounts');
        $this->session->set_userdata('sub_menu', 'accounts/index');
        $data['title_list'] = 'Balance Sheet';
        $this->form_validation->set_rules('date', $this->lang->line('date'),'required');
        $this->form_validation->set_rules('reference', $this->lang->line('reference'),'required');
        $this->form_validation->set_rules('credit', $this->lang->line('credit'),'required');
        $this->form_validation->set_rules('debit', $this->lang->line('debit'),'required');
        $this->form_validation->set_rules('created_by', $this->lang->line('created_by'),'required');
        $this->form_validation->set_rules('updated_by', $this->lang->line('updated_by'),'required');
        if ($this->form_validation->run()==false) {
         
        }
        else {
            $data = array();
            $data['date'] = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date')));
            $data['reference'] = $this->input->post('reference');
            $data['credit'] = $this->input->post('credit');
            $data['debit'] = $this->input->post('debit');
            $data['created_by'] = $this->input->post('created_by');
            $data['updated_by'] = $this->input->post('updated_by');
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->statement_model->create($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
               redirect('admin/accountstatement');
          }//end else
        
        $data['statementlist'] = $this->statement_model->get(); //get data from db to view
        $this->load->view('layout/header', $data);
        $this->load->view('statement/add_account_statement', $data);
        $this->load->view('layout/footer', $data);
    }


}
