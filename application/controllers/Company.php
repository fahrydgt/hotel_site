<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller { 
    
	public function index(){
            
            $this->load->helper('url');
            $data['main_content'] = 'dashboard/index'; 
            $this->load->view('includes/template',$data);
	
	} 
	
	function test(){ 
            print_r($pw = $this->encrypt->encode('1_evolve23'));
            echo '<br><br>';
            print_r($this->encrypt->decode('+G9gHOJAaB+2rdK8S9CaBlC2ZeUqRqJACEgQA0N6WhVXr3FSzjY0bbn08sVkoykUpU40xkixFck2fFtBTCkxdA=='));
//          var_dump($this->session->all_userdata());
	}
}
