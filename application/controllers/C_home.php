<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array("url"));
    }

	public function index()
	{
        $this->load->view('headerMenu');
        $this->load->view('home');
        $this->load->view('footer');
	}
}
