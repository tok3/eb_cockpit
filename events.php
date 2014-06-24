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
    
   public function __construct()
   {
	  $this->ci =& get_instance();
	  $this->ci->load->model('files/file_folders_m');
	  $this->ci->load->add_package_path("addons/shared_addons/modules/cockpit");
	  $this->users_carrier = $this->ci->load->model('contacts_m');

	  //register the public_controller event
	  Events::register('public_controller', array($this, 'run'));

	  Events::register('post_user_login', array($this, 'set_contact_id'));


	  Events::register('set_contact_id', array($this, 'set_contact_id'));


   }
    
   public function run()
   {
	  
	  if(!$this->ci->session->userdata('redirect_to'))
		 {
			$this->ci->session->set_userdata('redirect_to','cockpit/');
		 }

	  $this->usercheck();

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

$data = $this->ci->current_user ? $this->ci->current_user : $this->ci->ion_auth->get_user();

	  // kontakt id in session speichern	  
	  $contact =  $this->ci->contacts_m->get_by('users_id',$data->user_id);

	  if(isset($contact->id))
		 {

	  $initContact = explode(' ',$contact->initial_contact);
	  $contact->init_date = $initContact[0];
	  $contact->init_time = $initContact[1];



	  $this->ci->session->set_userdata('contact_data', $contact);

	  $this->ci->session->set_userdata('contact_id', $contact->id);

		 }
   }
   // --------------------------------------------------------------------
   /**
	* check ob user eingeloggt ist ansonsten auf login form 
	* 
	*/
   public function usercheck()
   {


	  if ((!isset($this->ci->current_user->id)) && ($this->ci->uri->segment(1) == 'cockpit'))
		 {
			redirect('users/login');
			return FALSE;
		 }



   }

}
/* End of file events.php */