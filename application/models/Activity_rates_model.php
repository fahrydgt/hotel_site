<?php 

class Activity_rates_model extends CI_Model
{
	function __construct(){	
            parent::__construct(); 
 	}
	 
         public function search_result($data=''){ 
             
//            echo '<pre>';            print_r($data); die;
            $this->db->select('pp.*,tt.tarrif_type_name as tt_name,a.activity_name');
            $this->db->from(ACTIVITY_PRICEPLAN.' pp');  
            $this->db->join(TARRIF_TYPE.' tt','tt.id = pp.tarrif_type_id');  
            $this->db->join(ACTIVITIES.' a','a.id = pp.activity_id');  
            $this->db->join(TIME_BASE.' tb','tb.id = pp.time_base_id');  
            $this->db->join(CURRENCY.' cr','cr.code = pp.currency_id');  
            $this->db->where('pp.deleted',0);
            if($data !=''){
                $this->db->like('pp.season_name', $data['name']); 
                $this->db->like('pp.activity_id', $data['activity_id']); 
                $this->db->like('pp.tarrif_type_id', $data['tarrif_type_id']); 
               } 
               
            if((isset($data['date']) && $data['date'] !='')){
              $this->db->where('pp.date_to>=', $data['date']); 
              $this->db->where('pp.date_from<=', $data['date']); 
            } 
            $result = $this->db->get()->result_array();  
//            echo $this->db->last_query();die;
//            echo '<pre>'; print_r($data);die;
            return $result;
	}
	
         public function get_single_row($id){ 
            $this->db->select('*');
            $this->db->from(ACTIVITY_PRICEPLAN); 
            $this->db->where('id',$id);
            $this->db->where('deleted',0);
            $result = $this->db->get()->result_array();  
            return $result;
	}
                        
        public function add_db($data){       
                $this->db->trans_start();
		$this->db->insert(ACTIVITY_PRICEPLAN, $data); 
                $insert_id =  $this->db->insert_id();
		$status[0]=$this->db->trans_complete();
		$status[1]=$insert_id; 
		return $status;
	}
        
        public function edit_db($id,$data){
		$this->db->trans_start();
                
		$this->db->where('id', $id);
                $this->db->where('deleted',0);
		$this->db->update(ACTIVITY_PRICEPLAN, $data);
                        
		$status=$this->db->trans_complete();
		return $status;
	}
        
        public function delete_db($id,$data){ 
		$this->db->trans_start();
		$this->db->where('id', $id); 
                $this->db->where('deleted',0);
		$this->db->update(ACTIVITY_PRICEPLAN, $data);
		$status=$this->db->trans_complete();
		return $status;
	}
        
        function delete_db2($id){
                $this->db->trans_start();
                $this->db->delete(ACTIVITY_PRICEPLAN, array('id' => $id));     
                $status = $this->db->trans_complete();
                return $status;	
	} 
        
 
}
?>