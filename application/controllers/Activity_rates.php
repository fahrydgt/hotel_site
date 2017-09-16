<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity_rates extends CI_Controller {

	
        function __construct() {
            parent::__construct();
            $this->load->model('Activity_rates_model'); 
        }

        public function index(){
            $this->view_search();
	}
        
        function view_search($datas=''){ 
            $data['main_content']='activity_rates/search_activity_rates'; 
            $data['hotel_list'] = get_dropdown_data(HOTELS,'hotel_name','id','Hotel');
            $data['time_base_list'] = get_dropdown_data(TIME_BASE,'time_base_name','id','Time Base');
            $data['tarrif_type_list'] = get_dropdown_data(TARRIF_TYPE,'tarrif_type_name','id','Tarrif Type',array('col'=>'category_id','val'=>2));
            $this->load->view('includes/template',$data);
	}
        
	function add(){ 
            $data['action']		= 'Add';
            $data['main_content']='activity_rates/manage_activity_rates'; 
            $data['activity_list'] = get_dropdown_data(ACTIVITIES,'activity_name','id','Activity');
            $data['activity_price_cat_list'] = get_dropdown_data(ACTIVITY_PRICE_CAT,'name','price_cat_code');
            $data['currency_list'] = get_dropdown_data(CURRENCY,'concat(title, " - ", code)','code','Currency');
            $data['time_base_list'] = get_dropdown_data(TIME_BASE,'time_base_name','id','Time Base');
            $data['tarrif_type_list'] = get_dropdown_data(TARRIF_TYPE,'tarrif_type_name','id','Tarrif Type',array('col'=>'category_id','val'=>2));
            $this->load->view('includes/template',$data);
	}
	
	function edit($id){ 
            $data  			= $this->load_data($id); 
            $data['action']		= 'Edit';
            $data['main_content']='activity_rates/manage_activity_rates'; 
            $this->load->view('includes/template',$data);
	}
	
	function delete($id){ 
            $data  			= $this->load_data($id);
            $data['action']		= 'Delete';
            $data['main_content']='activity_rates/manage_activity_rates'; 
            $this->load->view('includes/template',$data);
	}
	
	function view($id){ 
            $data  			= $this->load_data($id);
            $data['action']		= 'View';
            $data['main_content']='activity_rates/manage_activity_rates'; 
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

            $this->form_validation->set_rules('season_name','Season Name','required|min_length[2]');
            $this->form_validation->set_rules('date_from','Start Date','required');
            $this->form_validation->set_rules('date_to','End Date','required');
            $this->form_validation->set_rules('tarrif_type_id','Tarrif Type','required');
            $this->form_validation->set_rules('activity_id','Activity','required');
            $this->form_validation->set_rules('time_base_id','Time Base','required'); 
            $this->form_validation->set_rules('currency_id','Currency','required'); 
//            $this->form_validation->set_rules('price','Price','required'); 
            $this->form_validation->set_rules('description','Description','min_length[10]');
      }	
        
	function create(){  
            $inputs = $this->input->post();
            $inputs['status'] = 0;
            if(isset($inputs['status'])){
                $inputs['status'] = 1;
            } 
            $data = array(
                            'season_name' => $inputs['season_name'], 
                            'tarrif_type_id' => $inputs['tarrif_type_id'],
                            'activity_id' => $inputs['activity_id'],
                            'time_base_id' => $inputs['time_base_id'],
                            'currency_id' => $inputs['currency_id'], 
                            'description' => $inputs['description'],  
                            'default_price' => 'adult_price_l',  
                            'price_all' => (isset($inputs['price']))? json_encode($inputs['price']):'', 
                            'date_from' => strtotime($inputs['date_from']),
                            'date_to' => strtotime($inputs['date_to']),
                            'status' => $inputs['status'],
                            'added_on' => date('Y-m-d'),
                            'added_by' => $this->session->userdata(SYSTEM_CODE)['ID'],
                        ); 

		$add_stat = $this->Activity_rates_model->add_db($data);
                
		if($add_stat[0]){
                    //update log data
                    $new_data = $this->Activity_rates_model->get_single_row($add_stat[1]);
                    add_system_log(ACTIVITY_PRICEPLAN, $this->router->fetch_class(), __FUNCTION__, '', $new_data);
                    $this->session->set_flashdata('warn',RECORD_ADD);
                    redirect(base_url($this->router->fetch_class())); 
                }else{
                    $this->session->set_flashdata('warn',ERROR);
                    redirect(base_url($this->router->fetch_class()));
                } 
	}
	
	function update(){
            $inputs = $this->input->post();
            $inputs['status'] = 0;
            if(isset($inputs['status'])){
                $inputs['status'] = 1;
            } 
            $data = array(
                            'season_name' => $inputs['season_name'], 
                            'tarrif_type_id' => $inputs['tarrif_type_id'],
                            'activity_id' => $inputs['activity_id'],
                            'time_base_id' => $inputs['time_base_id'],
                            'currency_id' => $inputs['currency_id'], 
                            'description' => $inputs['description'],  
                            'default_price' => 'adult_price_l',  
                            'price_all' => (isset($inputs['price']))? json_encode($inputs['price']):'', 
                            'date_from' => strtotime($inputs['date_from']),
                            'date_to' => strtotime($inputs['date_to']),
                            'status' => $inputs['status'],
                            'updated_on' => date('Y-m-d'),
                            'updated_by' => $this->session->userdata(SYSTEM_CODE)['ID'],
                        ); 
//            echo '<pre>'; print_r($data); die;
            //old data for log update
            $existing_data = $this->Activity_rates_model->get_single_row($inputs['id']);
            
            $edit_stat = $this->Activity_rates_model->edit_db($inputs['id'],$data);
            
            if($edit_stat){
                //update log data
                $new_data = $this->Activity_rates_model->get_single_row($inputs['id']);
                add_system_log(ACTIVITY_PRICEPLAN, $this->router->fetch_class(), __FUNCTION__, $new_data, $existing_data);
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
                            'deleted_by' => $this->session->userdata(SYSTEM_CODE)['ID']
                         ); 
                
            $existing_data = $this->Activity_rates_model->get_single_row($inputs['id']);
            $delete_stat = $this->Activity_rates_model->delete_db($inputs['id'],$data);
                    
            if($delete_stat){
                //update log data
                add_system_log(ACTIVITY_PRICEPLAN, $this->router->fetch_class(), __FUNCTION__,$existing_data, '');
                $this->session->set_flashdata('warn',RECORD_DELETE);
                redirect(base_url($this->router->fetch_class()));
            }else{
                $this->session->set_flashdata('warn',ERROR);
                redirect(base_url($this->router->fetch_class()));
            }  
	}
	
	
	function remove2(){
            $id  = $this->input->post('id'); 
            
            $existing_data = $this->Activity_rates_model->get_single_row($inputs['id']);
            if($this->Activity_rates_model->delete2_db($id)){
                //update log data
                add_system_log(ACTIVITY_PRICEPLAN, $this->router->fetch_class(), __FUNCTION__, '', $existing_data);
                
                $this->session->set_flashdata('warn',RECORD_DELETE);
                redirect(base_url('company'));

            }else{
                $this->session->set_flashdata('warn',ERROR);
                redirect(base_url('company'));
            }  
	}
        
        function load_data($id){
            
            $data['user_data'] = $this->Activity_rates_model->get_single_row($id);
             if(empty($data['user_data'])){
                $this->session->set_flashdata('error','INVALID! Please use the System Navigation');
                redirect(base_url($this->router->fetch_class()));
            }
            $data['activity_list'] = get_dropdown_data(ACTIVITIES,'activity_name','id','Activity');
            $data['activity_price_cat_list'] = get_dropdown_data(ACTIVITY_PRICE_CAT,'name','price_cat_code');
            $data['currency_list'] = get_dropdown_data(CURRENCY,'concat(title, " - ", code)','code','Currency');
            $data['time_base_list'] = get_dropdown_data(TIME_BASE,'time_base_name','id','Time Base');
            $data['tarrif_type_list'] = get_dropdown_data(TARRIF_TYPE,'tarrif_type_name','id','Tarrif Type',array('col'=>'category_id','val'=>2));
            return $data;	
	}	
        
        function search(){
		$search_data=array( 'name' => $this->input->post('name'), 
                                    'activity_id' => $this->input->post('activity_id'), 
                                    'date' => strtotime($this->input->post('date')), 
                                    'tarrif_type_id' => $this->input->post('tarrif_type_id')); 
		$data_view['search_list'] = $this->Activity_rates_model->search_result($search_data);
                                        
		$this->load->view('activity_rates/search_activity_rates_result',$data_view);
	}
                                        
        function test(){
            
//            $this->load->model('Activity_rates_model');
//            $data = $this->Activity_rates_model->add_system_log();
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
