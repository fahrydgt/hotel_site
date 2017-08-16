<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activities extends CI_Controller {

	
        function __construct() {
            parent::__construct();
            $this->load->model('Activities_model'); 
        }

        public function index(){
            $this->view_search();
	}
        
        function view_search($datas=''){
            $data['search_list'] = $this->Activities_model->search_result();
            $data['main_content']='activities/search_activities'; 
            $data['category_list'] = get_dropdown_data(FACILITIES_CAT,'name','id','Facility Type');
            $this->load->view('includes/template',$data);
	}
        
	function add(){ 
            $data['action']		= 'Add';
            $data['main_content']='activities/manage_activities'; 
            $data['facilities_list'] = get_dropdown_data(FACILITIES,'name','id','');
            $data['property_sur_list'] = get_dropdown_data(PROPERTY_SURROUND,'property_name','id','');
            $data['user_role_list'] = get_dropdown_data(USER_ROLE,'user_role','id');
            $data['country_list'] = get_dropdown_data(COUNTRY_LIST,'country_name','country_code','Country');
            $data['category_list'] = get_dropdown_data(FACILITIES_CAT,'name','id','Facility Type');
            $this->load->view('includes/template',$data);
	}
	
	function edit($id){ 
            $data  			= $this->load_data($id); 
            $data['action']		= 'Edit';
            $data['main_content']='activities/manage_activities'; 
            $this->load->view('includes/template',$data);
	}
	
	function delete($id){ 
            $data  			= $this->load_data($id);
            $data['action']		= 'Delete';
            $data['main_content']='activities/manage_activities'; 
            $this->load->view('includes/template',$data);
	}
	
	function view($id){ 
            $data  			= $this->load_data($id);
            $data['action']		= 'View';
            $data['main_content']='activities/manage_activities'; 
            $data['user_role_list'] = get_dropdown_data(USER_ROLE,'user_role','id');
            $this->load->view('includes/template',$data);
	}
	
        
	function validate(){   
            $this->form_val_setrules(); 
            if($this->form_validation->run() == False){
                switch($this->input->post('action')){
                    case 'Add':
                            $this->session->set_flashdata('error','Not Saved! Please Recheck the form'); 
                            $this->add();
                            break;
                    case 'Edit':
                            $this->session->set_flashdata('error','Not Saved! Please Recheck the form');
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

            $this->form_validation->set_rules('activity_name','Activity Name','required|min_length[2]');
            $this->form_validation->set_rules('title','Activity Title','required|min_length[2]');
            $this->form_validation->set_rules('description','Description','min_length[15]');
            $this->form_validation->set_rules('street_address','Street Address','required');
            $this->form_validation->set_rules('city','City','required');
            $this->form_validation->set_rules('country','Country','required');
            $this->form_validation->set_rules('phone','Phone Number','required');
            $this->form_validation->set_rules('email','Email','valid_email');
            $this->form_validation->set_rules('website','Website','valid_url'); 
            
            $this->form_validation->set_rules('open_time','Opening Time','required');
            $this->form_validation->set_rules('close_time','Closing Time','required');
      }	
        
	function create(){  
            $inputs = $this->input->post();
            $activity_id = get_autoincrement_no(ACTIVITIES);
//            echo $activity_id; die;
            $inputs['status'] = $inputs['admin_status'] = 0;
            if(isset($inputs['status'])){
                $inputs['status'] = 1;
            } 
            if(isset($inputs['admin_status'])){
                $inputs['status'] = 1;
            } 
            //create Dir if not exists for store necessary images   
            if(!is_dir(ACTIVITY_LOGO.$activity_id.'/')) mkdir(ACTIVITY_LOGO.$activity_id.'/', 0777, TRUE);
            if(!is_dir(ACTIVITY_IMAGES.$activity_id.'/')) mkdir(ACTIVITY_IMAGES.$activity_id.'/', 0777, TRUE);
            
            
            $this->load->library('fileuploads'); //file upoad library created by FL
            
            $res_logo = $this->fileuploads->upload_all('logo',ACTIVITY_LOGO.$activity_id.'/');
            $res_activity_deflt_px = $this->fileuploads->upload_all('activity_default_pic',ACTIVITY_IMAGES.$activity_id.'/');
            $res_activity_all_px = $this->fileuploads->upload_all('activity_images',ACTIVITY_IMAGES.$activity_id.'/');
            
            if(!empty($res_activity_all_px)){
                foreach ($res_activity_all_px as $actvt_img){
                    $all_images[]=$actvt_img['name'];
                }
            };
            
            $data['activity_tbl'] = array(
                                    'activity_name' => $inputs['activity_name'],
                                    'title' => $inputs['title'],
                                    'description' => $inputs['description'],
                                    'tags' => $inputs['tags'],
                                    'street_address' => $inputs['street_address'],
                                    'city' => $inputs['city'],
                                    'state' => $inputs['state'],
                                    'country' => $inputs['country'],
                                    'zipcode' => $inputs['zipcode'],
                                    'phone' => $inputs['phone'],
                                    'fax' => $inputs['fax'],
                                    'other_phone' => $inputs['other_phone'],
                                    'email' => $inputs['email'],
                                    'website' => $inputs['website'],
                                    'activity_type' => $inputs['activity_type'],
                                    'reg_no' => $inputs['reg_no'],
                                    'logo' => (!empty($res_logo))?$res_logo[0]['name']:'',
                                    'status' => $inputs['status'],
                                    'added_on' => date('Y-m-d'),
                                    'added_by' => $this->session->userdata('ID'),
                                );
                    
            $data['resource_tbl'] = array(
                                    'activity_id' => $activity_id,
                                    'open_time' => strtotime($inputs['open_time']),
                                    'close_time' => strtotime($inputs['close_time']),
                                    'payments_policy' => json_encode($inputs['policy']),
                                    'pets' => json_encode($inputs['pets']),
                                    'facilities' => json_encode($inputs['facilities']),
                                    'property_surroundings' => json_encode($inputs['property_surroundings']),
                                    'status' => 1,
                                    'added_on' => date('Y-m-d'),
                                    'added_by' => $this->session->userdata('ID'),
                                );
            $data['activity_img_tbl'] = array(
                                    'activity_id' => $activity_id,
                                    'default_image' => (!empty($res_activity_deflt_px))?$res_activity_deflt_px[0]['name']:'',
                                    'images' => json_encode($all_images),
                                    'status' => 1,
                                );
                    
//            echo '<pre>';            print_r($data); die;
		$add_stat = $this->Activities_model->add_db($data);
                
		if($add_stat[0]){ 
                    //update log data
                    $new_data = $this->Activities_model->get_single_row($add_stat[1]);
                    add_system_log(ACTIVITIES.','.ACTIVITY_RESOURCE.ACTIVITY_IMAGES_TBL, $this->router->fetch_class(), __FUNCTION__, '', $new_data);
                    $this->session->set_flashdata('warn',RECORD_ADD);
                    redirect(base_url($this->router->fetch_class())); 
                }else{
                    $this->session->set_flashdata('warn',ERROR);
                    redirect(base_url($this->router->fetch_class()));
                } 
	}
	
	function update(){ 
            $inputs = $this->input->post();
            $activity_id = $inputs['id']; 
            $inputs['status'] = $inputs['admin_status'] = 0;
            if(isset($inputs['status'])){
                $inputs['status'] = 1;
            }  
            //create Dir if not exists for store necessary images   
            if(!is_dir(ACTIVITY_LOGO.$activity_id.'/')) mkdir(ACTIVITY_LOGO.$activity_id.'/', 0777, TRUE);
            if(!is_dir(ACTIVITY_IMAGES.$activity_id.'/')) mkdir(ACTIVITY_IMAGES.$activity_id.'/', 0777, TRUE);
            
            
            $this->load->library('fileuploads'); //file upoad library created by FL
            
            
            $appendedFiles = array();

            // scan uploads directory for appended images
            $uploadsFiles = array_diff(scandir(ACTIVITY_IMAGES.$activity_id.'/'), array('.', '..'));
            foreach($uploadsFiles as $file) { 
                    if(is_dir($file))// skip if directory
                            continue; 
                    $appendedFiles[] = array(
                            "name" => $file,
                            "type" => get_mime_by_extension(ACTIVITY_IMAGES.$activity_id.'/' . $file),
                            "size" => filesize(ACTIVITY_IMAGES.$activity_id.'/' . $file),
                            "file" => base_url(ACTIVITY_IMAGES.$activity_id.'/' . $file),
                            "data" => array(
                                    "url" => base_url(ACTIVITY_IMAGES.$activity_id.'/' . $file)
                            )
                    );
            }            
                    
            $res_logo = $this->fileuploads->upload_all('logo',ACTIVITY_LOGO.$activity_id.'/');
            $res_activity_all_px = $this->fileuploads->upload_all('activity_images',ACTIVITY_IMAGES.$activity_id.'/',$appendedFiles);
            $res_activity_deflt_px = $this->fileuploads->upload_all('activity_default_pic',ACTIVITY_IMAGES.$activity_id.'/');

            if(!empty($res_activity_all_px)){
                foreach ($res_activity_all_px as $actvt_img){
                    $all_images[]=$actvt_img['name'];
                }
            }; 
            
            $data['activity_tbl'] = array(
                                    'activity_name' => $inputs['activity_name'],
                                    'title' => $inputs['title'],
                                    'description' => $inputs['description'],
                                    'tags' => $inputs['tags'],
                                    'street_address' => $inputs['street_address'],
                                    'city' => $inputs['city'],
                                    'state' => $inputs['state'],
                                    'country' => $inputs['country'],
                                    'zipcode' => $inputs['zipcode'],
                                    'phone' => $inputs['phone'],
                                    'fax' => $inputs['fax'],
                                    'other_phone' => $inputs['other_phone'],
                                    'email' => $inputs['email'],
                                    'website' => $inputs['website'],
                                    'activity_type' => $inputs['activity_type'], 
                                    'reg_no' => $inputs['reg_no'], 
//                                    'logo' => (!empty($res_logo))?$res_logo[0]['name']:'',
                                    'status' => $inputs['status'],
                                    'updated_on' => date('Y-m-d'),
                                    'updated_by' => $this->session->userdata('ID'),
                                );
            if(!empty($res_logo)) $data['activity_tbl']['logo'] = $res_logo[0]['name']; 
            
            $data['resource_tbl'] = array( 
                                    'open_time' => strtotime($inputs['open_time']),
                                    'close_time' => strtotime($inputs['close_time']),
                                    'payments_policy' => json_encode($inputs['policy']),
                                    'pets' => json_encode($inputs['pets']),
                                    'facilities' => (isset($inputs['facilities']))?json_encode($inputs['facilities']):'',
                                    'property_surroundings' => (isset($inputs['property_surroundings']))?json_encode($inputs['property_surroundings']):'',
                                    'status' => 1,
                                    'updated_on' => date('Y-m-d'),
                                    'updated_by' => $this->session->userdata('ID'),
                                );
            $data['activity_img_tbl'] = array( 
//                                    'default_image' => (!empty($res_hotel_deflt_px))?$res_hotel_deflt_px[0]['name']:'',
                                    'images' => (isset($all_images))?json_encode($all_images):'',
                                    'status' => 1,
                                );
            if(!empty($res_activity_deflt_px)) $data['activity_img_tbl']['default_image'] = $res_activity_deflt_px[0]['name'];
                    
            
//            echo '<pre>'; print_r($data); die;
            //old data for log update
            $existing_data = $this->Activities_model->get_single_row($inputs['id']);

            $edit_stat = $this->Activities_model->edit_db($inputs['id'],$data);
            
            if($edit_stat){
                //update log data
                $new_data = $this->Activities_model->get_single_row($inputs['id']);
                add_system_log(ACTIVITIES.','.ACTIVITY_RESOURCE.ACTIVITY_IMAGES_TBL, $this->router->fetch_class(), __FUNCTION__, $new_data, $existing_data);
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
                
            $existing_data = $this->Activities_model->get_single_row($inputs['id']);
            $delete_stat = $this->Activities_model->delete_db($inputs['id'],$data);
                    
            if($delete_stat){
                //update log data
                add_system_log(ACTIVITIES.','.ACTIVITY_RESOURCE.ACTIVITY_IMAGES_TBL, $this->router->fetch_class(), __FUNCTION__,$existing_data, '');
                $this->session->set_flashdata('warn',RECORD_DELETE);
                redirect(base_url($this->router->fetch_class()));
            }else{
                $this->session->set_flashdata('warn',ERROR);
                redirect(base_url($this->router->fetch_class()));
            }  
	}
	
	
	function remove2(){
            $id  = $this->input->post('id'); 
            
            $existing_data = $this->Activities_model->get_single_row($inputs['id']);
            if($this->Activities_model->delete2_db($id)){
                //update log data
                add_system_log(HOTELS, $this->router->fetch_class(), __FUNCTION__, '', $existing_data);
                
                $this->session->set_flashdata('warn',RECORD_DELETE);
                redirect(base_url('company'));

            }else{
                $this->session->set_flashdata('warn',ERROR);
                redirect(base_url('company'));
            }  
	}
        
        function load_data($id){
            
            $data['user_data'] = $this->Activities_model->get_single_row($id); 
            if(empty($data['user_data'])){
                $this->session->set_flashdata('error','INVALID! Please use the System Navigation');
                redirect(base_url($this->router->fetch_class()));
            }
            $data['facilities_list'] = get_dropdown_data(FACILITIES,'name','id','');
            $data['property_sur_list'] = get_dropdown_data(PROPERTY_SURROUND,'property_name','id','');
            $data['user_role_list'] = get_dropdown_data(USER_ROLE,'user_role','id');
            $data['country_list'] = get_dropdown_data(COUNTRY_LIST,'country_name','country_code','Country');
            return $data;	
	}	
        
        function search(){
		$search_data=array( 'activity_name' => $this->input->post('name'), 
                                    'phone' => $this->input->post('phone'),
                                    'city' => $this->input->post('city'),
                                    'email' => $this->input->post('email'),
                                    ); 
		$data_view['search_list'] = $this->Activities_model->search_result($search_data);
                                        
		$this->load->view('activities/search_activities_result',$data_view);
	}
                                        
        function test(){
            echo '<pre>';            print_r($this->router->class); die;
//            $this->load->model('Activities_model');
//            $data = $this->Activities_model->get_single_row(1);
            echo '<pre>' ; print_r(get_dropdown_data(HOTELS,'hotel_name','id','Hotel'));die;
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
