<?php 

class Property_surroundings_model extends CI_Model
{
	function __construct(){	
            parent::__construct(); 
 	}
	 
         public function search_result($data=''){
            
            $this->db->select('ps.*, psc.name as category_name');
            $this->db->from(PROPERTY_SURROUND.' ps');  
            $this->db->join(PROPERTY_SURROUND_CAT.' psc','psc.id = ps.category_id');  
            $this->db->where('ps.deleted',0);
            if($data !=''){
                $this->db->like('ps.property_name', $data['name']); 
                $this->db->like('ps.category_id', $data['category']); 
               } 
            $result = $this->db->get()->result_array();  
            return $result;
	}
	
         public function get_single_row($id){ 
            $this->db->select('*');
            $this->db->from(PROPERTY_SURROUND); 
            $this->db->where('id',$id);
            $this->db->where('deleted',0);
            $result = $this->db->get()->result_array();  
            return $result;
	}
                        
        public function add_db($data){       
                $this->db->trans_start();
		$this->db->insert(PROPERTY_SURROUND, $data); 
                $insert_id =  $this->db->insert_id();
		$status[0]=$this->db->trans_complete();
		$status[1]=$insert_id; 
		return $status;
	}
        
        public function edit_db($id,$data){
		$this->db->trans_start();
                
		$this->db->where('id', $id);
                $this->db->where('deleted',0);
		$this->db->update(PROPERTY_SURROUND, $data);
                        
		$status=$this->db->trans_complete();
		return $status;
	}
        
        public function delete_db($id,$data){ 
		$this->db->trans_start();
		$this->db->where('id', $id);
		$this->db->where('id!=', 1);
                $this->db->where('deleted',0);
		$this->db->update(PROPERTY_SURROUND, $data);
		$status=$this->db->trans_complete();
		return $status;
	}
        
        function delete_db2($id){
                $this->db->trans_start();
                $this->db->delete(PROPERTY_SURROUND, array('id' => $id));     
                $status = $this->db->trans_complete();
                return $status;	
	} 
        
 
}
?>