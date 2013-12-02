<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Main controller, the initialized controller 
 */
class Main extends MY_Controller {
	private $tag = "main";
	private $data = array();
	private $meta = array();
	private $javascript = array();
	private $css = array();
	
	public function __construct() {
		parent :: __construct();
		
		/**
		*	Need to set as local variable first because 
		*	array cannot be passed to view. However, 
		*	for parent::$this->title, it is just a string
		* 	only which is okay to pass directly.
		*/
		$this->meta = parent::$this->meta();		
		$this->javascript =  parent::$this->javascript();
		$this->css = parent::$this->css();

		//Mata
		$this->meta['keywords'] .= ",new keyword 1, new keyword 2";
		$this->data['meta'] = $this->meta;

		//CSS
		$this->data['css'] = $this->css;
		array_push($this->data['css'], "$this->tag/common");
		
		//Javascript
		$this->data['javascript'] = $this->javascript;
		array_push($this->data['javascript'], "$this->tag/common" );
		
		//Title
		$this->data['title'] = parent::$this->title;
		
		//Set language
		if ($this->session->userdata('language') == "") {
			 $this->session->set_userdata('language', "english");
		}
		$this->lang->load("common",$this->session->userdata('language'));
	}
	
	public function index() {
		parent :: index();
		array_push($this->data['javascript'], "$this->tag/index");
		array_push($this->data['css'], "$this->tag/index");

		$this->data['body'] = "Main";
		$this->layout->view('main/main', $this->data);
	}
	
	public function email() {
		$this->load->library('email');
		
		$this->email->from('admin@asiamarketingsolutions.com', 'Admin');
		$this->email->to('ypfbpages@gmail.com'); 
		//$this->email->cc('another@another-example.com'); 
		//$this->email->bcc('them@their-example.com'); 
		
		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');	
		
		$this->email->send();
		
		echo $this->email->print_debugger();
	}
	

}
/* End of file main.php */
/* Location: ./application/controllers/main.php */
