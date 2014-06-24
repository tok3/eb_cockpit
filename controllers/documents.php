<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Public module controller
 *
 * @author  tobias@mmsetc.de
 * @package energieberater
 */
class Documents extends Public_Controller
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


	  $dash = $this->load->view('docs', '',true);

	  $section['title'] = 'Dokumente';
	  $section['breadcrumb'] = '<li><a href="#"><i class="fa fa-exchange"></i> Home</a></li>
	  <li class="active">Dokumente</li>';

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
}