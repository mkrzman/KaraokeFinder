<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class About extends CI_Controller {

  function __construct()
  {
    parent::__construct();
  }

  function index($page = 'about')
  { 

    
    if($this->session->userdata('logged_in'))
    {
      $session_data = $this->session->userdata('logged_in');
      $data['username'] = $session_data['username'];
     

      $data['title'] = ucfirst($page); // Capitalize the first letter
      $data['page'] = $page;
      $this->load->view('templates/prelogin_header', $data);
      $this->load->view('pages/about', $data); 
      $this->load->view('templates/footer', $data);

    }
    else
    {
      $session_data = $this->session->userdata('logged_in');
      $data['username'] = $session_data['username'];
     

      $data['title'] = ucfirst($page); // Capitalize the first letter
      $data['page'] = $page;
      $this->load->view('templates/prelogin_header', $data);
      $this->load->view('pages/about', $data); 
      $this->load->view('templates/footer', $data);
  }
  }
  
  function logout()
  {
    $this->session->unset_userdata('logged_in');
    session_destroy();
    redirect('about', 'refresh');
  }


}

