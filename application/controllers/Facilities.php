<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facilities extends CI_Controller {

	
        function __construct() {
            parent::__construct();
            $this->load->model('Facilities_model'); 
        }

        public function index(){
            $this->view_search();
	}
        
        function view_search($datas=''){
            $data['facility_list'] = $this->Facilities_model->search_result();
            $data['main_content']='facilities/search_facilities'; 
            $data['category_list'] = get_dropdown_data(FACILITIES_CAT,'name','id','Facility Type');
            $this->load->view('includes/template',$data);
	}
        
	function add(){ 
            $data['action']		= 'Add';
            $data['main_content']='facilities/manage_facilities'; 
            $data['category_list'] = get_dropdown_data(FACILITIES_CAT,'name','id','Facility Type');
            $this->load->view('includes/template',$data);
	}
	
	function edit($id){ 
            $data  			= $this->load_data($id); 
            $data['action']		= 'Edit';
            $data['main_content']='facilities/manage_facilities'; 
            $this->load->view('includes/template',$data);
	}
	
	function delete($id){ 
            $data  			= $this->load_data($id);
            $data['action']		= 'Delete';
            $data['main_content']='facilities/manage_facilities'; 
            $this->load->view('includes/template',$data);
	}
	
	function view($id){ 
            $data  			= $this->load_data($id);
            $data['action']		= 'View';
            $data['main_content']='facilities/manage_facilities'; 
            $data['user_role_list'] = get_dropdown_data(USER_ROLE,'user_role','id');
            $this->load->view('includes/template',$data);
	}
	
        
	function validate(){  
            $this->form_val_setrules(); 
            if($this->form_validation->run() == False){
                switch($this->input->post('action')){
                    case 'Add':
                            $this->add();
                            break;
                    case 'Edit':
                            $this->edit($this->input->post('id'));
                            break;
                    case 'Delete':
                            $this->delete($this->input->post('id'));
                            break;
                } 
            }
            else{
                switch($this->input->post('action')){
                    case 'Add':
                            $this->create();
                    break;
                    case 'Edit':
                        $this->update();
                    break;
                    case 'Delete':
                        $this->remove();
                    break;
                    case 'View':
                        $this->view();
                    break;
                }	
            }
	}
        
	function form_val_setrules(){
            $this->form_validation->set_error_delimiters('<p style="color:rgb(255, 115, 115);" class="help-block"><i class="glyphicon glyphicon-exclamation-sign"></i> ','</p>');

            $this->form_validation->set_rules('name','Facility Name','required|min_length[2]');
            $this->form_validation->set_rules('category_id','Category','required');
            $this->form_validation->set_rules('label','Label','min_length[6]');
            $this->form_validation->set_rules('description','Description','min_length[15]');
      }	
        
	function create(){ 
            $inputs = $this->input->post();
            $inputs['status'] = 0;
            if(isset($inputs['status'])){
                $inputs['status'] = 1;
            } 
            $data = array(
                            'name' => $inputs['name'],
                            'category_id' => $inputs['category_id'],
                            'label_text' => $inputs['label_text'],
                            'description' => $inputs['description'],
                            'icon' => $inputs['icon'],
                            'status' => $inputs['status'],
                            'added_on' => date('Y-m-d'),
                            'added_by' => $this->session->userdata('ID'),
                        );
                    
		$add_stat = $this->Facilities_model->add_db($data);
                
		if($add_stat[0]){
                    //update log data
                    $new_data = $this->Facilities_model->get_single_row($add_stat[1]);
                    add_system_log(FACILITIES, $this->router->fetch_class(), __FUNCTION__, '', $new_data);
                    $this->session->set_flashdata('warn',RECORD_ADD);
                    redirect(base_url($this->router->fetch_class())); 
                }else{
                    $this->session->set_flashdata('warn',ERROR);
                    redirect(base_url($this->router->fetch_class()));
                } 
	}
	
	function update(){
            $inputs = $this->input->post();
            
//            echo '<pre>'; print_r($this->input->post()); die;
            if(isset($inputs['status'])){
                $inputs['status'] = 1;
            } else{
                $inputs['status'] = 0;
            }
            $data = array(
                            'name' => $inputs['name'],
                            'category_id' => $inputs['category_id'],
                            'label_text' => $inputs['label_text'],
                            'description' => $inputs['description'],
                            'icon' => $inputs['icon'],
                            'status' => $inputs['status'],
                            'updated_on' => date('Y-m-d'),
                            'updated_by' => $this->session->userdata('ID'),
                        );  
                    
            //old data for log update
            $existing_data = $this->Facilities_model->get_single_row($inputs['id']);
            
            $edit_stat = $this->Facilities_model->edit_db($inputs['id'],$data);
            
            if($edit_stat){
                //update log data
                $new_data = $this->Facilities_model->get_single_row($inputs['id']);
                add_system_log(FACILITIES, $this->router->fetch_class(), __FUNCTION__, $new_data, $existing_data);
                $this->session->set_flashdata('warn',RECORD_UPDATE);
                    
                redirect(base_url($this->router->fetch_class().'/edit/'.$inputs['id']));
            }else{
                $this->session->set_flashdata('warn',ERROR);
                redirect(base_url($this->router->fetch_class()));
            } 
	}	
        
        function remove(){
            $inputs = $this->input->post();
                                        
            $data = array(
                            'deleted' => 1,
                            'deleted_on' => date('Y-m-d'),
                            'deleted_by' => $this->session->userdata('ID')
                         ); 
                
            $existing_data = $this->Facilities_model->get_single_row($inputs['id']);
            $delete_stat = $this->Facilities_model->delete_db($inputs['id'],$data);
                    
            if($delete_stat){
                //update log data
                add_system_log(FACILITIES, $this->router->fetch_class(), __FUNCTION__,$existing_data, '');
                $this->session->set_flashdata('warn',RECORD_DELETE);
                redirect(base_url($this->router->fetch_class()));
            }else{
                $this->session->set_flashdata('warn',ERROR);
                redirect(base_url($this->router->fetch_class()));
            }  
	}
	
	
	function remove2(){
            $id  = $this->input->post('id'); 
            
            $existing_data = $this->Facilities_model->get_single_row($inputs['id']);
            if($this->Facilities_model->delete2_db($id)){
                //update log data
                add_system_log(FACILITIES, $this->router->fetch_class(), __FUNCTION__, '', $existing_data);
                
                $this->session->set_flashdata('warn',RECORD_DELETE);
                redirect(base_url('company'));

            }else{
                $this->session->set_flashdata('warn',ERROR);
                redirect(base_url('company'));
            }  
	}
        
        function load_data($id){
            
            $data['user_data'] = $this->Facilities_model->get_single_row($id); 
            $data['category_list'] = get_dropdown_data(FACILITIES_CAT,'name','id','Facility Type');
            return $data;	
	}	
        
        function search(){
		$search_data=array( 'name' => $this->input->post('name'), 'category' => $this->input->post('category')); 
		$data_view['search_list'] = $this->Facilities_model->search_result($search_data);
                                        
		$this->load->view('Facilities/search_facilities_result',$data_view);
	}
                                        
        function test(){
            
//            $this->load->model('Facilities_model');
//            $data = $this->Facilities_model->add_system_log();
            echo '<pre>' ; print_r($this);die;
//            log_message('error', 'Some variable did not contain a value.');
        }
        
        function do_upload($file_nm, $pic_name='logo_default')
	{
		$config['upload_path'] = COMPANY_LOGO;
		$config['file_name'] = $pic_name;
		$config['overwrite'] = true;
		
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload($file_nm))
		{
			return "";
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			return $data['upload_data']['file_name'];
		}
	}
                    
}
