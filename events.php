<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sample Events Class
 * 
 * @package        PyroCMS
 * @subpackage    Sample Module
 * @category    events
 * @author        Jerel Unruh - PyroCMS Dev Team
 * @website        http://unruhdesigns.com
 */
class Events_Cockpit {
    
    protected $ci;
    private $cookie_lifetime;
 
    public function __construct()
    {
        $this->ci =& get_instance();

        $this->cookie_liefetime = (3600*24) * 90; // 90 tagae 

        $this->ci->load->model('files/file_folders_m');
        $this->ci->load->add_package_path("addons/shared_addons/modules/cockpit");
	  
        $this->ci->load->model('contacts_m');
        $this->ci->load->library('ev_user');


        //register the public_controller event
        Events::register('ev_user', array($this, 'test'));

        Events::register('public_controller', array($this, 'run'));

        Events::register('post_user_login', array($this, 'set_contact_id'));

        Events::register('set_contact_id', array($this, 'set_contact_id'));

        Events::register('post_user_activation', array($this, 'init_contact'));
	  



    }

    // --------------------------------------------------------------------
   
    public function run()
    {

        if(!$this->ci->session->userdata('redirect_to'))
        {
			$this->ci->session->set_userdata('redirect_to','cockpit/');
        }

        $this->usercheck();

        $this->set_affilite_id(); // affiliate id setzen wenn als get param übergeben

        //$this->init_contact();
    /*
      $this->ci->load->library('navigation');
      $this->ci->load->config('navigation');
      $sidenav = new $this->ci->navigation();        
      $sidenav->set($this->ci->config->item('nav_sidebar'));
      $this->ci->session->set_userdata('sidenav',$sidenav->get_entries());
    */
    }
    // --------------------------------------------------------------------
    // startseite setzen welche nach login angezeigt wird	
    public function cp_startpage()
    {
        //redirect('cockpit/contact_details/contact/');
        Events::trigger('set_contact_id');
        //	  redirect('cockpit/');

    }
    // --------------------------------------------------------------------
    /**
     * kontact id in session speichern
     * 
     */
    public function set_contact_id()
    {

        $this->ci->ev_user->set_contact_id();


    }
    // --------------------------------------------------------------------
    /**
     * kontact initiieren und profildaten in cockpit übernehmen
     * 
     */
    public function init_contact($_id)
    {


        $usrInf = $this->ci->ion_auth->get_user($_id);

        $contacts_data['follow_up'] = date('Y-m-d', time() + 86400); 
        $contacts_data['typ'] = 0; 
        $contacts_data['memo'] = ''; 
        $contacts_data['deleted'] = 0; 
        $contacts_data['users_id'] = $usrInf->id; 

        $contacts_data['typ'] = 1; 

        if($usrInf->group_id == 3)
        {
		$contacts_data['is_affiliate'] = 1; 
        $contacts_data['typ'] = 2; 
        }
            
        
        if(isset($_COOKIE['ihre_energieberater_af_id']))
        {

			$contacts_data['affiliate_id'] = $_COOKIE['ihre_energieberater_af_id']; 
			setcookie ("ihre_energieberater_af_id", "", time() - ($this->cookie_liefetime + 3600));
            unset($_COOKIE['ihre_energieberater_af_id']);
        }

	  
        $contacts_id = $this->ci->contacts_m->insert_update($contacts_data, 'eb_contacts');


        
        $addr_data['contacts_id'] = $contacts_id;
        $addr_data['str'] = $usrInf->strasse;
        $addr_data['no'] = $usrInf->haus_nr;
        $addr_data['plz'] = str_pad($usrInf->plz,5,0,STR_PAD_LEFT);
        $addr_data['city'] = $usrInf->ort;
        $this->ci->contacts_m->insert_update($addr_data, 'eb_addresses');



        $personal_data['contacts_id'] = $contacts_id;
        $personal_data['name'] = $usrInf->last_name;
        $personal_data['firstname'] = $usrInf->first_name;
        $personal_data['tel'] = $usrInf->telefon;
        $personal_data['email'] = $usrInf->email;
        $personal_data['name_phonetic'] = '';
        $personal_data['fax'] = '';
        $personal_data['mobile'] = '';

        $this->ci->contacts_m->insert_update($personal_data, 'eb_persons');

        
    }
    // --------------------------------------------------------------------
    /**
     * check ob user eingeloggt ist ansonsten auf login form 
     * 
     */
    public function usercheck()
    {

        // is_logged_in(); @todo eigentlich besser 

        if(($this->ci->uri->segment(3) == 'register') || ($this->ci->uri->segment(2) == 'calc')) // usercheck auf affilliate/register nicht durchführen
        {
			return FALSE;
        }

        if ((!isset($this->ci->current_user->id)) && ($this->ci->uri->segment(1) == 'cockpit'))
        {
			redirect('users/login');
			return FALSE;
        }

    }

    // --------------------------------------------------------------------
    /**
     * affiliate id setzten wenn get mitgegeben wird  
     * 
     */
    public function set_affilite_id()
    {
        //echo "events/set_affilite_id()";

        if(isset($_GET['afid']) && !isset($_COOKIE['ihre_energieberater_af_id']))
        {
            setcookie("ihre_energieberater_af_id",$_GET['afid'],time() + $this->cookie_liefetime );
        }

/*
        if(isset($_GET['banner']))
        {
$banner = file_get_contents('assets/banner/Baecker-EB_Banner_breit.gif');
header('Content-type: image/gif'); //Set the content type to image/jpg
echo $banner;
        }
*/
    }

}
/* End of file events.php */