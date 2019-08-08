<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_labaRugi extends CI_Controller {

    private $header_data;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array("url"));
        $this->header_data['controller'] = $this->uri->segments[1];
        
    }

	public function index()
	{
        $this->load->view('headerMenu', $this->header_data);
        $this->load->view('labaRugi_home');
        $this->load->view('footer');
	}
}
