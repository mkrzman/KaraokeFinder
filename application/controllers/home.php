<?php //if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//class Login extends CI_Controller {
//function __construct()
// { parent::__construct();} function index($page = 'Home'){
//	$this->load->view('templates/footer', $data);   $this->load->helper(array('form'));}}

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Home extends CI_Controller {

  function __construct()
  {
    parent::__construct();

    $this->load->model('events_model');
    $this->load->model('venues_model');
    error_reporting(E_ALL);
ini_set('display_errors', 1);
$this->db->_error_message();
  }
  function index($page = 'home')
  { 
   $data['select'] = "";
    $data['event_type'] = "";
  	$data['day'] = "";

    $filter = "SELECT * FROM events INNER JOIN venues ON events.venue_id=venues.venue_id";
    $query = $this->db->query("SELECT * FROM events INNER JOIN venues ON events.venue_id=venues.venue_id");



//echo 'Total Results: ' . $query->num_rows();

//filter actions

 if (isset($_GET['select'])){
    $select = $_GET["select"];
    $filter = "SELECT * FROM events INNER JOIN venues ON events.venue_id=venues.venue_id WHERE (event_type LIKE '%".$select."%' OR venue_name LIKE '%".$select."%')";
    $data['select'] = $select;
 }


 if (isset($_GET['day'])) {
  $day = $_GET["day"];
  $filter = $filter."AND day_of_week ='".$day."'";
    $data['day'] = $day;
 }
    $data['search_filter'] = $filter;

 if (isset($_GET['event_type'])) {
  $event_type = $_GET["event_type"];
  $filter = $filter."AND event_type ='".$event_type."'";
    $data['event_type'] = $event_type;
 }

  if (isset($_GET['city']) && $_GET['city'] != "") {
  $city = $_GET["city"];
  $filter = $filter."AND city ='".$city."'";
    $data['search_filter'] = $city;
 }
    $data['search_filter'] = $filter." ORDER BY upcoming_start";








    
    if($this->session->userdata('logged_in'))
    {
      $session_data = $this->session->userdata('logged_in');
      $data['username'] = $session_data['username'];
     

      $data['title'] = ucfirst($page); // Capitalize the first letter
      $data['page'] = $page;
       $this->load->view('templates/prelogin_header', $data);
      $this->load->view('pages/home', $data); 
      $this->load->view('templates/footer', $data);



    }
    else
    {
      $session_data = $this->session->userdata('logged_in');
      $data['username'] = $session_data['username'];

      $data['title'] = ucfirst($page); // Capitalize the first letter
      $data['page'] = $page;
      $this->load->view('templates/prelogin_header', $data);
      $this->load->view('pages/home', $data); 

            $this->load->view('templates/footer', $data);
	}
  }
  
  function logout()
  {
    $this->load->helper('URL');
    $this->session->unset_userdata('logged_in');
    session_destroy();
    redirect('home', 'refresh');
  }


}

function event_type_filter(){

}
