<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserPermission extends CI_Controller {

	
        function __construct() {
            parent::__construct();
            $this->load->model('User_permission');
        }

        public function index(){
            $this->view_search_user_permission();
	}
        
         function view_search_user_permission($datas=''){
            
            $data['user_permission_list'] = $this->User_permission->getPermissionGroup(); 
//            echo '<pre>'; print_r($data); die; 
            $data['main_content']='user_permissions/view_permissions'; 
            $this->load->view('includes/template',$data);
	}
        
	function edit($id){ 
            $data['permission_data']   = $this->get_permission_data($id); 
//                        echo '<pre>'; print_r($data); die; 

            $data['action']		= 'Edit';
            $data['urole_id']		= $id;
            $data['main_content'] = 'user_permissions/manage_permission'; 
            $this->load->view('includes/template',$data);
	}
         
        function get_permission_data($user_role_id){
            $modules = $this->User_permission->get_module_list();
            $module_data = array();
            foreach ($modules as $module){
                $module_data[$module['id']]['p_data'] = $this->User_permission->getPermissionData($user_role_id, $module['id']);
                $module_data[$module['id']]['name'] = $module['module_name'];
                $module_data[$module['id']]['id'] = $module['id'];
                
            } 
            return $module_data;
        } 
          
	function validate(){  
            
             $inputs = $this->input->post();
             $status = $this->User_permission->updateUserPermission($inputs);
//            if(isset($inputs['status'])){
//                $inputs['status'] = 1;
//            } else{
//                $inputs['status'] = 0;
//            }
              

            if($status){
                add_system_log('', $this->router->fetch_class(), __FUNCTION__, '', '');
                $this->session->set_flashdata('warn',RECORD_UPDATE);
                redirect(base_url('userPermission'));
            }else{
                $this->session->set_flashdata('warn',ERROR);
                redirect('userPermission/'.$inputs['user_role_id']);
            } 
	} 
                                  
        function test(){
            echo 'okoo';
        }
         
}
