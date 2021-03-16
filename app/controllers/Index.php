<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index($season = '', $office = '')
	{
		if( $season == '' && $office == '' ) {
			$this->load->view('front/index');
		}
		else if( $season == '21summer' ) {
			switch( $office ) {
				case 'kansai':
					$this->load->view('front/21summer/kansai');
					break;
				case 'chuusikoku':
					$this->load->view('front/21summer/chuusikoku');
					break;
				case 'kyuushuu':
					$this->load->view('front/21summer/kyuushuu');
					break;
				default:
					$this->load->view('front/21summer/index');
			}
		}
	}
}
