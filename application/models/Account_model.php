<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class account_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
        
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */

    /* this function will insert data in database */
  public function create($data)
  {
    $this->db->insert('account',$data);
  }
  public function get($id = null) {
    $this->db->select()->from('account');
    if ($id != null) {
        $this->db->where('account.id', $id);
    } else {
        $this->db->order_by('account.id');
    }
    $query = $this->db->get();
    if ($id != null) {
        return $query->row_array();
    } else {
        return $query->result_array();
    }
   }
   public function edit($data){
    if (isset($data['id'])) {
			
        $this->db->where('id', $data['id']);
        $this->db->update('account', $data);
        $message = UPDATE_RECORD_CONSTANT . " On  account id " . $data['id'];
        $action = "Update";
        $record_id = $data['id'];
        $this->log($message, $record_id, $action);
    }
   }
}