<?php

class Loan_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
    } 
    
    function getRolename($id){
        $this->db->select('name');
        $this->db->where('id', $id);
        $this->db->limit(1);
        $this->db->order_by('id',"DESC");

        $query = $this->db->get('roles');

        $d = $query->row_array();
		if(!empty($d)){
			return $d['name'];
		}else{
			return false;
		}
    }
    function getempid($empid){
        $this->db->select('name');
        $this->db->where('id', $empid);
        $this->db->limit(1);
        $this->db->order_by('id',"DESC");

        $query = $this->db->get('staff');

        $d = $query->row_array();
		if(!empty($d)){
			return $d['name'];
		}else{
			return false;
		}
    }

    function getresult(){
        $this->db->select("*");
        $this->db->from("manage_loan");
        $query = $this->db->get();
        if(!empty($query)){
            return $query->result_array();
        } 
        else{
            return false;
        }
    }

    function Add($insert_array){
        $query = $this->db->insert('manage_loan',$insert_array);
        return $query;
    }
    
  function remove($id){
        $this->db->where("id", $id);
     $query =  $this->db->delete("manage_loan");
     return $query;
     
  }
  function getresultedit($id){
      $this->db->select("*");
      $this->db->from("manage_loan");
      $this->db->where("id", $id);
      $query = $this->db->get();
      return $query->row();
  }
  function update($insert_array,$id){
      $this->db->where("id",$id);
      $this->db->update("manage_loan", $insert_array);
  }


 function checkexistence($empid){
    $this->db->select('emp_id');
    $this->db->where('emp_id', $empid);
    $this->db->limit(1);
    $this->db->order_by('id',"DESC");

    $query = $this->db->get('manage_loan');

    $d = $query->row_array();
    if(!empty($d)){
        return $d['emp_id'];
    }else{
        return false;
    }
 }
 
 function getUser($empid){
    $this->db->select("*");
    $this->db->from("manage_loan");
    $this->db->where("emp_id", $empid);
    $query = $this->db->get();
    return $query->row();
 }

 function updateUser($update_array,$empid){
     $this->db->where("emp_id",$empid);
     $this->db->update("manage_loan", $update_array);
 }
}
