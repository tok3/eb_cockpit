<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Public Journal module controller
 *
 * @author  tobias@mmsetc.de
 * @package energieberaer
 */
class adminLTE extends Public_Controller
{

   public function __construct()
   {
	  parent::__construct();
	  Asset::add_path('theme', site_url('addons/shared_addons/modules/cockpit').'/');

	  $this->lang->load('cockpit');

		 }

   /**
	* Index
	*/
   public function index()
   {
$this->template->enable_parser(true);
	  	  $this->template->set_layout('cockpit.php');



		  $asside = $this->load->view('adminLTE/sidebar', '',true);

		  	  $this->template
		 ->set('aside', $asside)
->append_js('module::AdminLTE/dashboard.js') 
		 ->build('adminLTE/index')
		 ;


   }


// --------------------------------------------------------------------
   
   public function datatables()
   {
$this->template->enable_parser(true);
	  	  $this->template->set_layout('cockpit.php');



		  $asside = $this->load->view('adminLTE/sidebar', '',true);

		  
		  	  $this->template
		 ->set('aside', $asside)
		 ->build('adminLTE/datatables')
		 ;


   }


   // --------------------------------------------------------------------
}