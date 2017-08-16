<?php 

class activity_events_model extends CI_Model
{
	function __construct(){	
            parent::__construct(); 
 	}
	 
         public function search_result($data=''){ 
            $this->db->select('ae.*, a.activity_name,tt.tarrif_type_name');
            $this->db->from(ACTIVITY_EVENTS.' ae');  
            $this->db->join(ACTIVITIES.' a','a.id = ae.activity_id');  
            $this->db->join(TARRIF_TYPE.' tt','tt.id = ae.tarrif_type_id');   
            $this->db->where('ae.deleted',0);
            if($data !=''){
                $this->db->like('ae.activity_event_name', $data['name']); 
                $this->db->like('ae.activity_id', $data['activity_id']); 
                $this->db->like('ae.tarrif_type_id', $data['tarrif_type_id']); 
               } 
            $result = $this->db->get()->result_array();  
            return $result;
	}
	
         public function get_single_row($id){ 
            $this->db->select('*');
            $this->db->from(ACTIVITY_EVENTS); 
            $this->db->where('id',$id);
            $this->db->where('deleted',0);
            $result = $this->db->get()->result_array();  
            return $result;
	}
                        
        public function add_db($data){       
                $this->db->trans_start();
		$this->db->insert(ACTIVITY_EVENTS, $data); 
                $insert_id =  $this->db->insert_id();
		$status[0]=$this->db->trans_complete();
		$status[1]=$insert_id; 
		return $status;
	}
        
        public function edit_db($id,$data){
		$this->db->trans_start();
                
		$this->db->where('id', $id);
                $this->db->where('deleted',0);
		$this->db->update(ACTIVITY_EVENTS, $data);
                        
		$status=$this->db->trans_complete();
		return $status;
	}
        
        public function delete_db($id,$data){ 
		$this->db->trans_start();
		$this->db->where('id', $id);
		$this->db->where('id!=', 1);
                $this->db->where('deleted',0);
		$this->db->update(ACTIVITY_EVENTS, $data);
		$status=$this->db->trans_complete();
		return $status;
	}
        
        function delete_db2($id){
                $this->db->trans_start();
                $this->db->delete(ACTIVITY_EVENTS, array('id' => $id));     
                $status = $this->db->trans_complete();
                return $status;	
	} 
        
 
}
?>