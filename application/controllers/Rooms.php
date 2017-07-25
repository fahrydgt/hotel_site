<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rooms extends CI_Controller {

	
        function __construct() {
            parent::__construct();
            $this->load->model('Rooms_model'); 
        }

        public function index(){
            $this->view_search();
	}
        
        function view_search($datas=''){
            $data['facility_list'] = $this->Rooms_model->search_result();
            $data['main_content']='rooms/search_rooms'; 
            $data['hotel_list'] = get_dropdown_data(HOTELS,'hotel_name','id','Hotel');
            $data['time_base_list'] = get_dropdown_data(TIME_BASE,'time_base_name','id','Time Base');
            $data['tarrif_type_list'] = get_dropdown_data(TARRIF_TYPE,'tarrif_type_name','id','Tarrif Type');
            $this->load->view('includes/template',$data);
	}
        
	function add(){ 
            $data['action']		= 'Add';
            $data['main_content']='rooms/manage_rooms'; 
            $data['hotel_list'] = get_dropdown_data(HOTELS,'hotel_name','id','Hotel');
            $data['facilities_list'] = get_dropdown_data(FACILITIES,'name','id','Facilities');
            $data['time_base_list'] = get_dropdown_data(TIME_BASE,'time_base_name','id','Time Base');
            $data['tarrif_type_list'] = get_dropdown_data(TARRIF_TYPE,'tarrif_type_name','id','Tarrif Type');
            $this->load->view('includes/template',$data);
	}
	
	function edit($id){ 
            $data  			= $this->load_data($id); 
            $data['action']		= 'Edit';
            $data['main_content']='rooms/manage_rooms'; 
            $this->load->view('includes/template',$data);
	}
	
	function delete($id){ 
            $data  			= $this->load_data($id);
            $data['action']		= 'Delete';
            $data['main_content']='rooms/manage_rooms'; 
            $this->load->view('includes/template',$data);
	}
	
	function view($id){ 
            $data  			= $this->load_data($id);
            $data['action']		= 'View';
            $data['main_content']='rooms/manage_rooms'; 
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

            $this->form_validation->set_rules('room_name','Room Name','required|min_length[2]');
            $this->form_validation->set_rules('hotel_id','Hotel','required');
            $this->form_validation->set_rules('tarrif_type_id','Tarrif Type','required');
            $this->form_validation->set_rules('time_base_id','Time Base','required'); 
            $this->form_validation->set_rules('description','Description','min_length[10]');
      }	
        
	function create(){ 
//            echo '<pre>'; print_r($this->input->post()); die;
            $inputs = $this->input->post();
            $inputs['status'] = 0;
            if(isset($inputs['status'])){
                $inputs['status'] = 1;
            } 
            $data = array(
                            'room_name' => $inputs['room_name'],
                            'short_name' => $inputs['short_name'],
                            'tarrif_type_id' => $inputs['tarrif_type_id'],
                            'time_base_id' => $inputs['time_base_id'],
                            'hotel_id' => $inputs['hotel_id'], 
                            'description' => $inputs['description'], 
                            'facilities' => (isset($inputs['facilities']))? json_encode($inputs['facilities']):'', 
                            'status' => $inputs['status'],
                            'added_on' => date('Y-m-d'),
                            'added_by' => $this->session->userdata('ID'),
                        ); 

		$add_stat = $this->Rooms_model->add_db($data);
                
		if($add_stat[0]){
                    //update log data
                    $new_data = $this->Rooms_model->get_single_row($add_stat[1]);
                    add_system_log(ROOMS, $this->router->fetch_class(), __FUNCTION__, '', $new_data);
                    $this->session->set_flashdata('warn',RECORD_ADD);
                    redirect(base_url($this->router->fetch_class())); 
                }else{
                    $this->session->set_flashdata('warn',ERROR);
                    redirect(base_url($this->router->fetch_class()));
                } 
	}
	
	function update(){
            $inputs = $this->input->post();
            
            if(isset($inputs['status'])){
                $inputs['status'] = 1;
            } else{
                $inputs['status'] = 0;
            }
            $data = array(
                          'room_name' => $inputs['room_name'],
                          'short_name' => $inputs['short_name'],
                          'tarrif_type_id' => $inputs['tarrif_type_id'],
                          'time_base_id' => $inputs['time_base_id'],
                          'hotel_id' => $inputs['hotel_id'], 
                          'description' => $inputs['description'], 
                          'facilities' => (isset($inputs['facilities']))? json_encode($inputs['facilities']):'', 
                          'status' => $inputs['status'],
                          'updated_on' => date('Y-m-d'),
                          'updated_by' => $this->session->userdata('ID'),
                      );
                    
            //old data for log update
            $existing_data = $this->Rooms_model->get_single_row($inputs['id']);
            
            $edit_stat = $this->Rooms_model->edit_db($inputs['id'],$data);
            
            if($edit_stat){
                //update log data
                $new_data = $this->Rooms_model->get_single_row($inputs['id']);
                add_system_log(ROOMS, $this->router->fetch_class(), __FUNCTION__, $new_data, $existing_data);
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
                
            $existing_data = $this->Rooms_model->get_single_row($inputs['id']);
            $delete_stat = $this->Rooms_model->delete_db($inputs['id'],$data);
                    
            if($delete_stat){
                //update log data
                add_system_log(ROOMS, $this->router->fetch_class(), __FUNCTION__,$existing_data, '');
                $this->session->set_flashdata('warn',RECORD_DELETE);
                redirect(base_url($this->router->fetch_class()));
            }else{
                $this->session->set_flashdata('warn',ERROR);
                redirect(base_url($this->router->fetch_class()));
            }  
	}
	
	
	function remove2(){
            $id  = $this->input->post('id'); 
            
            $existing_data = $this->Rooms_model->get_single_row($inputs['id']);
            if($this->Rooms_model->delete2_db($id)){
                //update log data
                add_system_log(ROOMS, $this->router->fetch_class(), __FUNCTION__, '', $existing_data);
                
                $this->session->set_flashdata('warn',RECORD_DELETE);
                redirect(base_url('company'));

            }else{
                $this->session->set_flashdata('warn',ERROR);
                redirect(base_url('company'));
            }  
	}
        
        function load_data($id){
            
            $data['user_data'] = $this->Rooms_model->get_single_row($id); 
            $data['facilities_list'] = get_dropdown_data(FACILITIES,'name','id','Facilities');
            $data['hotel_list'] = get_dropdown_data(HOTELS,'hotel_name','id','Hotel');
            $data['time_base_list'] = get_dropdown_data(TIME_BASE,'time_base_name','id','Time Base');
            $data['tarrif_type_list'] = get_dropdown_data(TARRIF_TYPE,'tarrif_type_name','id','Tarrif Type');
            return $data;	
	}	
        
        function search(){
		$search_data=array( 'name' => $this->input->post('name'), 'hotel_id' => $this->input->post('hotel_id'), 'tarrif_type_id' => $this->input->post('tarrif_type_id')); 
		$data_view['search_list'] = $this->Rooms_model->search_result($search_data);
                                        
		$this->load->view('rooms/search_rooms_result',$data_view);
	}
                                        
        function test(){
            
//            $this->load->model('Rooms_model');
//            $data = $this->Rooms_model->add_system_log();
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
