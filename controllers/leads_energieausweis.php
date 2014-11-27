<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Public Journal module controller
 *
 * @author  tobias@mmsetc.de
 * @package energieberaer
 */
class leads_energieausweis extends Public_Controller
{

   private $controller_name;
   public function __construct()
   {
	  parent::__construct();
	  Asset::add_path('theme', site_url('addons/shared_addons/modules/cockpit').'/');

	  $this->template->enable_parser(true);
	  $this->template->set_layout('cockpit.php');
	  $this->template->append_css('module::form.css');
	  $this->template->append_css('module::jquery.datetimepicker.css');
	  $this->template->append_js('module::jquery.datetimepicker.js');
	  $this->template->append_js('module::ea_leads.js');

	  $this->lang->load('cockpit');

	  $contacts_m = $this->load->model('contacts_m');	   
	  //	  $form_validation = $this->load->library('form_validation');

	  $this->validation_rules = array();
	  $this->formFields = $this->load->library('form_inputs');

	  $this->controller_name = $this->uri->rsegment(1);
   }

   // --------------------------------------------------------------------
   
   function index()
   {

	  $this->template
		 ->set_partial('header','header',array())
		 ->set_partial('aside','sidebar',array())
		 ->set('active_kontakt','active')
		 ->append_js('module::modules.js')
		 ->set('content', $this->get_leads_grid())
		 ->build('default')
		 ;



   }

   // --------------------------------------------------------------------
   /**
	* leads grid generieren // alle anfragen die im stream energieausweis landen
	* 
	* @access 		
	* @param 		
	* @return 		
	* 
	*/
   function get_leads_grid()
   {

	  // --------------------------------------------------------------------
	  $this->general_m->set_table('energieausweis');

	  $contacts = $this->general_m->get_many_by('approved', NULL);

	  $tableData = array();
	  foreach($contacts as $key => $item)
		 {
			
			$user = $this->ion_auth->get_user();

			if(is_object($user))
			   {
				  $mitarbeiter = $user->first_name . ' ' . $user->last_name;
			   }
			else
			   {
				  $mitarbeiter = 'n/a'; 
			   }

			$tableData[$key]['created'] = date('d.m.Y',human_to_unix($item->created));
 			$tableData[$key]['vorname'] = $item->vorname;
 			$tableData[$key]['name'] = $item->nachname;
 			$tableData[$key]['plz'] = $item->plz;
 			$tableData[$key]['ort'] = $item->ort;
 			$tableData[$key]['objekt_art'] = $item->objektart;
 			$tableData[$key]['objekt_ort'] = $item->objekt_ort;
 			$tableData[$key]['objekt_plz'] = $item->plz_objekt;

			$tableData[$key]['id'] = '<span class="editDelBtn"><a href="' . site_url('cockpit/' . $this->controller_name . '/delete/' .$item->id) . '" class="gridDelete right hide-for-touch"><span title="L&ouml;schen" class="fa fa-trash-o"></span></a>&nbsp;<a href="' . site_url('cockpit/' . $this->controller_name . '/details/' .$item->id) . '" class="gridEdit right"><span title="Bearbeiten" class="fa fa-edit"></span></a></span>';

		 }


	  $tmpl = array ( 'table_open'  => '<table id="leadsGrid"  class="display table table-bordered table-hover dataTable">');


	  $this->table->set_template($tmpl);

	  $this->table->set_heading(array( 'Datum', 'Vorname','Name','PLZ','Ort','Objekt Art','Objekt Ort','Objekt PLZ',''));


	  $grid = $this->table->generate($tableData);

	  return $grid;
   }


