<?php 

class Audit_trial_model extends CI_Model
{
	function __construct(){ 
            parent::__construct(); 
 	}
                        
         public function search_result($data=''){ 
            $this->db->select('sl.*,u.first_name,u.last_name');
            $this->db->from(SYSTEM_LOG.' sl'); 
            $this->db->join(USER.' u', 'u.auth_id = sl.user_id');
            if($data !=''){
                $this->db->like('email', $data['email']); 
                $this->db->where("(first_name like '%".$data['user_name']."%' OR last_name like '%".$data['user_name']."%')"); 
               } 
            $result = $this->db->get()->result_array(); 
//            echo $this->db->last_query();die;
            return $result;
	}
	
         public function get_single_log($id){ 
            $this->db->select('sl.*,sld.*,u.first_name,u.last_name');
            $this->db->from(SYSTEM_LOG.' sl');
            $this->db->join(SYSTEM_LOG_DETAIL.' sld', 'sld.system_log_id = sl.id');
            $this->db->join(USER.' u', 'u.auth_id = sl.user_id');
            $this->db->where('sl.id',$id);
            $result = $this->db->get()->result_array(); 
//            echo $this->db->last_query(); die;
            return $result;
	}
                        
         
}
?>