<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class voucher extends Admin_Controller{
	public function __construct() {
        parent::__construct();
		
        $this->search_type = $this->config->item('search_type');
		$this->sch_setting_detail = $this->setting_model->getSetting();
		$this->load->model('voucher_settings_model');
		$this->load->helper("url");
	}
	
	public function index()
	{
		$data['title'] = 'voucher settings';
		$data['voucher']=$this->voucher_settings_model->show();
		
		
		$this->load->view('layout/header', $data);
        $this->load->view('admin/voucher/index', $data);
        $this->load->view('layout/footer', $data);
	}

	public function update($attribute){

		$data= $this->db->get('voucher_settings');
		//print_r($this->input->post());
		//exit;

		if (isset($_FILES['userfile']['name']) && !empty($_FILES['userfile']['name'])) {
			$imagedata=$this->imageUpload();
			if($imagedata['status']=='success'){
				if($data->num_rows() > 0){
					$this->voucher_settings_model->update($attribute,$imagedata['name']);
					
				}else{
					$this->voucher_settings_model->addNew($attribute,$imagedata['name']);
				}
			}else{
				echo 'could not upload image';
			}
		}else{
			if($data->num_rows() > 0){
				$this->voucher_settings_model->update($attribute,'');
				
			}else{
				$this->voucher_settings_model->addNew($attribute,'');
			}
		}
		$this->session->set_flashdata('msg', '<div class="alert alert-success">' . $this->lang->line('success_message') . '</div>');
                redirect('/voucher');
		
		
		
	}

	
	public function imageUpload()
    {
        $config = array(
            'upload_path'   => "./uploads/vouchers/",
            'allowed_types' => "gif|jpg|png|jpeg|df",
            'overwrite'     => true,
		);
		$name=substr(md5(time()), 0, 7);
		$config['file_name'] =  $name. ".jpg";
		if(!is_dir($config['upload_path'])){
			mkdir($config['upload_path'], 0777, true);
		}
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if ($this->upload->do_upload()) {
			return array('status' =>'success','name'=> $config['file_name']);
        } else {
            return array('status' =>'fail','error' => $this->upload->display_errors());

        }
    }
}
