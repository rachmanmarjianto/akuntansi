<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_pengaturan extends CI_Controller {

    private $header_data;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array("url"));
        $this->load->model('M_pengaturan');
        $this->header_data['controller'] = $this->uri->segments[1];
    }

	public function index()
	{
        $data['jenisAkun']=$this->M_pengaturan->prepJenisAkun();
        $data['namaAkun']=$this->M_pengaturan->getAllNamaAkun();
        $this->load->view('headerMenu', $this->header_data);
        $this->load->view('home_pengaturan', $data);
        $this->load->view('footer');
        
    }
    
    public function tambahakun()
    {
        echo $this->M_pengaturan->tambahAkun($_POST);
    }

    public function activateAkun()
    {
        echo $this->M_pengaturan->activateAkun($_POST);
    }
}
