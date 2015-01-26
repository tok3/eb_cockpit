<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Public Journal module controller
 *
 * @author  tobias@mmsetc.de
 * @package energieberaer
 */
class calc extends Public_Controller
{
   private $affiliate_group_id;
	public function __construct()
	{
		parent::__construct();
	  Asset::add_path('theme', site_url('addons/shared_addons/modules/cockpit').'/');

        $this->load->driver('Streams');

      $this->template->append_css('module::calculator.css');
      $this->template->append_js('module::energycal.js');

	  $this->lang->load('cockpit');

	}



	/**
	 * Method to register a new user
	 */
	public function index()
	{
            
	  $this->template->enable_parser(true);
	  $this->template->set_layout('calculators.php');

      $this->getFields();
//	  $calcview = $this->load->view('calc', '',true);


	  $this->template
          ->set('fields',$this->getFields())
          ->build('calc')

		 ;

    }
// --------------------------------------------------------------------
    function getFields()
    {

        $stream_slug = 'leads_energy';
        $namespace = 'streams';
 
            $assignments = $this->streams->streams->get_assignments($stream_slug, $namespace);

            
            return $assignments;
    }


// --------------------------------------------------------------------

}