<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Summer21 extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function kansai()
	{
		$this->load->view('front/summer21/kansai');
	}

	public function chushikoku()
	{
		$this->load->view('front/summer21/chushikoku');
	}

	public function kyushu()
	{
		$this->load->view('front/summer21/kyushu');
	}
}
