<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class voucher_settings_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->current_session_name = $this->setting_model->getCurrentSessionName();
        $this->start_month = $this->setting_model->getStartMonth();
    }

    public function show()
	{
		$this->db->where('id',1);
		return $this->db->get('voucher_settings')->result();
	}

    public function addNew($attributes,$fileName='') {
		$this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
		$data=$this->input->post('json_string',TRUE);
		if($fileName!=''){
			$data['image']=$fileName;
		}
		$data=json_encode($data);
		$this->db->insert('voucher_settings',[$attributes=>$data]);
		$id = $this->db->insert_id();
        $message = INSERT_RECORD_CONSTANT . " On visitors purpose id " . $id;
        $action = "Insert";
        $record_id = $id;
        $this->log($message, $record_id, $action);
        //echo $this->db->last_query();die;
        //======================Code End==============================
        $this->db->trans_complete(); # Completing transaction
        /* Optional */
        if ($this->db->trans_status() === false) {
            # Something went wrong.
            $this->db->trans_rollback();
            return false;
        } else {
            //return $return_value;
        }
        
    }

    public function delete($id) {
       
    }

    public function update($attributes, $fileName) {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
		//=======================Code Start===========================
		$data=$this->input->post();
		/* print_r(json_encode($data));
		exit; */
		if($fileName!=''){
			$data['image']=$fileName;
		}
		$data=json_encode($data);
        $this->db->where('id', 1);
        $this->db->update('voucher_settings',[$attributes=> $data]);
        $message = UPDATE_RECORD_CONSTANT . " On voucher settings id 1";
        $action = "Update";
        $record_id = 1;
        $this->log($message, $record_id, $action);
        //======================Code End==============================

        $this->db->trans_complete(); # Completing transaction
        /* Optional */

        if ($this->db->trans_status() === false) {
            # Something went wrong.
            $this->db->trans_rollback();
            return false;
        } else {
            //return $return_value;
        }
    }

}
