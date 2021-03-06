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
    $this->load->helper('file');
	  $contacts_m = $this->load->model('contacts_m');	   
	  $this->load->library('form_validation');


   }
    /**
     * Index
     */
    public function index()
    {

        $this->banner();
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


    
    $content = $this->get_banners();

            $this->template
            ->set_partial('header','header',array())
            ->set_partial('aside','sidebar',array())
            ->set('active_kontakt','active')
            ->append_js('module::contacts_grid.js') 
            ->append_js('module::modules.js')
            ->set('content', $content)
            ->set('tab_navigation',$this->navigation->load('promo_tabs')->get_tabs())
            ->build('default')
            ;

}


        // --------------------------------------------------------------------
/**
* display banners for affiliate
* 
* @access 	public	
* @return 		
* 
*/
public function gewerbeenergie()
{

    
    $content = $this->get_calculators();

            $this->template
            ->set_partial('header','header',array())
            ->set_partial('aside','sidebar',array())
            ->set('active_kontakt','active')
            ->append_js('module::contacts_grid.js') 
            ->append_js('module::modules.js')
            ->set('content', $content)
            ->set('tab_navigation',$this->navigation->load('promo_tabs')->get_tabs())
            ->build('default')
            ;

}
// --------------------------------------------------------------------
/**
* affiliate stromrechner einbinden und eingindungcode darstellen
* 
* @access 	private	
* @param 	void	
* @return 	string	content tarifrechner
* 
*/
private function get_calculators()
{

    
$data['affiliate_id'] = $this->session->userdata('contact_id');

    return $this->load->view('promo/_strom_gas_rechner', $data, TRUE);

}
    
// --------------------------------------------------------------------
/**
* get available banners
* 
* @access 	private	
* @param 	void	
* @return 	string	bannerlisting
* 
*/
private function get_banners()
{


    $bannerPath = './assets/banner/';
    $data['affiliate_id'] = $this->session->userdata('contact_id');
        $filenames =  get_filenames($bannerPath);
        natsort($filenames);

        $_bstr = '';
        foreach($filenames as $key => $filename)
            {
                $data['f_inf'] = get_file_info($bannerPath . $filename);
                $data['f_img_inf'] = getimagesize($bannerPath . $filename);

                $data['get_name'] = basename($bannerPath . $filename, stristr($filename,'.'));

$_bstr .= $this->load->view('promo/_banner', $data, TRUE);

            }

        return $_bstr;
}
    

// --------------------------------------------------------------------
    
}