<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Public  controller
 *
 * @author  tobias@mmsetc.de
 * @package energieberaer
 */
class Info extends Public_Controller
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


        $this->lang->load('cockpit');

        $contacts_m = $this->load->model('contacts_m');	   
        $immo_m = $this->load->model('immo_m');	   

        $this->validation_rules = array();
        $this->formFields = $this->load->library('form_inputs');

    }

    // --------------------------------------------------------------------
    
    public function contact($_contacts_id = 0)
    {
$contacts_id =  $this->format->dec_arr_key($_contacts_id, 'contacts_id');

	  $immoInfo = $this->get_immo_info($contacts_id);


      $info = $immoInfo;
      
        $this->template
            ->set_partial('header','header',array())
            ->set_partial('aside','sidebar',array())
            ->set('active_kontakt','active')
            ->append_js('module::contacts_grid.js') 
            ->append_js('module::modules.js')
            ->set('content', $info)
            ->build('default')
            ;


    }
// --------------------------------------------------------------------
/**
* information über immobilie von geworbenem kunde anzeigen
* 
* @access 	private	
* @param 	integer	contact_id von geworbendem kunde
* @return 	str	
* 
*/
private function get_immo_info($_contacts_id)
{
    $immo_data = $this->immo_m->get_info($_contacts_id);

    if(!isset($immo_data[0]))
    {
        redirect('cockpit/contacts/by_aff'); // temp falls kontakt nicht mehr in immobilien tabelle existiert 
    }

    $data = (array) $immo_data[0];

    $provTotal = (int) ($data['aussenprovision'] + $data['innenprovision']) / 100;
    $data['ges_provision'] = ($data['est_preis'] * $provTotal) * 0.50; // gesamtprovision 

    return     $this->load->view('affiliate/immo_info', $data,true);
}


    
// --------------------------------------------------------------------
    
}