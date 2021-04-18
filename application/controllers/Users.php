<?php
/**
 * 
 */
class Users extends MY_Controller
{
	protected $access = 'no';
	function __construct() {	

        parent::__construct();
        $this->load->model('Users_model');
        $this->load->model('Country_model');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->view('common/header');
        
        /* convert date custom helper that i use to convert date in view file */
        $this->load->helper('test');
    }

    public function logout()
    {
        $user_data = $this->session->all_userdata();
        
        foreach ($user_data as $key => $value) {
            
                $this->session->unset_userdata($key);
            
        }
        
        $this->session->set_flashdata('success','Logout successfully');
        redirect('auth');
    }

	public function index()
	{		
		$total_count = $this->Users_model->countUsers();

		$limit = 5;
		$page = 1;
		$offset = 0;
		$current_page = 1;
		if($total_count >= $limit){
			if(isset($_GET['page'])){
				$page = $_GET['page'];
				$current_page = $page;
			}
			
		    $offset = ($page-1) * $limit;
		}
		$number_of_page = ceil ($total_count / $limit);  
		$result_data = $this->Users_model->getDataPagination($limit,$offset);
		$data = array('page'=>$page,'limit'=>$limit,'total_count'=>$total_count,
						'number_of_page'=>$number_of_page,'current_page'=>$current_page);
		$data['users'] = $result_data;
		$this->load->view('users/index',$data);
	}	

