<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuditTrials extends CI_Controller {

	
        function __construct() {
            parent::__construct();
            $this->load->model('Audit_trial_model');
        }


        public function index()
	{
            $this->view_search_logs();
	}
        
        function view_search_logs($datas=''){
            
            $data['log_list'] = $this->Audit_trial_model->search_result();
            $data['main_content']='audit_trials/search_audit_trials'; 
            $this->load->view('includes/template',$data);
	}
                                        
	
	function view($id){ 
                $data['log_data'] = $this->Audit_trial_model->get_single_log($id); 
		$data['action']		= 'View';
		$data['main_content']='audit_trials/manage_audit_trial'; 
//                $data['user_role_list'] = get_dropdown_data(USER_ROLE,'user_role','id');
		$this->load->view('includes/template',$data);
	}
	 
        function load_data($id){
            
//            $data['log_data'] = $this->Audit_trial_model->get_single_log($id); 
//            $data['user_role_list'] = get_dropdown_data(USER_ROLE,'user_role','id');
            return $data;	
	}	
        
        function search_audit_trials(){
		$search_data=array( 'user_name' => $this->input->post('user_name'), 'email' => $this->input->post('email')); 
		$data_view['log_list'] = $this->Audit_trial_model->search_result($search_data);
		
//                var_dump($this->input->post()); die;
		$this->load->view('audit_trials/search_audit_trials_result',$data_view);
	}
                  
        function test(){
            echo 'okoo';
        }
}
