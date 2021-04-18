<?php
class Users_model extends CI_model{
	

	function create($data){
		$this->db->insert('users',$data);

		return true;
	}

	function check_login($email,$password){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('email',$email);
		$this->db->where('password',$password);

		$query = $this->db->get();
		$data = $query->row_array();
		return $data;
	}

	function checkdata($email,$mobile){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('email',$email);
		$this->db->or_where('mobile',$mobile);

		$query = $this->db->get();
		$data = $query->num_rows();
		return $data;
	}

	function check_record_update($user_id,$email,$mobile)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id !='.$user_id.' AND (email ="'.$email.'" OR mobile ="'.$mobile.'")');
		$query = $this->db->get();
		$result_array = $query->result_array();

		return $result_array;
	}

	function countUsers()
	{
		$this->db->select('*');
		$this->db->from('users');
		$query = $this->db->get();
		$data = $query->num_rows();

		return $data;
	}

	function getUser($user_id){
		$this->db->select('users.*,country.country_name,state.state_name,city.city_name');
		$this->db->from('users');
		$this->db->join('country','users.country = country.country_id');
		$this->db->join('state','users.state = state.state_id');
		$this->db->join('city','users.city = city.city_id');
		$this->db->where('id',$user_id);
		$query = $this->db->get();
		$result_array = $query->row_array();

		return $result_array;

	}

	function getDataPagination($limit,$offset){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		$data = $query->result_array();

		return $data;
	}

	function updateUser($user_id,$user_data){
		
		$this->db->where('id',$user_id);
		$this->db->update('users',$user_data);

		return true;
	}

	function deleteUser($user_id){

		$this->db->where('id',$user_id);
		$this->db->delete('users');

		return true;
	}

}
?>