	public function create()
	{
		// get country data.....
		$country_data = $this->Country_model->getCountry();		

		$this->form_validation->set_rules('fname','Name','required');
		$this->form_validation->set_rules('email','Email','required|valid_email');
		$this->form_validation->set_rules('mobile','Mobile','required|regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('password','Password','required');

		if($this->form_validation->run() == false){
			$data = array('country_data' => $country_data);

			$this->load->view('users/create',$data);
		}else{

			// image upload code start

				$upload_path="assets/upload/";
				
				if(!file_exists($upload_path)) 
				{
				mkdir($upload_path, 0777, true);
				}
				$RandomAccountNumber = mt_rand(1, 9999999); 
				
				$config = array(
				'upload_path' => $upload_path,
				'allowed_types' => "jpg|png|jpeg",
				'overwrite' => TRUE,
				'max_size' => "2048000", 
				'max_height' => "111768",
				'file_name' => $RandomAccountNumber,
				'max_width' => "1111024"
				);	  
				
				$image_array = $this->load->library('upload', $config);
				
				if(!$this->upload->do_upload('user_image'))
				{	
					$data['imageError'] =  $this->upload->display_errors();
					$image="";

					$this->session->set_flashdata('error',$data['imageError']);
					redirect(base_url().'users/create');
					
				}
				
				else
				{  
					$imageDetailArray = $this->upload->data();
					
					$image =  $imageDetailArray['file_name'];   
				
				}

				// image upload code end
			
			// save data into database.....
			$formArray = array();
			$formArray['user_image'] = $image;
			$formArray['fname'] = $this->input->post('fname');
			$formArray['lname'] = $this->input->post('lname');
			$formArray['email'] = $this->input->post('email');
			$formArray['mobile'] = $this->input->post('mobile');
			$formArray['country'] = $this->input->post('country');
			$formArray['state'] = $this->input->post('state');
			$formArray['city'] = $this->input->post('city');
			$formArray['zipcode'] = $this->input->post('zipcode');
			$formArray['gender'] = $this->input->post('gender');
			$formArray['address'] = $this->input->post('address');
			$formArray['hobbies'] = implode(',',$this->input->post('hobbies'));
			$formArray['password'] = md5($this->input->post('password'));

			$formArray['created_date'] = date('Y-m-d h:i:s');

			$email = $formArray['email'];
			$mobile = $formArray['mobile'];

			// check e-mail or mobile already exists or not
			$check_data = $this->Users_model->checkdata($email,$mobile);

			if($check_data >= 1){
				$this->session->set_flashdata('error','Record already exists!');
				unlink($upload_path.$image);
				redirect(base_url().'users/create');
				
			}else{

				$data = $this->Users_model->create($formArray);
				$this->session->set_flashdata('success','Record added successfully!');
				redirect(base_url().'users/index');
			}

			

		}
	}

	public function getstate()
	{
		$country_id = $this->input->post('country_id');
		if(!empty($country_id)){
			$get_state = $this->Country_model->getstate($country_id);
			$data = array('success' => true, 'data' => $get_state );

		}else{
			$data = array('success' => true, 'data' => 'empty');
		}
		echo json_encode($data);
		exit;
	}

	public function getcity()
	{
		$country_id = $this->input->post('country_id');
		$state_id = $this->input->post('state_id');
		if(!empty($country_id) && !empty($state_id)){
			$get_city = $this->Country_model->getcity($country_id,$state_id);
			$data = array('success' => true, 'data' => $get_city );

		}else{
			$data = array('success' => true, 'data' => 'empty');
		}
		echo json_encode($data);
		exit;
	}

	public function edit($user_id){		
		
		//fetch this user record
		$get_user_data = $this->Users_model->getUser($user_id);
		
		$data = array();
		if(!empty($get_user_data)){
			$data['user_data'] = $get_user_data;
		}

		$hobbies = explode(',', $get_user_data['hobbies']);
		$country_id = $get_user_data['country'];
		$state_id = $get_user_data['state'];
		$city_id = $get_user_data['city']; 

		// get country data.....
		$country_data = $this->Country_model->getCountry();

		// get state data.....
		$state_data = $this->Country_model->getState($country_id);

		// get city data.....
		$city_data = $this->Country_model->getCity($country_id,$state_id);

		$data['country_data'] = $country_data;
		$data['state_data'] = $state_data;
		$data['city_data'] = $city_data;
		$data['hobbies'] = $hobbies;
		$this->form_validation->set_rules('fname','Name','required');
		$this->form_validation->set_rules('email','Email','required|valid_email');
		$this->form_validation->set_rules('mobile','Mobile','required|regex_match[/^[0-9]{10}$/]');


		if($this->form_validation->run() == false){


			$this->load->view('users/edit',$data);
		}else{

			// image upload code start

			$old_image = $get_user_data['user_image'];
			$upload_path="assets/upload"; 	  
			  
			  $RandomAccountNumber = mt_rand(1, 9999999); 
			  
			  if(!file_exists($upload_path)) 
			  {
			  mkdir($upload_path, 0777, true);
			  }	  
			  $config = array(
			  'upload_path' => $upload_path,
			  'allowed_types' => "jpg|png|jpeg",
			  'overwrite' => TRUE,
			  'max_size' => "2048000",
			  'file_name' => $RandomAccountNumber, 
			  'max_height' => "111768",	 
			  'max_width' => "1111024", );	  
			  
			  $image_array = $this->load->library('upload', $config);
			  
			  if(!$this->upload->do_upload('user_image'))
			  { 
				  $data['imageError'] =  $this->upload->display_errors();
				  
				  if(empty($_FILES['user_image']['name'])){

				  }else{
				  	$this->session->set_flashdata('error',$data['imageError']);
						redirect(base_url().'users/edit/'.$user_id);
				  }				  
			  	  
			  }	  
			  else
			  {		  
			  $imageDetailArray = $this->upload->data();	  
			  $image_user =  $imageDetailArray['file_name']; 
			  }
				if(empty($image_user))	 
					{
					$image_user = $old_image;
				}

			// image upload code end

			//update user record...
			
			$formArray = array();
			$formArray['user_image'] = $image_user;
			$formArray['fname'] = $this->input->post('fname');
			$formArray['lname'] = $this->input->post('lname');
			$formArray['email'] = $this->input->post('email');
			$formArray['mobile'] = $this->input->post('mobile');
			$formArray['country'] = $this->input->post('country');
			$formArray['state'] = $this->input->post('state');
			$formArray['city'] = $this->input->post('city');
			$formArray['zipcode'] = $this->input->post('zipcode');
			$formArray['gender'] = $this->input->post('gender');
			$formArray['address'] = $this->input->post('address');
			$formArray['hobbies'] = implode(',',$this->input->post('hobbies'));

			$email = $formArray['email'];
			$mobile = $formArray['mobile'];

			//check user email and mobile exists within this record ...
			$check_record_exists = $this->Users_model->check_record_update($user_id,$email,$mobile);

			if(count($check_record_exists) > 0){
				$this->session->set_flashdata('error','Record already exists!');
					redirect(base_url().'users/edit/'.$user_id);
			}else{
				$update_success = $this->Users_model->updateUser($user_id,$formArray);

				if($update_success == true){
					$this->session->set_flashdata('success','Record updated successfully!');
					redirect(base_url().'users/index');
				}else{
					$this->session->set_flashdata('error','Something went wrong!');
					redirect(base_url().'users/index');
				}
			}
			

		}
	}

	public function delete($user_id){

		// check user exists or not
		$user_data = $this->Users_model->getUser($user_id);
		
		if($user_data != ''){

			$delete_record = $this->Users_model->deleteUser($user_id);
			if($delete_record == true){
				unlink('assets/upload/'.$user_data['user_image']);
				$this->session->set_flashdata('success','Record deleted successfully');
				echo json_encode("success");
				exit;
			}
		}else{
			$this->session->set_flashdata('error','Record not found in database');
				echo "success";
				exit;
		}
	}
}
?>