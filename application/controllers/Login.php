<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller { 
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{ 
//            $data['main_content']='login/index'; 
            $this->load->view('login');
//            $this->load->view('login/index.php');
//            echo 'login page';
	}
	function authenticate(){
		$this->load->model('user_default_model');
		$data = $this->input->post();
//         print 'Data is <pre>';print_r($data);'</pre>'; die();
		if($this->user_default_model->login($data)){
		  redirect('dashboard');
       	}else{
                  redirect('login');
           }
	} 
	
	function test(){ 
            print_r($pw = $this->encrypt->encode('1_evolve23'));
            echo '<br><br>';
            print_r($this->encrypt->decode('+G9gHOJAaB+2rdK8S9CaBlC2ZeUqRqJACEgQA0N6WhVXr3FSzjY0bbn08sVkoykUpU40xkixFck2fFtBTCkxdA=='));
//          var_dump($this->session->all_userdata());
	}
}
