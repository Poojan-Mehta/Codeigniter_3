<?php
class Country_model extends CI_model{

	

	function getCountry()
	{
		$this->db->select('*');
		$this->db->from('country');

		$query = $this->db->get();
		$data = $query->result_array();
		return $data;
	}

	function getState($country_id)
	{
		$this->db->select('*');
		$this->db->from('state');
		$this->db->where('country_id',$country_id);
		$query = $this->db->get();
		$data = $query->result_array();
		return $data;
	}

	function getCity($country_id,$state_id)
	{
		$this->db->select('*');
		$this->db->from('city');
		$this->db->where('country_id',$country_id);
		$this->db->where('state_id',$state_id);
		$query = $this->db->get();
		$data = $query->result_array();
		return $data;
	}

}
?>