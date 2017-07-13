<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banners extends CI_Controller {
	
        function __construct() {
            parent::__construct();
            $this->load->model('User_model');
            $this->load->model('Banner_model');     
        }


        public function index()
	{
            $this->view_search();
	}
        
        function view_search($datas=''){
            
            $data['banner_list'] = $this->Banner_model->search_result();
            $data['main_content']='banners/search_banner'; 
            $this->load->view('includes/template',$data);
	}
        
	function add(){
//		$data  			= $this->load_data();
		$data['action']		= 'Add';
		$data['main_content']='banners/manage_banner'; 
                $data['user_role_list'] = get_dropdown_data(USER_ROLE,'user_role','id');
		$this->load->view('includes/template',$data);
	}
	
	function edit($type){
//		$this->redirection_handler($ac_reg_id,'Edit');
		$data['banner_data'] = $this->Banner_model->get_banner_list($type);
		$data['action']		= 'Edit';
		$data['main_content']='banners/manage_banner'; 
		$this->load->view('includes/template',$data);
	}
	
	function delete($id){
//		$this->redirection_handler($ac_reg_id,'Delete');
		$data  			= $this->load_data($id);
		$data['action']		= 'Delete';
		$data['main_content']='banners/manage_banner'; 
		$this->load->view('includes/template',$data);
	}
	
	function view($id){
//		$this->redirection_handler($ac_reg_id,'View');
		$data  			= $this->load_data($id);
		$data['action']		= 'View';
		$data['main_content']='banners/manage_banner'; 
                $data['user_role_list'] = get_dropdown_data(USER_ROLE,'user_role','id');
		$this->load->view('includes/template',$data);
	}
	
        
	function validate(){  
			$this->form_val_setrules();
//                        echo '<pre>'; print_r($this->input->post()); die; 
                            
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
        
        
	function form_val_setrules(){
//		$this->form_validation->set_error_delimiters('<p style="color:rgb(255, 115, 115);" class="help-block"><i class="glyphicon glyphicon-exclamation-sign"></i> ','</p>');
		
		 $this->form_validation->set_rules('image','User Name','required');
                                        
	}	
        
        
	function create(){
            $inputs = $this->input->post();
            $inputs['status'] = 0;
            if(isset($inputs['status'])){
                $inputs['status'] = 1;
            }
            
//              echo '<pre>'; print_r($inputs); die;
            
            $files_array= array();
            foreach ($_FILES['arr']['name'] as $index=>$files_arr){
                $files_array[$index]['name'] = $_FILES['arr']['name'][$index]['img'];
                $files_array[$index]['type'] = $_FILES['arr']['type'][$index]['img'];
                $files_array[$index]['tmp_name'] = $_FILES['arr']['tmp_name'][$index]['img'];
                $files_array[$index]['error'] = $_FILES['arr']['error'][$index]['img'];
                $files_array[$index]['size'] = $_FILES['arr']['size'][$index]['img'];  
            }
            $_FILES = $files_array;
            
//              echo '<pre>'; print_r($files_array);
//              echo '<pre>'; print_r(is_dir(BANNERS_PIC.'slider/')); die; 
            
        foreach ($inputs['arr'] as $input_index=>$inputs_arr){
            $ban_id = get_autoincrement_no(BANNERS);
              //create Dir if not exists for store necessary images 
            if(!is_dir(BANNERS_PIC.'slider/')) mkdir(BANNERS_PIC.'slider/', 0777, TRUE); 
            $pic_upload_1 = $this->do_upload($input_index,'default_'.$input_index,'slider');
            
            $data[] = array(
                            'type' => 'slider',
                            'image' => $pic_upload_1[0],
                            'text1' => $inputs_arr['title'],
                            'text2' => $inputs_arr['desc'],
                            'status' => isset($inputs_arr['status'])?1:0,
                            'sort_order' => $inputs_arr['order'],
//                            'added_on' => date('Y-m-d'),
//                            'added_by' => $this->session->userdata('ID'),
                        );
        }
            
                          echo '<pre>'; print_r($data); die; 

                                        
                 
		$add_stat = $this->Banner_model->add_db($data);
                
		if($add_stat[0]){//update log data
                                $new_data = $this->User_model->get_single_user($add_stat[1]);
                                add_system_log(BANNERS, $this->router->fetch_class(), __FUNCTION__, '', $new_data);
				$this->session->set_flashdata('warn',RECORD_ADD);
				redirect('banners/edit/'.$add_stat[1]);
			}else{
				$this->session->set_flashdata('warn',ERROR);
				redirect(base_url('banners'));;
			} 
	}
	
	function update(){
            $this->create(); 
	}
	
	function remove(){
//                        echo '<pre>';            print_r($this->session->userdata());die;

		$user_id  = $this->input->post('user_id'); 
                if($user_id == $this->session->userdata('ID') || $user_id == 1){
                    $this->session->set_flashdata('error','You Dont have permission delete this user!');
                    redirect(base_url('users'));;
                }
                $existing_data = $this->User_model->get_single_user($user_id);
		if($this->User_model->delete_user($user_id)){
                                //update log data
                                add_system_log(USER_TBL.'-'.USER, $this->router->fetch_class(), __FUNCTION__,$existing_data, '');
				$this->session->set_flashdata('warn',RECORD_DELETE);
				redirect(base_url('users'));;
			}else{
				$this->session->set_flashdata('warn',ERROR);
				redirect(base_url('users'));;
			}  
	}
        function load_data($type){
              
            return $data;	
	}	
        
        function search_user(){
		$search_data=array( 'user_name' => $this->input->post('user_name'), 'email' => $this->input->post('email')); 
		$data_view['search_list'] = $this->User_model->search_result($search_data);
		
//                var_dump($this->input->post()); die;
		$this->load->view('Users/search_user_result',$data_view);
	}
                   
         function do_upload($file_nm, $pic_name='default', $upload_dir='',$overwrite=true){
             
            $config['upload_path'] = BANNERS_PIC.$upload_dir.'/';
            $config['file_name'] = $pic_name;
            $config['overwrite'] = $overwrite;
            $config['allowed_types'] = 'gif|jpg|png'; 

          
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            
            $files = $_FILES;
            $cpt = count($_FILES[$file_nm]['name']);
            $uploaded_data=array();
            for($i=0; $i<$cpt; $i++){     
                if(is_array($files[$file_nm]['name'])){
                    $_FILES[$file_nm]['name']= $files[$file_nm]['name'][$i];
                    $_FILES[$file_nm]['type']= $files[$file_nm]['type'][$i];
                    $_FILES[$file_nm]['tmp_name']= $files[$file_nm]['tmp_name'][$i];
                    $_FILES[$file_nm]['error']= $files[$file_nm]['error'][$i];
                    $_FILES[$file_nm]['size']= $files[$file_nm]['size'][$i];   
                }
                  echo '<pre>';                print_r($_FILES); die; 
                if ( ! $this->upload->do_upload($file_nm)){
                    return "";
                }
                else{
                    $data = $this->upload->data();
                    $uploaded_data[] = $data['file_name'];
                }
            }
            return $uploaded_data; 
	}
        
        function test(){
            echo 'okoo';
        }
}
