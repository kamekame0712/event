<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Errors extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function error_404()
	{
		$this->output->set_status_header('404');
		$this->load->view('errors/error_404');
	}
}
