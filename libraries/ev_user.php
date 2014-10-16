<?php
if( !defined('BASEPATH'))
   exit('No direct script access allowed');

// ------------------------------------------------------------------------
/**
 *
 *
 *
 * @category	Libraries
 * @author		tobias.koch@mmstc.de.com
 */

class ev_user
{
   protected $ci;

   function __construct()
   {
	  $this->ci = &get_instance();
   }



   // --------------------------------------------------------------------
   /**
	* contact id des angemeldeten benutzers in session speichern
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

			$this->check_complete($contact->id);
		 }
   }


   // --------------------------------------------------------------------
   /**
	* check ob kontaktdaten komplett sind, also adresse und person hinterlegt sind
	* 
	* @access 	private	
	* @param 	viod	
	* @return 	void	
	* 
	*/
   public function check_complete($_contacts_id)
   {

	  $COMPLETE = 0;


	  $addr = new $this->ci->contacts_m();
	  $addr->set_table('eb_addresses');
	  $addrData = $addr->get_by('contacts_id',$_contacts_id);

	  $persons = new $this->ci->contacts_m();
	  $persons->set_table('eb_persons');
	  $personsData = $persons->get_by('contacts_id',$_contacts_id);
  
	  $isComplete = count($addrData) +  count($personsData);

	  if($isComplete >= 2)
		 {
			$COMPLETE = 1;
		 }


	  $this->ci->session->set_userdata('contact_complete', $COMPLETE);

   } 
   // --------------------------------------------------------------------
}