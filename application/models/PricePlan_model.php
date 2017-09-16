<?php 

class PricePlan_model extends CI_Model
{
	function __construct(){	
            parent::__construct(); 
 	}
	 
         public function search_result($data=''){ 
            $this->db->select('pp.*,tt.tarrif_type_name as tt_name,h.hotel_name');
            $this->db->from(PRICEPLAN.' pp');  
            $this->db->join(TARRIF_TYPE.' tt','tt.id = pp.tarrif_type_id');  
            $this->db->join(HOTELS.' h','h.id = pp.hotel_id');  
            $this->db->join(TIME_BASE.' tb','tb.id = pp.time_base_id');  
            $this->db->join(CURRENCY.' cr','cr.code = pp.currency_id');  
            $this->db->where('pp.deleted',0);
            if($data !=''){
                $this->db->like('pp.season_name', $data['name']); 
                $this->db->like('pp.hotel_id', $data['hotel_id']); 
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
            $this->db->from(PRICEPLAN); 
            $this->db->where('id',$id);
            $this->db->where('deleted',0);
            $result = $this->db->get()->result_array();  
            return $result;
	}
         public function get_amounts($price_plan_id){ 
            $this->db->select('*');
            $this->db->from(PRICEPLAN_AMOUNT); 
            $this->db->where('price_plan_id',$price_plan_id);
            $this->db->where('deleted',0);
            $result = $this->db->get()->result_array();  
            return $result;
	}
                        
         public function check_date_interference($date_from,$date_to,$hotel_id,$market,$tarrif_type_id,$time_base_id,$price_plan_id=0){ 
             $date_from = strtotime($date_from);
             $date_to = strtotime($date_to);
             
            $check_inside_query = "("."(date_from <= '$date_from' AND date_from <= '$date_to' AND date_to >= '$date_from' AND date_to >= '$date_to')  "; 
            $check_full_out_query = "(date_from >= '$date_from' AND date_from <= '$date_to' AND date_to >= '$date_from' AND date_to <= '$date_to')  "; 
            $check_left_query = "(date_from >= '$date_from' AND date_from <= '$date_to' AND date_to >= '$date_from' AND date_to >= '$date_to')  "; 
            $check_right_query = "(date_from <= '$date_from' AND date_from <= '$date_to' AND date_to >= '$date_from' AND date_to <= '$date_to')  ".")"; 
             
            $this->db->select('*');
            $this->db->from(PRICEPLAN); 
            $this->db->where('deleted',0);
            $this->db->where('hotel_id',$hotel_id);
            $this->db->where('market_id',$market); 
            $this->db->where('tarrif_type_id',$tarrif_type_id); 
            $this->db->where('time_base_id',$time_base_id); 
            $this->db->where('id!=',$price_plan_id); 
            $this->db->where($check_inside_query);
            $this->db->or_where($check_full_out_query);
            $this->db->or_where($check_left_query);
            $this->db->or_where($check_right_query); 
            $result = $this->db->get()->result_array();  
//            echo $this->db->last_query();  die; ;
            return $result;
	}
                        
        public function add_db($data){       
                $this->db->trans_start();
		$this->db->insert(PRICEPLAN, $data); 
                $insert_id =  $this->db->insert_id();
		$status[0]=$this->db->trans_complete();
		$status[1]=$insert_id; 
		return $status;
	}
        public function add_db_amount($data){       
                $this->db->trans_start();
                foreach ($data as $amount){
                    $this->db->insert(PRICEPLAN_AMOUNT, $amount); 
                }
		$status=$this->db->trans_complete();
		return $status;
	}
        
        public function edit_db($id,$data){
		$this->db->trans_start();
                
		$this->db->where('id', $id);
                $this->db->where('deleted',0);
		$this->db->update(PRICEPLAN, $data);
                        
		$status=$this->db->trans_complete();
		return $status;
	}
        
        
        public function edit_db_amount($data){
//		$this->db->trans_start();
                foreach ($data as $amount){
                    
                    $this->db->where('price_plan_id', $amount['price_plan_id']);
                    $this->db->where('mealplan_code', $amount['mealplan_code']);;
                    $this->db->update(PRICEPLAN_AMOUNT, $amount);
                    if($this->db->affected_rows()==0){
//                        $this->db->insert(PRICEPLAN_AMOUNT, $amount);   
                    } 
                }
//		$status=$this->db->trans_complete();
		return $status;
	}
        
        public function delete_db($id,$data){ 
		$this->db->trans_start();
		$this->db->where('id', $id);
		$this->db->where('id!=', 1);
                $this->db->where('deleted',0);
		$this->db->update(PRICEPLAN, $data);
		$status=$this->db->trans_complete();
		return $status;
	}
        
        function delete_db2($id){
                $this->db->trans_start();
                $this->db->delete(PRICEPLAN, array('id' => $id));     
                $status = $this->db->trans_complete();
                return $status;	
	} 
        
 
}
?>