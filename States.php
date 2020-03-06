<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class States extends CI_Controller {

  public  function __construct()

  {

    parent::__construct();
	$this->load->model('public/BookingMdl');

  }

  public function index(){
  	$this->load->view('public/facility-dashboard/states/StatesView');
  }
  
  public function StatesSlotAjax(){
	   $fac_id=$this->input->post('fac_id');
	   $sport_id=$this->input->post('book_sport_id');
	   $year= $this->input->post('states_year');
	   if($sport_id!='' || $year!='' || $this->input->post('fac_ids')){
		     $fac_ids=$this->input->post('fac_ids');
			    $year= $this->input->post('states_year');
            $data['sport_list'] = $this->BookingMdl->getFacSportList($fac_id);
			$data['getSunResultLimitBooking'] = $this->BookingMdl->getSunResultLimitBooking($year,$fac_ids,$sport_id);
			$data['BookingOrderCountOffline'] = $this->BookingMdl->BookingOrderCountOffline($year,$fac_ids);
			$data['BookingOrderCountOnline'] = $this->BookingMdl->BookingOrderCountOnline($year,$fac_ids);
			$html['_html'] = $this->load->view('public/facility-dashboard/states/ajax/StatesSlotAjaxChartView',$data,true);
            return $this->output->set_content_type('application/json')->set_output(json_encode($html));
		     
	   }else{

			$data['sport_list'] = $this->BookingMdl->getFacSportList($fac_id);
			$data['getSunResultLimitBooking'] = $this->BookingMdl->getSunResultLimitBooking($year=2020,$fac_id,$sport_id=''); 
			$data['BookingOrderCountOffline'] = $this->BookingMdl->BookingOrderCountOffline($year=2020,$fac_id);
			$data['BookingOrderCountOnline'] = $this->BookingMdl->BookingOrderCountOnline($year=2020,$fac_id);	   
	   } 
	 $html['_html'] = $this->load->view('public/facility-dashboard/states/ajax/StatesSlotAjaxView',$data,true);
     return $this->output->set_content_type('application/json')->set_output(json_encode($html));
  }
  
  
   public function statesEventAjax(){
	   $fac_id=$this->input->post('fac_id');
	    $sport_id=$this->input->post('book_sport_id');
	   $year= $this->input->post('states_year');
	   if($sport_id!='' || $year!='' || $this->input->post('fac_ids')){
	         $fac_ids=$this->input->post('fac_ids');
			 $year= $this->input->post('states_year');
             $data['sport_list'] = $this->BookingMdl->getFacSportList($fac_id);
			 $data['getSunResultEventBooking'] = $this->BookingMdl->getSunResultBookingEvent($year,$fac_ids,$sport_id);
			 $data['BookingOrderCountEventOffline'] = $this->BookingMdl->BookingOrderCountEventOffline($year,$fac_ids);
			 $data['BookingOrderCountEventOnline'] = $this->BookingMdl->BookingOrderCountEventOnline($year,$fac_ids);
		  
		  $html['_html']=$this->load->view('public/facility-dashboard/states/ajax/StatesEventAjaxChartView',$data,true);
		  return $this->output->set_content_type('application/json')->set_output(json_encode($html));
		}else{ 
	        $fac_id=$this->input->post('fac_id');
	        $data['sport_list'] = $this->BookingMdl->getFacSportList($fac_id);
			$data['getSunResultEventBooking'] = $this->BookingMdl->getSunResultBookingEvent($year=2020,$fac_id,$sport_id=''); 
			$data['BookingOrderCountEventOffline'] = $this->BookingMdl->BookingOrderCountEventOffline($year=2020,$fac_id);
			$data['BookingOrderCountEventOnline'] = $this->BookingMdl->BookingOrderCountEventOnline($year=2020,$fac_id);
			
	   }
	        $html['_html']=$this->load->view('public/facility-dashboard/states/ajax/StatesEventAjaxView',$data,true);
			return $this->output->set_content_type('application/json')->set_output(json_encode($html));
   }
  

}