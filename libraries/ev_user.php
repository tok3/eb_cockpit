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
            return $contact->id;
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
   /**
   * profildaten in cockpit übertragen
   * 
   * @access 	public	
   * @param     contact_id		
   * @return 		
   * 
   */
    public function transfer_profile_data($_userdata)
    {
/*
        $userdata = $_userdata;
        $contact_id = $userdata['contacts_id'];

        if($contact_id != '')
        {
            $dtails = $this->ci->contacts_m->get_contact_details($contact_id);

            // ids von erstem datensatz falls schon vorhanden
            $personal_data['id'] = $dtails['persons'][0]['id'];
            $addr_data['id'] = $dtails['addresses'][0]['id'];
            $contacts_data['id'] = $contact_id;
        }
        else
        {
            die('contact id missing ev_user : 101');
        }

    if($userdata['group_id'] == 3)
        {
            $contacts_data['typ'] = 2;
            $this->ci->contacts_m->insert_update($contacts_data, 'eb_contacts');

        }

        $addr_data['contacts_id'] = $contact_id;
        $addr_data['str'] = $userdata['strasse'];
        $addr_data['no'] = $userdata['haus_nr'];
        $addr_data['plz'] = str_pad($userdata['plz'],5,0,STR_PAD_LEFT);
        $addr_data['city'] = $userdata['ort'];
        $this->ci->contacts_m->insert_update($addr_data, 'eb_addresses');



        $personal_data['contacts_id'] = $contact_id;
        $personal_data['name'] = $userdata['last_name'];
        $personal_data['firstname'] = $userdata['first_name'];
        $personal_data['tel'] = $userdata['telefon'];
        $personal_data['email'] = $userdata['email'];
        $personal_data['name_phonetic'] = '';
        $personal_data['fax'] = '';
        $personal_data['mobile'] = '';

        $this->ci->contacts_m->insert_update($personal_data, 'eb_persons');

*/
//    die;
        // $addr_data['contacts_id'] = $contact_id;
        //                 $this->contacts_m->insert_update($addr_data, 'eb_addresses');
    }
// --------------------------------------------------------------------
}