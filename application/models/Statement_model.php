<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class statement_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
        
    }
    public function create($data)
  {
    $this->db->insert('account_statement',$data);
  }
  public function get($id = null) {
    $this->db->select('id,date,reference,created_by,updated_by,created_at,credit,debit ,  SUM(coalesce(credit,0) - coalesce(debit,0)) OVER (ORDER BY id ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW)as Balance')->from('account_statement');
    if ($id != null) {
        $this->db->where('account_statement.id', $id);
    } else {
        $this->db->order_by('account_statement.id');
    }
    $query = $this->db->get();
    if ($id != null) {
        return $query->row_array();
    } else {
        return $query->result_array();
    }
   }

}