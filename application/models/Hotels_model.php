<?php 

class Hotels_model extends CI_Model
{
	function __construct(){	
            parent::__construct(); 
 	}
	 
         public function search_result($data=''){ 
            $this->db->select('h.id as hotel_id,h.*,hr.check_in_time as check_in,hr.check_out_time as check_out,hr.*,hi.*');
            $this->db->from(HOTELS.' h'); 
            $this->db->join(HOTEL_RESOURCE.' hr','hr.hotel_id = h.id'); 
            $this->db->join(HOTEL_IMAGES_TBL.' hi','hi.hotel_id = h.id','left');  
            $this->db->where('h.deleted',0);
//            if($this->session->userdata('user_role_id')==6){
//                $this->db->where('u.id', $this->session->userdata('ID'));
//            }
            if($data !=''){
                $this->db->like('h.hotel_name', $data['hotel_name']); 
                $this->db->like('h.city', $data['city']); 
                $this->db->like('h.phone', $data['phone']); 
                $this->db->like('h.email', $data['email']); 
               } 
            $result = $this->db->get()->result_array();  
//            echo '<pre>';            print_r($this->session->userdata('user_role_ID')); die;
            return $result;
	}
	
         public function get_single_row($id){ 
            $this->db->select('h.id as hotel_id,h.*,hr.check_in_time as check_in,hr.check_out_time as check_out,hr.*,hi.*');
            $this->db->from(HOTELS.' h'); 
            $this->db->join(HOTEL_RESOURCE.' hr','hr.hotel_id = h.id'); 
            $this->db->join(HOTEL_IMAGES_TBL.' hi','hi.hotel_id = h.id','left');  
            $this->db->where('h.id',$id);
            $this->db->where('h.deleted',0);
            $result = $this->db->get()->result_array();  
//            echo $this->db->last_query(); die;
            return $result;
	}
                        
        public function add_db($data){      
//            echo '<pre>';            print_r($data); die;
                $this->db->trans_start();
                
		$this->db->insert(HOTELS, $data['hotel_tbl']); 
		$this->db->insert(HOTEL_RESOURCE, $data['resource_tbl']); 
		$this->db->insert(HOTEL_IMAGES_TBL, $data['hotel_img_tbl']);  
                
		$status[0]=$this->db->trans_complete();
		$status[1]=$data['resource_tbl']['hotel_id']; 
		return $status;
	}
        
        public function edit_db($id,$data){
		$this->db->trans_start();
                
		$this->db->where('id', $id);
		$this->db->update(HOTELS, $data['hotel_tbl']);
                        
		$this->db->where('hotel_id', $id);
		$this->db->update(HOTEL_RESOURCE, $data['resource_tbl']);
                        
		$this->db->where('hotel_id', $id);
		$this->db->update(HOTEL_IMAGES_TBL, $data['hotel_img_tbl']); 
                        
		$status=$this->db->trans_complete(); 
		return $status;
	}
        
        public function delete_db($id,$data){ 
		$this->db->trans_start();
                
		$this->db->where('id', $id);
		$this->db->update(HOTELS, $data);
                        
		$this->db->where('hotel_id', $id);
		$this->db->update(HOTEL_RESOURCE, $data);
                        
		$this->db->where('hotel_id', $id);
		$this->db->update(HOTEL_IMAGES_TBL, array('deleted'=>1)); 
                
		$status=$this->db->trans_complete();
		return $status;
	}
        
        function delete_db2($id){
                $this->db->trans_start();
                $this->db->delete(HOTELS, array('id' => $id));     
                $this->db->delete(HOTEL_RESOURCE, array('hotel_id' => $id));     
                $this->db->delete(HOTEL_IMAGES_TBL, array('hotel_id' => $id));     
                $status = $this->db->trans_complete();
                return $status;	
	} 
        
 
}
?>