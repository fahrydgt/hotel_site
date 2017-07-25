<?php 

class Tarrif_model extends CI_Model
{
	function __construct(){	
            parent::__construct(); 
 	}
	 
         public function search_result($data=''){ 
            $this->db->select('tt.*, ttc.category_name');
            $this->db->from(TARRIF_TYPE.' tt');  
            $this->db->join(TARRIF_TYPE_CAT.' ttc','ttc.id = tt.category_id');  
            $this->db->where('tt.deleted',0);
            if($data !=''){
                $this->db->like('tt.tarrif_type_name', $data['name']); 
                $this->db->like('tt.category_id', $data['category']); 
               } 
            $result = $this->db->get()->result_array();  
            return $result;
	}
	
         public function get_single_row($id){ 
            $this->db->select('*');
            $this->db->from(TARRIF_TYPE); 
            $this->db->where('id',$id);
            $this->db->where('deleted',0);
            $result = $this->db->get()->result_array();  
            return $result;
	}
                        
        public function add_db($data){       
                $this->db->trans_start();
		$this->db->insert(TARRIF_TYPE, $data); 
                $insert_id =  $this->db->insert_id();
		$status[0]=$this->db->trans_complete();
		$status[1]=$insert_id; 
		return $status;
	}
        
        public function edit_db($id,$data){
		$this->db->trans_start();
                
		$this->db->where('id', $id);
                $this->db->where('deleted',0);
		$this->db->update(TARRIF_TYPE, $data);
                        
		$status=$this->db->trans_complete();
		return $status;
	}
        
        public function delete_db($id,$data){ 
		$this->db->trans_start();
		$this->db->where('id', $id);
		$this->db->where('id!=', 1);
                $this->db->where('deleted',0);
		$this->db->update(TARRIF_TYPE, $data);
		$status=$this->db->trans_complete();
		return $status;
	}
        
        function delete_db2($id){
                $this->db->trans_start();
                $this->db->delete(TARRIF_TYPE, array('id' => $id));     
                $status = $this->db->trans_complete();
                return $status;	
	} 
        
 
}
?>