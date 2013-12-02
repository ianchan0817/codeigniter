<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Member controller
 */
class Member extends MY_Controller {
	private $tag = "member";
	private $data = array();
	private $meta = array();
	private $javascript = array();
	private $css = array();
	
	public function __construct() {
		parent :: __construct();
		//Local array
		$this->meta = parent::$this->meta();		
		$this->javascript =  parent::$this->javascript();
		$this->css = parent::$this->css();
		
		//Meta
		$this->data['meta'] = $this->meta;
		
		//CSS
		$this->data['css'] = $this->css;
		array_push($this->data['css'], "$this->tag/common");
		
		//Javascript
		$this->data['javascript'] = $this->javascript;
		array_push($this->data['javascript'], "$this->tag/common" );
		array_push($this->data['javascript'], "jquery.validate.min");
		
		//Title
		$this->data['title'] = parent::$this->title;
	}
	
	public function index() {
		//common index function
		parent :: index();
		array_push($this->data['javascript'], "$this->tag/index");
		array_push($this->data['css'], "$this->tag/index");

				
		if (!$this->ion_auth->logged_in()) {
			//redirect them to the login page
			redirect('member/login', 'refresh');
		} else if (!$this->ion_auth->is_admin()) {
			//redirect them to the home page because they must be an administrator to view this
			redirect('/', 'refresh');
		} else {
			//redirect them to view because they are member, but not admin
			redirect('/', 'refresh');
		}
	}
	
	public function logout() {
		$this->ion_auth->logout();
		redirect("/member/", "refresh");
	}
	
	public function facebook_login() {
		$user = $this->facebook->getUser();
		if ($user) {
			try {			
                $me = $this->facebook->api('/me');
            } catch (FacebookApiException $e) {
				print_r($e);
			}
			
			$last_name = $me['last_name'];
			$first_name = $me['first_name'];
			$username = $me['username'];
			$email = $me['email'];
			$birthday = $me['birthday'];
			
			$date = new DateTime($birthday);
			$birthday = $date->format('Y-m-d');
			
			$gender = $me['gender'];
			$fb_id = $me['id'];
			$password = "No1pass2word3";
			
			$additional_data = array(
				'first_name' => $first_name,
				'last_name'  => $last_name,
				'gender'    => $gender,
				'birthday' => $birthday,
				'initialize' => 0,
				'fb_id' => $fb_id
			);
			
			if (!$this->ion_auth->email_check($email)) {
				$this->ion_auth->register($username, $password, $email, $additional_data);
				redirect("member", "refresh");
			} else {
				$this->ion_auth->login($email, $password, true);
			}
			
		} else {
			$loginUrl = $this->facebook->getLoginUrl(array('scope' => 'user_birthday, email'));
			redirect($loginUrl, "refresh");
		}
	}
	
	public function login() {
		$this->data['title'] = "Login";
		array_push($this->data['javascript'], $this->tag . $this->uri->slash_segment(2, "leading"));
		array_push($this->data['css'], $this->tag . $this->uri->slash_segment(2, "leading"));
		
		$this->form_validation->set_rules('identity', 'Identity', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == true){
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
				show_error('Welcome' , 200 );
			} else {
				show_error('Login failed' , 501 );
			}
		} else {
			$this->data['message'] = validation_errors();
			$this->layout->view('member/login', $this->data);
		}
	}
		
		
	public function register() {
		$this->data['title'] = "Register";
		array_push($this->data['javascript'], $this->tag . $this->uri->slash_segment(2, "leading"));
		
		//validate form input
		$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		$this->form_validation->set_rules('year', 'Year', 'required|xss_clean');
		$this->form_validation->set_rules('month', 'Month', 'required|xss_clean');
		$this->form_validation->set_rules('year', 'Day', 'required|xss_clean');
		$this->form_validation->set_rules('day', 'Gender', 'required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required');
		
		if ($this->form_validation->run() == false) {
			$this->data['message'] = validation_errors();
			$this->layout->view('member/register', $this->data);
		} else {
			$first_name = $this->input->post('first_name');
			$last_name = $this->input->post('last_name');
			$username = $first_name . "." . $last_name;
			
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$birthday = new DateTime();
			$birthday->setDate($this->input->post('year'), $this->input->post('month'), $this->input->post('day'));
			
			$additional_data = array(
				'first_name' => $first_name,
				'last_name'  => $last_name,
				'gender'    => $this->input->post('gender'),
				'birthday' => $birthday->format('Y-m-d'),
				'initialize' => 0,
				'fb_id' => ""
			);
			
			if (!$this->ion_auth->email_check($email)) {
				$data['user_id'] = $this->ion_auth->register($username, $password, $email, $additional_data);
				redirect("member", "refresh");
			} else {
				show_error('This email is already registered.' , 500 );
			}
		}
	}
	
	public function forgot_password() {
		$this->data['title'] = "Forgot Password";
		array_push($this->data['javascript'], $this->tag . $this->uri->slash_segment(2, "leading"));
		
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		if ($this->form_validation->run() == false) {
			$this->data['message'] = validation_errors();
			$this->layout->view('member/forgot_password', $this->data);
		} else {
			$email = $this->input->post('email');
			
			// get identity for that email
			$config_tables = $this->config->item('tables', 'ion_auth');
			$identity = $this->db->where('email', $this->input->post('email'))->limit('1')->get($config_tables['users'])->row();
			
			if (!empty($identity)){			
				//run the forgotten password method to email an activation code to the user
				$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});
				if ($forgotten) {
					//if there were no errors
					$this->data['message'] =  $this->ion_auth->messages();
					$this->layout->view('member/forgot_password', $this->data);
				} else {
					$this->data['message'] =  $this->ion_auth->errors();
					$this->layout->view('member/forgot_password', $this->data);
				}
			} else {
				$this->data['message'] = "The email is not valid.";
				$this->layout->view('member/forgot_password', $this->data);
			}
		}
	}
	
	//activate the user
	function activate($id, $code=false) {
		if ($code !== false)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
			//redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("member", 'refresh');
		}
		else
		{
			//redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("member/forgot_password", 'refresh');
		}
	}
	
	
}
/* End of file member.php */
/* Location: ./application/controllers/member.php */
