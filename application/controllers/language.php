<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Language extends CI_Controller {
	function __construct(){
        parent::__construct();
    }
	
	//Only for redirection and language set
	public function index() {
		$this->session->set_userdata('language', $this->uri->segment(2));
		redirect("/", "refresh");
	}
}

/* End of file language.php */
/* Location: ./application/controllers/language.php */