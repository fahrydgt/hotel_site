<?php 

class activities_model extends CI_Model
{
	function __construct(){	
            parent::__construct(); 
 	}
	 
         public function search_result($data=''){ 
//             echo '<pre>';             print_r($data); die;
            $this->db->select('a.id as activity_id,a.*,ar.open_time,ar.close_time,ar.*,ai.*');
            $this->db->from(ACTIVITIES.' a'); 
            $this->db->join(ACTIVITY_RESOURCE.' ar','ar.activity_id = a.id'); 
            $this->db->join(ACTIVITY_IMAGES_TBL.' ai','ai.activity_id = a.id','left');  
            $this->db->where('a.deleted',0);
//            if($this->session->userdata('user_role_id')==6){
//                $this->db->where('u.id', $this->session->userdata('ID'));
//            }
            if($data !=''){
                $this->db->like('a.activity_name', $data['activity_name']); 
                $this->db->like('a.city', $data['city']); 
                $this->db->like('a.phone', $data['phone']); 
                $this->db->like('a.email', $data['email']); 
               } 
            $result = $this->db->get()->result_array();  
//            echo '<pre>';            print_r($this->session->userdata('user_role_ID')); die;
            return $result;
	}
	
         public function get_single_row($id){ 
            $this->db->select('a.id as activity_id,a.*,ar.open_time,ar.close_time,ar.*,ai.*');
            $this->db->from(ACTIVITIES.' a'); 
            $this->db->join(ACTIVITY_RESOURCE.' ar','ar.activity_id = a.id'); 
            $this->db->join(ACTIVITY_IMAGES_TBL.' ai','ai.activity_id = a.id','left');  
            $this->db->where('a.id',$id);
            $this->db->where('a.deleted',0);
            $result = $this->db->get()->result_array();  
//            echo $this->db->last_query(); die;
            return $result;
	}
                        
        public function add_db($data){       
                $this->db->trans_start();
                
		$this->db->insert(ACTIVITIES, $data['activity_tbl']); 
		$this->db->insert(ACTIVITY_RESOURCE, $data['resource_tbl']); 
		$this->db->insert(ACTIVITY_IMAGES_TBL, $data['activity_img_tbl']);  
                
		$status[0]=$this->db->trans_complete();
		$status[1]=$data['resource_tbl']['hotel_id']; 
		return $status;
	}
        
        public function edit_db($id,$data){
		$this->db->trans_start();
                
		$this->db->where('id', $id);
		$this->db->update(ACTIVITIES, $data['activity_tbl']);
                        
		$this->db->where('activity_id', $id);
		$this->db->update(ACTIVITY_RESOURCE, $data['resource_tbl']);
                        
		$this->db->where('activity_id', $id);
		$this->db->update(ACTIVITY_IMAGES_TBL, $data['activity_img_tbl']); 
                        
		$status=$this->db->trans_complete(); 
		return $status;
	}
        
        public function delete_db($id,$data){ 
		$this->db->trans_start();
                
		$this->db->where('id', $id);
		$this->db->update(ACTIVITIES, $data);
                        
		$this->db->where('activity_id', $id);
		$this->db->update(ACTIVITY_RESOURCE, $data);
                        
		$this->db->where('activity_id', $id);
		$this->db->update(ACTIVITY_IMAGES_TBL, array('deleted'=>1)); 
                
		$status=$this->db->trans_complete();
		return $status;
	}
        
        function delete_db2($id){
                $this->db->trans_start();
                $this->db->delete(ACTIVITIES, array('id' => $id));     
                $this->db->delete(ACTIVITY_RESOURCE, array('activity_id' => $id));     
                $this->db->delete(ACTIVITY_IMAGES_TBL, array('activity_id' => $id));     
                $status = $this->db->trans_complete();
                return $status;	
	} 
        
 
}
?>