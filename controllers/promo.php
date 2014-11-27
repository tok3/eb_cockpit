<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Public Journal module controller
 *
 * @author  tobias@mmsetc.de
 * @package energieberaer
 */

class Promo extends Public_Controller
{

    
   public function __construct()
   {
       parent::__construct();
	  Asset::add_path('theme', site_url('addons/shared_addons/modules/cockpit').'/');

	  $this->template->enable_parser(true);
	  $this->template->set_layout('cockpit.php');
	  $this->template->append_css('module::form.css');
	  $this->template->append_css('module::jquery.datetimepicker.css');
	  $this->template->append_js('module::jquery.datetimepicker.js');
      $this->template->append_js('module::app.js');


	  $this->lang->load('cockpit');

	  $contacts_m = $this->load->model('contacts_m');	   
	  $this->load->library('form_validation');


   }
    /**
     * Index
     */
    public function index()
    {

    }


    // --------------------------------------------------------------------
/**
* display banners for affiliate
* 
* @access 	public	
* @return 		
* 
*/
public function banner()
{
    $data['affiliate_id'] = $this->session->userdata('contact_id');
            $content = $this->load->view('promo/banner', $data, TRUE);

            $this->template
            ->set_partial('header','header',array())
            ->set_partial('aside','sidebar',array())
            ->set('active_kontakt','active')
            ->append_js('module::contacts_grid.js') 
            ->append_js('module::modules.js')
            ->set('content', $content)
            ->build('default')
            ;

}
// --------------------------------------------------------------------
    
}