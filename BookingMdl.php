<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class BookingMdl extends CI_Model 
{
	public function __construct()
	{
		parent::__construct(); 
	}
	
	public function slotsDetailById($slot_batch_id,$package_id='')
	{


		$this->db->select('tbl_facility_batch_slot.*,tbl_slot_package_price.slot_package_price');
		$this->db->from('tbl_facility_batch_slot');
		$this->db->join('tbl_slot_package_price', 'tbl_facility_batch_slot.batch_slot_id = tbl_slot_package_price.batch_slot_id');
		$this->db->where('tbl_facility_batch_slot.batch_slot_id',$slot_batch_id);
		if($package_id!=''){

			$this->db->where('tbl_slot_package_price.package_id',$package_id);
		}
		$query = $this->db->get();

		//echo $this->db->last_query(); die;
		return $query->result();
	}
	
	public function batchSlotTypeDetail($slot_batch_id){
		$this->db->select('tbl_batch_slot_type.*');
		$this->db->from('tbl_batch_slot_type');
		$this->db->join('tbl_facility_batch_slot', 'tbl_facility_batch_slot.batch_slot_type_id = tbl_batch_slot_type.batch_slot_type_id');
		$this->db->where('tbl_facility_batch_slot.batch_slot_id',$slot_batch_id);
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		return $query->row();
	 }

	## get facility name by fac id ------
	public function getFacNameById($fac_id){
		$this->db->select('fac_name');
		$this->db->from('tbl_facility');
		$this->db->where('fac_id', $fac_id);
		$query = $this->db->get();
        $result = $query->result();
		if ($query->num_rows()>0) {
			return $result[0]->fac_name;
		}else{
			return '';
		}
	}
	public function getFacSportList($fac_id)
	{
		 	$this->db->select('tfs.*,tsl.sport_name,tsl.sport_icon');
			$this->db->from('tbl_facility_sport tfs');
			$this->db->join('tbl_sport_list tsl', 'tsl.sport_id = tfs.sport_id');
			$this->db->where('tfs.fac_id', $fac_id);
			//$this->db->group_by('tfc.fac_sport_id');
			$this->db->order_by('tfs.fac_sport_id','DESC');
			$query = $this->db->get(); 
			                                                     
			return $query->result();
	}
	
	public function getSunResultLimitBooking($year=2020,$fac_id, $sport_id){
		$cond='';
		if($sport_id!=''){
			$cond=" AND tbsd.sport_id = $sport_id";
		}
		$total_amount_mounth=array();
		$months=array('Jan','Feb','Mar','April','May','June','July','Aug','Sept','Oct','Nov','Dec');
		for($i=0; $i<count($months); $i++){
			$m = $i+1;
		 $query= $this->db->query("select  SUM(tbo.final_amount)as total_amount_user, tbo.booking_on from tbl_booking_order tbo
			LEFT JOIN tbl_booking_slot_detail tbsd on tbsd.booking_order_id = tbo.booking_order_id
			Where MONTH(tbo.booking_on) = $m AND YEAR(tbo.booking_on) = $year AND tbsd.fac_id = $fac_id $cond");
		 $result = $query->result();
			if($result){
				if($result[0]->total_amount_user>0){$total_amount_mounth[$months[$i]] = $result[0]->total_amount_user;}else{$total_amount_mounth[$months[$i]]=0; }
			}else{
				$total_amount_mounth[$months[$i]]=0;
			}
		}
		//echo $this->db->last_query();
		return $total_amount_mounth;
		
	}
	
	
	public function BookingOrderCountOffline($year=2020,$fac_id){
			$this->db->select('tbo.*,tbsl.*');
			$this->db->from('tbl_booking_order tbo');
			$this->db->join('tbl_booking_slot_detail as tbsl','tbsl.booking_order_id=tbo.booking_order_id');
			$this->db->where(array('tbo.payment_status'=>'success','tbo.booking_type'=>'Offline','YEAR(tbo.booking_on)' => $year,'tbsl.fac_id'=>$fac_id));
			$query = $this->db->get(); 			
		    return $query->num_rows();
		}
		
		public function BookingOrderCountOnline($year=2020,$fac_id){
			$this->db->select('tbo.*,tbsl.*');
			$this->db->from('tbl_booking_order tbo');
			$this->db->join('tbl_booking_slot_detail as tbsl','tbsl.booking_order_id=tbo.booking_order_id');
			$this->db->where(array('tbo.payment_status'=>'success','tbo.booking_type'=>'online','YEAR(tbo.booking_on)' => $year,'tbsl.fac_id'=>$fac_id));
			$query = $this->db->get(); 			
		    return $query->num_rows();
		}
		
	
	public function getSunResultBookingEvent($year=2020,$fac_id, $sport_id){
		$cond='';
		if($sport_id!=''){
			$cond=" AND tbed.event_sport_id = $sport_id";
		}
		$total_amount_mounth=array();
		$months=array('Jan','Feb','Mar','April','May','June','July','Aug','Sept','Oct','Nov','Dec');
		for($i=0; $i<count($months); $i++){
			$m = $i+1;
		 $query= $this->db->query("select  SUM(tbo.final_amount)as total_amount_user, tbo.booking_on from tbl_booking_order tbo
			LEFT JOIN tbl_booking_event_detail tbed on tbed.booking_order_id = tbo.booking_order_id
			Where MONTH(tbo.booking_on) = $m AND YEAR(tbo.booking_on) = $year AND tbed.fac_id = $fac_id $cond");
		 $result = $query->result();
			if($result){
				if($result[0]->total_amount_user>0){$total_amount_mounth[$months[$i]] = $result[0]->total_amount_user;}else{$total_amount_mounth[$months[$i]]=0; }
			}else{
				$total_amount_mounth[$months[$i]]=0;
			}
		}
		//echo $this->db->last_query();
		return $total_amount_mounth;
		
	}
	
	
	public function BookingOrderCountEventOffline($year=2020,$fac_id){
			$this->db->select('tbo.*,tbsl.*');
			$this->db->from('tbl_booking_order tbo');
			$this->db->join('tbl_booking_slot_detail as tbsl','tbsl.booking_order_id=tbo.booking_order_id');
			$this->db->where(array('tbo.payment_status'=>'success','tbo.booking_type'=>'Offline','YEAR(tbo.booking_on)' => $year,'tbsl.fac_id'=>$fac_id));
			$query = $this->db->get(); 			
		    return $query->num_rows();
		}
		
		public function BookingOrderCountEventOnline($year=2020,$fac_id){
			$this->db->select('tbo.*,tbsl.*');
			$this->db->from('tbl_booking_order tbo');
			$this->db->join('tbl_booking_slot_detail as tbsl','tbsl.booking_order_id=tbo.booking_order_id');
			$this->db->where(array('tbo.payment_status'=>'success','tbo.booking_type'=>'online','YEAR(tbo.booking_on)' => $year,'tbsl.fac_id'=>$fac_id));
			$query = $this->db->get(); 			
		    return $query->num_rows();
		}
		
}