<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Public Journal module controller
 *
 * @author  tobias@mmsetc.de
 * @package energieberaer
 */
class Cockpit extends Public_Controller
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

	   /* //permisssionstest
role_or_die($this->module,'customer');
$this->permissions['cockpit']['customer'];
if (group_has_role($this->module, 'customer'))
{
   echo "<pre><code>";
   print_r($this->permissions);
   echo "</code></pre>";
   
}
	   */
	  $contacts_m = $this->load->model('contacts_m');	   
	  $this->template->enable_parser(true);
	  $this->template->set_layout('cockpit.php');


	  $dash = $this->load->view('dashboard', '',true);

	  $section['title'] = 'Nachrichtenzentrale';
	  $section['breadcrumb'] = '<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li class="active">Dashboard</li>';
	

	  $this->template
		 ->set_partial('header','header',array())
		 ->set_partial('aside','sidebar',$section)
		 ->append_js('module::contacts_grid.js') 
		 ->append_js('module::modules.js')
		 ->set('content', $dash)
		 ->build('default')

		 ;



	}

// --------------------------------------------------------------------
	
	public function versorger()
	{



	  $this->template->enable_parser(true);
	  $this->template->set_layout('cockpit.php');


	  $dash = $this->load->view('versorger', '',true);

	  $aside['title'] = 'Energieversorger';
	  $aside['breadcrumb'] = '<li><a href="#"><i class="fa fa-fire"></i> Home</a></li>
	  <li class="active">Energieversorger</li>';

	  $this->template
		 ->set_partial('header','header',array())
		 ->set_partial('aside','sidebar',$aside)
		 ->append_js('module::versorger.js')
		 ->append_js('module::contacts_grid.js') 
		 ->append_js('module::modules.js')
		 ->set('content', $dash)
		 ->build('default')

		 ;



	}


// --------------------------------------------------------------------
}