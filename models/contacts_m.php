<?php
  /**
   * extranet mod_contacts Class
   *
   * Description: model handels contacts
   *
   * @package		camindu
   * @subpackage	Models
   * @category		Models
   * @author		Tobias Koch tobias@mmsetc.de
   */

class contacts_m extends MY_Model 
{
   protected $_table;

   function __construct()
   {
	  parent::__construct();

	  $this->_table = 'eb_contacts';


   }
   


   // --------------------------------------------------------------------
   /**
	* insert update contactcs
	* 
	* @access 	public	
	* @param  	array	
	* @param 	string	
	* @return 	integer	
	*/

   public function insert_update($_data, $_table = 'eb_contacts')
   {


	  $id = '';

	  if(isset($_data['id']))
		 {
			$id = $_data['id'];
			unset($_data['id']);
			$this->db->where('id', $id);

		 }


	  if($id == '')
		 {

			$this->db->insert($_table,$_data);

			return $this->db->insert_id();
		 }
	  else
		 {
			$this->db->update($_table, $_data);

			return $id;
		 }

   }



   // --------------------------------------------------------------------
   /**
	* get all data depending to contact
	* 
	* @access 	public	
	* @param  	integer	
	* @return 	array	
	*/
   public function get_contact_details($_contacts_id = '')
   {

	  if($_contacts_id != '')
		 {
			$this->db->where('eb_contacts.id',$_contacts_id);
		 }
	  $this->db->select('eb_contacts.*,
						 eb_companies.id AS comp_id, eb_companies.name AS comp_name, eb_companies.name_2 comp_name_2, eb_companies.tel AS comp_tel, eb_companies.fax AS comp_fax, eb_companies.email AS comp_email, eb_companies.homepage AS comp_homepage
						 ');

	  $this->db->join('eb_companies','eb_contacts.id = eb_companies.contacts_id', 'LEFT');


	  $this->db->from('eb_contacts');

	  $query = $this->db->get();
	  $result = $query->result_array();


	  
	  if(count($result) == 1)
		 {
			$retVal = $result[0];

		 }
	  else
		 {
			
			$retVal =  $this->empty_query_fields($this->db->last_query());
			$retVal['follow_up'] = ' ';
		 }

	  $folowUp_from_cal = $this->get_curr_followup($_contacts_id);
	  if(is_array($folowUp_from_cal))
		 {
			$retVal['follow_up'] = $folowUp_from_cal['StartTime'];
		 }

 	  // adressen
	  $retVal['addresses'] = $this->get_all_by_table('eb_addresses', array('contacts_id' => $_contacts_id));

 	  // personen
	  $retVal['persons'] = $this->get_all_by_table('eb_persons', array('contacts_id' => $_contacts_id));

	  
	  return $retVal;
   }

   // --------------------------------------------------------------------
   /**
	* get addresses
	* 
	*/
   private function get_all_by_table($_tname, $_where = array())
   {
	  $this->db->select('*');
	  $this->db->from($_tname);
	  $this->db->where($_where);

	  $query = $this->db->get();
	  $result = $query->result_array();


	  if(count($result) > 0)
		 {
			return $result;

		 }
	  else
		 {
			$result['0'] = $this->empty_query_fields($this->db->last_query());

			return $result;
		 }

   }
   // --------------------------------------------------------------------
   /**
	* get all data depending to contact
	* 
	* @access 	public	
	* @param  	integer	
	* @return 	array	
	*/

   /*
	public function _get_contact_details($_contacts_id = '')
	{

	if($_contacts_id != '')
	{
	$this->db->where('contacts.id',$_contacts_id);
	}
	$this->db->select('contacts.*,
	companies.id AS comp_id, companies.name AS comp_name, companies.name_2 comp_name_2, companies.tel AS comp_tel, companies.fax AS comp_fax, companies.email AS comp_email, companies.homepage,
	addresses.id AS addr_id, addresses.str, addresses.no, addresses.plz, addresses.city,
	persons.id AS persons_id, persons.sex, persons.name, persons.firstname, persons.name_phonetic, persons.birthday
	');

	$this->db->join('companies','contacts.id = companies.contacts_id', 'LEFT');
	$this->db->join('persons','contacts.id = persons.contacts_id', 'LEFT');
	$this->db->join('addresses','contacts.id = addresses.contacts_id', 'LEFT');

	$this->db->from('contacts');




	$query = $this->db->get();
	$result = $query->result_array();
	if(count($result) == 1 && $_contacts_id > 0)
	{

	return $result[0];

	}
	  
	if(count($result) > 1 && $_contacts_id > 0)
	{
	return $result;
	}


	return	  $this->empty_query_fields($this->db->last_query());
	}
   */ 

   // --------------------------------------------------------------------
   /**
	* scheisst array mit leer belegtne feldern zurück 
	* zur vorbelegung von input feldern falls noch kein eintrag existiert 
	*
	* @param 	string	
	* @return 	array	 
	*/
   function empty_query_fields($_query)
   {

	  $query = $this->db->query($_query);
	  $retVal = array();

	  foreach ($query->list_fields() as $field)
		 {
			$retVal[$field] = '';
		 } 

	  return $retVal;

   }

   // --------------------------------------------------------------------
   /**
	* get all persons for grid view 
	* 
	*/
   function get_persons($_user_id = '')
   {

	  $this->db->select('eb_contacts.*,eb_persons.*, eb_addresses.city, eb_addresses.plz, eb_companies.name as comp_name');
	  $this->db->join('eb_contacts', 'eb_persons.contacts_id = eb_contacts.id');
	  $this->db->join('eb_companies', 'eb_contacts.id = eb_companies.contacts_id','LEFT');
	  $this->db->join('eb_addresses', 'eb_contacts.id = eb_addresses.contacts_id','LEFT');

	  $this->db->from('eb_persons');
	  $this->db->where('eb_contacts.deleted',0);

	  $query = $this->db->get();

	  $result = $query->result_array();

	  if(count($result) != 0)
		 {
			return $result;
		 }
	  else
		 {
			return array($this->empty_query_fields($this->db->last_query()));

		 }

   }
   // --------------------------------------------------------------------
   /**
	* add where condition 
	* 
	* @param 	array	
	*/   
   public function add_where($_cond)
   {
	  $this->db->where($_cond);
   }
   // --------------------------------------------------------------------
   /**
	* flag contact as deleted 
	* 
	*/
   function set_contact_deleted($_id)
   {
	  $this->db->where('id', $_id);
	  $this->db->update('eb_contacts', array('deleted'=>1));

   }

   // --------------------------------------------------------------------
   function get_curr_followup($contact_id)
   {
	  $this->db->select('*');
	  $this->db->from('eb_jqcalendar');
	  $this->db->where('contacts_id',$contact_id);
	  $this->db->where('StartTime > ',date('Y-m-d H:i:s',time()));

	  $query = $this->db->get();
	  $result = $query->result_array();


	  if(count($result) == 1)
		 {
			return $result[0];
		 }
	  else
		 {
			return FALSE;
		 }
   }
   // --------------------------------------------------------------------
   /**
	* setter for table
	* 
	*/
   public function set_table($_table_name)
   {
	  $this->_table = $_table_name;
   } 

   // --------------------------------------------------------------------
   
}

/* End of file mod_contacts.php */
/* Location: ./application/models/mod_contacts.php */
