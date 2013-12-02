<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* This is the parent controller
**/
class MY_Controller extends CI_Controller {
	//Default title
	public $title = "";
	
	//Meta
	private $meta = array();
	
	//Javascript
	private $javascript = array();
	
	//CSS
	private $css = array();
	
	public function __construct() {
		parent :: __construct();
		
		$this->title = 'Codeigniter';
		
		$this->meta['description'] = 'This is the description';
		$this->meta['keywords'] = 'keyword1, keyword2';
		$this->meta['author'] = 'Codeigniter';
		
		$this->javascript['jquery'] = 'jquery-2.0.3.min';
		$this->javascript['jquery-ui'] = "jquery-ui-1.10.3.custom.min";
		$this->javascript['common'] = 'common';
		
		$this->css['common'] = 'common';
		$theme = 'ui-lightness';
		$this->css['jquery-ui'] = "$theme/jquery-ui-1.10.3.custom.min";

	}
	
	public function index() {

	}
	
	public function is_member() {
		if (!$this->ion_auth->logged_in()) {
			redirect('/', 'refresh');
		}
	}
	
	public function meta() {
		return $this->meta;
	}
	
	public function javascript() {
		return $this->javascript;
	}
	
	public function css() {
		return $this->css;
	}

}