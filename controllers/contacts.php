<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Public Journal module controller
 *
 * @author  tobias@mmsetc.de
 * @package energieberaer
 */
class Contacts extends Public_Controller
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
	  $this->load->library('form_validation');

	  $this->validation_rules = array();

   }
   /**
	* Index
	*/
   public function index()
   {


	  $this->template
		 ->set_partial('header','header',array())
		 ->set_partial('aside','sidebar',array())
		 ->set('active_kontakt','active')
		 ->append_js('module::contacts_grid.js') 
		 ->append_js('module::modules.js')
		 ->set('content', $this->get_contacts_grid())
		 ->build('default')
		 ;



   }

   // --------------------------------------------------------------------
   /**
	* contact grid generieren
	* 
	* @access 		
	* @param 		
	* @return 		
	* 
	*/
   function get_contacts_grid()
   {

	  // --------------------------------------------------------------------
	  $contacts = $this->contacts_m->get_persons();

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

			$tableData[$key]['user'] = $mitarbeiter;
			$tableData[$key]['initial_contact'] = date('d.m.Y',human_to_unix($item['initial_contact']));
			$tableData[$key]['vorname'] = $item['firstname'];
			$tableData[$key]['name'] = $item['name'];
			$tableData[$key]['plz'] = $item['plz'];
			$tableData[$key]['city'] = $item['city'];
			$tableData[$key]['comp_name'] = $item['comp_name'];
			$tableData[$key]['tel'] = '<span data-usage="tel">' . $item['tel']. '</span>' ; // usage wird per jquery.each sesetzt !!
			$tableData[$key]['mobile'] = '<span data-usage="cellphone">' . $item['mobile'] .'</span>';// usage wird per jquery.each sesetzt !!


			$tableData[$key]['id'] = '<span class="editDelBtn"><a href="' . site_url('cockpit/contacts/delete/' .$item['contacts_id']) . '" class="gridDelete right hide-for-touch"><span title="L&ouml;schen" class="fa fa-trash-o"></span></a>&nbsp;<a href="' . site_url('cockpit/contact_details/contact/' .$item['contacts_id']) . '" class="gridEdit right"><span title="Bearbeiten" class="fa fa-edit"></span></a></span>';

		 }

	  $tmpl = array ( 'table_open'  => '<table id="personsGrid"  class="display table table-bordered table-hover dataTable">');


	  $this->table->set_template($tmpl); 

	  $this->table->set_heading(lang('cockpit:heading_grid_contacts'));


	  $grid = $this->table->generate($tableData);

	  return $grid;
   }


   // --------------------------------------------------------------------
   
   function testvalidation()
   {


	  $validation_rules = array(
								array(
									  'field'   => 'data[0][name]',
									  'label'   => 'Name',
									  'rules'   => 'required'
									  )
								);

	  $this->form_validation->set_rules($validation_rules);


	  $errors = '';
	  if($this->input->post('submit') !=  '')
		 {
			if ($this->form_validation->run() != 1)
			   {
				  echo "validation geht nicht durch<br>";

				  $errors = '<div class="medium-12 small-12 columns"><div class="alert-box secondary radius" data-alert="">
				' . validation_errors() .'
				</div></div>';
			   }
		 }

	  $form = $this->load->view('valTest',array('errors'=>$errors),TRUE);
	  $this->template
		 ->set_partial('aside','sidebar',array())
		 ->append_js('module::modules.js')
		 ->set('content',$form)
		 ->append_js('module::contacts.js') 
		 ->build('default',false)
		 ;


   }
   // --------------------------------------------------------------------
}