   // --------------------------------------------------------------------
   function details($_id)
   {

	  if($_POST){

		 
		 
		 if($this->uri->rsegment(4) == 'del')
			{
			   $this->delete($_id);
			   return false;
			}

		 $this->general_m->set_table('energieausweis');
		 $streamData = $this->general_m->get_many_by('id',$this->input->post('row_edit_id'));

		 // let us set stream entry as approved
		 $streamData[0]->approved = 1;
		 $this->general_m->update($_id,$streamData[0]); 

		 // --------------------------------------------------------------------
		 /**
		  * insert contacts
		  * 
		  */
		 $insData_contacts['typ'] = 1; // privat
		 $insData_contacts['memo'] = ''; // 
		 $insData_contacts['deleted'] = '0'; // 

		 $insData_contacts['initial_contact'] = $streamData[0]->created;
		 $insData_contacts['affiliate_id'] = $_POST['affiliate_id'] != '' ? $_POST['affiliate_id'] : 0;
		 $contact_insert_id = $this->contacts_m->insert_update($insData_contacts, 'eb_contacts');

		 // --------------------------------------------------------------------
		 /**
		  * insert persons
		  * 
		  */
		 $insData_persons['contacts_id'] = $contact_insert_id;

		 if($_POST['anrede'] == 'Herr')
			{
			   $insData_persons['sex'] = 'm';
			}
		 else
			{
			   $insData_persons['sex'] = 'f';
			}
		 $insData_persons['firstname'] = $_POST['vorname'];

		 $insData_persons['name'] = $_POST['nachname'];
		 $insData_persons['tel'] = $_POST['telefon'];
		 $insData_persons['email'] = $_POST['e_mail'];
		 $insData_persons['name_phonetic'] = '';
		 $insData_persons['birthday'] = '0000-00-00';
		 $insData_persons['fax'] = '';
		 $insData_persons['mobile'] = '';

		 $this->contacts_m->insert_update($insData_persons, 'eb_persons');

		 // --------------------------------------------------------------------
		 /**
		  * insert addresses
		  * 
		  */
		 $insData_addresses['contacts_id'] = $contact_insert_id;
		 $insData_addresses['str'] = $_POST['strasse'];
		 $insData_addresses['no'] = $_POST['nr'];
		 $insData_addresses['plz'] = $_POST['plz'];
		 $insData_addresses['city'] = $_POST['ort'];

		 $this->contacts_m->insert_update($insData_addresses, 'eb_addresses');

		 // --------------------------------------------------------------------
		 /**
		  * insert immobilien
		  * 
		  */

		 
		 $insertData_immo['contacts_id'] = $contact_insert_id;
		 $insertData_immo['stream_entry_id'] =  $_POST['row_edit_id'];
		 $insertData_immo['objektart'] =  array_search(htmlentities(utf8_decode($_POST['objektart'])), lang('cockpit:immo_art_option'));
		 $insertData_immo['bezugsfrei'] = $_POST['lieferung'];
		 $insertData_immo['str'] = $_POST['objekt_strasse'];
		 $insertData_immo['plz'] = $_POST['plz_objekt'];
		 $insertData_immo['ort'] = $_POST['objekt_ort'];
		 $insertData_immo['qm'] = $_POST['wohnflaeche'];
		 $insertData_immo['baujahr'] = $_POST['baujahr'];
		 $insertData_immo['verausserung_art'] = implode($_POST['verausserung_art'], ',');
		 $insertData_immo['bemerkung'] = $_POST['bemerkung']; 
		 $insertData_immo['aktionscode'] = $_POST['aktionscode']; 
		 $insertData_immo['page_slug'] = $_POST['page_slug']; 

		 $this->general_m->set_table('eb_immobilien');
		 $this->general_m->insert($insertData_immo);

// --------------------------------------------------------------------
		 // insert property
		 $this->general_m->set_table('eb_contact_properties');
		 $this->general_m->insert(array('contacts_id'=>$contact_insert_id,'property'=>'3')); // 3 = energeiausweis


		 // --------------------------------------------------------------------
		 // go to approved data 
		 if($this->uri->rsegment(4) == 'fwd') 
			{
			   redirect($this->router->fetch_module() . '/contact_details/contact/' . $contact_insert_id);

			}
		 // --------------------------------------------------------------------
		 // go to lead list to approve other lead 
		 if($this->uri->rsegment(4) == 'bck') 
			{
			   redirect($this->router->fetch_module() . '/' .$this->uri->rsegment(1));
			}



	  }
	  $data['id'] = $_id;
	  $params = array(
					  'stream'        => 'energieausweis',
					  'namespace'     => 'streams'
					  );
 
	  $entries = $this->streams->entries->get_entries($params);

	  $content = $this->load->view('energieausweis/lead_detail', $data, TRUE);
 


	  $this->template
		 ->set_partial('header','header',array())
		 ->set('content',$content)
		 ->set_partial('aside','sidebar','')
		 ->append_js('module::modules.js')
		 ->append_js('module::contacts.js') 
		 ->append_js('module::app.js') 
		 ->build('default');

   }


   // --------------------------------------------------------------------
   /**
	* flag contact as deleted
	* 
	* @param 	integer	
	* @return  	void	
	*/
   public function delete($_id)
   {
	  $this->load->driver('Streams');
	  $this->streams->entries->delete_entry($_id, 'energieausweis', 'streams');

	  redirect($this->router->fetch_module() . '/' .$this->uri->rsegment(1));
   }

// --------------------------------------------------------------------
   
function setcomp()
{
/*
	  $this->general_m->set_table('eb_companies');

	  $comp = $this->general_m->get_all();
	  echo "<pre><code>";
	  print_r($comp);
	  echo "</code></pre>";

	  $this->general_m->set_table('eb_contacts');
	  
	  foreach($comp as $key => $value)
		 {
echo $value->contacts_id;
					 $this->general_m->update($value->contacts_id,array('typ'=>2)); 

			}

*/
}
   // --------------------------------------------------------------------
   
}