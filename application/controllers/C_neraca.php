<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_neraca extends CI_Controller {

    private $header_data;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array("url"));
        if(isset($this->uri->segments[1]))
            $this->header_data['controller'] = $this->uri->segments[1];
        else
        $this->header_data['controller'] = 'home';
    }

	public function index()
	{
        $this->load->view('headerMenu', $this->header_data);
        $this->load->view('neraca_home');
        $this->load->view('footer');
	}
}
