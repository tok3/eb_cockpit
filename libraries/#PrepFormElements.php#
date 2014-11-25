<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 *
 *
 * @category	Libraries
 * @author		tobias.koch@yalwa.com	
 */

class PrepFormElements {

   private $datepickerDefaultClass = 'datepicker';

   /**
	* Constructor
	*/
   public function __construct($config = array())
   {
	  $this->CI =& get_instance();
   }

   // --------------------------------------------------------------------
   function prep($_result, $_config = array(),$_tblPreFX = '')
   {
	  if($_config == '')
		 {
			$_config = array(); 
		 }

	  $fieldConf = $this->prepElements($_result,$_config,$_tblPreFX);
	  
	  
	  return $this->genElements($fieldConf);

   }

   // --------------------------------------------------------------------
   /**
	* Function prepares elements configuration depending on element type 
	*
	* @access	private
	* @param	array 	result_array from database
	* @param	array	configurarion when resulat_array is $result['0']['name'] config hast to be like $config['0']['name']['type'] = 'input'
	* @param	string	used to set a table prefix for the name to receive all postfields in an array eg. user[id] user[name] and so on. It can also be set per element in the config array: $config['0']['name']['table'] = 'user'
	* @return	array	element configuration array used by form_* functions     
	*/	   

   private function prepElements($_result, $_config, $_tblPreFX)
   {
	   
	  foreach($_result as $key => $item)
		 {
			// set standard type
			if(!isset($_config[$key]['type']))
			   {
				  $_config[$key]['type'] = 'text'; 
			   }

			// --------------------------------------------------------------------
			// Set standard Input name = apply Database Column name   

			if(!isset($_config[$key]['name'])) 
			   {

				  $_config[$key]['name'] = $key; 

				  if($_tblPreFX != "" && !isset($_config[$key]['tablename']))
					 {
						$_config[$key]['name'] = $_tblPreFX.'['.$key.']';
					 }
				  if(isset($_config[$key]['tablename']) && strlen($_config[$key]['tablename']) > 0)
					 {
						$_config[$key]['name'] = $_config[$key]['tablename'].'['.$key.']';
					 }
			   }
			else
			   {
				  if($_tblPreFX != "" && !isset($_config[$key]['tablename']))
					 {
						$_config[$key]['name'] = $_tblPreFX.'['. $_config[$key]['name'].']';
					 }
			   }
			// --------------------------------------------------------------------
			// set standard id
			if(!isset($_config[$key]['id'])) 
			   {
				  $_config[$key]['id'] = $key; 
			   }
			// --------------------------------------------------------------------
			// empty class if its not setted
			if(!isset($_config[$key]['class'])) 
			   {
				  $_config[$key]['class'] = ''; 
			   }
			// --------------------------------------------------------------------
			// set value

			$_config[$key]['value'] = $item;

			// --------------------------------------------------------------------
			// dropdown
			if($_config[$key]['type'] == 'dropdown')
			   {
				  
				  $extra = '';
				  if(isset($_config[$key]['id']) && $_config[$key]['id'] != '')
					 {
						$extra .= 'id = "'.$_config[$key]['id'].'" ';
					 }				  
				  if(isset($_config[$key]['class']) && $_config[$key]['class'] != '')
					 {
						$extra .= 'class = "'.$_config[$key]['class'].'" ';
					 }				  
				  if(isset($_config[$key]['js']) && $_config[$key]['js'] != '')
					 {
						$extra .= $_config[$key]['js'];
					 }				  

				  $_config[$key]['extra'] = trim($extra);

				  // set as label in case the dropdown is marked as disabled
				  if(isset($_config[$key]['disabled']) && $_config[$key]['disabled'] == 'disabled')
					 {
						$_config[$key]['type'] = 'label';
						$_config[$key]['value'] = $_config[$key]['options'][$_config[$key]['value']];
					 }

			   }
			// --------------------------------------------------------------------
			// label
			if($_config[$key]['type'] == 'label')
			   {

			   }
			// --------------------------------------------------------------------
			// checkbox
			if($_config[$key]['type'] == 'checkbox')
			   {
				  $_config[$key]['value'] = 1;
				  
				  if(!isset($_config[$key]['checked']) || $_config[$key]['checked'] == FALSE)
					 {
						$_config[$key]['checked'] = FALSE;
					 }
				  else
					 {
						$_config[$key]['checked'] = TRUE;
					 }
				  
			   }

		 }

	  return $_config;
   }

   // --------------------------------------------------------------------
   /**
	* Function generates form elements
	*
	*/	
   private function genElements($_properties)
   {
	  
	  $retVal = array();	   

	  foreach($_properties as $key => $item)
		 {
			// --------------------------------------------------------------------
			//input
			if($_properties[$key]['type'] == 'input' || $_properties[$key]['type'] == 'text')
			   {
				  $_properties[$key]['type'] == 'text';
				  $retVal[$key] = form_input($_properties[$key]);
			   }

			// --------------------------------------------------------------------
			//password
			if($_properties[$key]['type'] == 'password')
			   {
				  $retVal[$key] = form_password($_properties[$key]);
			   }
				
			// --------------------------------------------------------------------
			//textarea
			if($_properties[$key]['type'] == 'textarea')
			   {
				  $config = $_properties[$key];

				  unset($config['type']);
				  $retVal[$key] = form_textarea($config);
				  
			   }

			// --------------------------------------------------------------------
			//date
			if($_properties[$key]['type'] == 'date')
			   {
				  $_properties[$key]['type'] = 'text';

				  if(isset($_properties[$key]['class']) && $_properties[$key]['class'] != '' )
					 {
						$_properties[$key]['class'] .= ' '.$this->datepickerDefaultClass;
					 }
				  else
					 {
						$_properties[$key]['class'] = $this->datepickerDefaultClass;

					 }
				  $retVal[$key] = '<span>'.form_input($_properties[$key]).'</span>';
			   }

			// --------------------------------------------------------------------
			//hidden
			if($_properties[$key]['type'] == 'hidden')
			   {
				  $retVal[$key] = form_hidden($_properties[$key]['name'],$_properties[$key]['value']);
			   }

			// --------------------------------------------------------------------
			//dropdown
			if($_properties[$key]['type'] == 'dropdown')
			   {
				  $retVal[$key] = form_dropdown($_properties[$key]['name'],$_properties[$key]['options'],$_properties[$key]['value'],$_properties[$key]['extra']);
			   }

			// --------------------------------------------------------------------
			//label
			if($_properties[$key]['type'] == 'label')
			   {

				  $labelProperties = $_properties;
				  unset($labelProperties[$key]['value']);
				  unset($labelProperties[$key]['type']);
				  unset($labelProperties[$key]['name']); 
				  $retVal[$key] = form_label($_properties[$key]['value'],$_properties[$key]['id'],$_properties[$key] );
			   }
			// --------------------------------------------------------------------
			//checkbox
			if($_properties[$key]['type'] == 'checkbox')
			   {

				  $retVal[$key] = form_checkbox($_properties[$key]);

			   }

			// --------------------------------------------------------------------
			//span useful for only displaying certain value
			if($_properties[$key]['type'] == 'span')
			   {

				  $style = ''; 
				  if(isset($_properties[$key]['style']))
					 {
						$style = ' '.$_properties[$key]['style'];
					 }

				  $retVal[$key] = '<span id="'.$_properties[$key]['id'].'" class="'.$_properties[$key]['class'].'"'.$style.'>'.$_properties[$key]['value'].'</span>';
			   }
			// --------------------------------------------------------------------
			//div useful for only displaying certain value
			if($_properties[$key]['type'] == 'div')
			   {
				  $retVal[$key] = '<div id="'.$_properties[$key]['id'].'" class="'.$_properties[$key]['class'].'">'.$_properties[$key]['value'].'</div>';
			   }

		 }

	  return $retVal;
   }

   // --------------------------------------------------------------------
   /**
	* This function formats database result_array to an option array for form_dropdown 
	*
	* In case there are only two values in array, the first will be send value and the second will be displayed in dropdown
	*  
	* @param	array	result_array() from database 
	* @param	string	array key that contains the dropdown send value     
	* @param	string	array key that contains value which is displayed in dropdown     
	*/

   function formatDropdownOptions($_res, $_sendValueKey = FALSE, $_displayKey = FALSE)
   {
	  $resArr = $_res;
	  if(is_object($_res['0']))
		 {
			foreach($_res as $key => $object)
			   {
				  $resArr[$key] = (array)$object;;
			   }
		 }
	  
	  $sendValue = $_sendValueKey;
	  $displayValue = $_displayKey;

	  if($_sendValueKey === FALSE && $_displayKey === FALSE)
		 {
			if(count($resArr[0] == 2))
			   {
				  $keys =  array_keys($resArr[0]);
				  $sendValue = $keys[0];
				  $displayValue = $keys[1];
			   }
		 }	

	  // --------------------------------------------------------------------
	  
	  $dropdownOptions = array();
	  foreach($resArr as $value)
		 {
			$dropdownOptions[$value[$sendValue]] = $value[$displayValue]; 
		 }
	  
	  
	  return($dropdownOptions);
	  
   }

   // --------------------------------------------------------------------
   /**
	* This function generates dropdown option array from database	 
	*
	* @param	string	table from the options will fetched
	* @param	string	values that are sent by dropdown
	* @param	string	values that are displayed in dropdown 
	* @param	array	condition e.g. $cond['lang'] = EN. Multiple conditions will be linked by AND
	* @param	string  first entry in dropdown e.g. 'please select'
	* @return 	array	option array which can be used by form_dropdown
	*/

   function getDropOpt($_table,$_sendVal,$_displVal,$_cond = '',$_firstEntry = '',$_order_by = '')
   {

	  $this->CI->db->select($_sendVal.','.$_displVal,FALSE);
	  $this->CI->db->from($_table);

	  if(is_array($_cond))
		 {
			foreach($_cond as $key => $item)
			   {
				  $this->CI->db->where($key,$item);
			   }
		 }

	  if(is_array($_order_by))
		 {
			foreach($_order_by as $key => $item)
			   {
				  $this->CI->db->order_by($key,$item);
			   }
		 }

	  $query = $this->CI->db->get();
	  $result = $query->result();

	  $retVal = array();
	  if($_firstEntry != '')
		 {
			$retVal = array($_firstEntry);
			
		 }

	  if(stristr($_displVal,'AS')) // special case if values are concatenated
		 {
			$start = strpos($_displVal,'AS');
			$_displVal = substr($_displVal,$start + 3);
		 }
	  foreach($result as $key => $item)
		 {
		   
			$retVal[$result[$key]->$_sendVal] =  $result[$key]->$_displVal;
		 }
	  return $retVal;
   }

   // --------------------------------------------------------------------
   /**
	* This function prepares array used as first argument in $this->prep 
	* to initialize empty inputs from database table field information 	 
	*
	* @access	public
	* @param	string	tablename 
	* @param	array	preset values array_key must match table fieldname value is will be set 
	* @param	string	name used as array key prefix. it is useful if equal named vars already exists in a view file 
	* @return 	array	to fill in $this->prep as first param
	*/
   public function prepInit($_table, $_presetVal = '', $_keyPreFx = '')
   {

	  $field_info = $this->CI->db->list_fields($_table);	

	  foreach($field_info as $value)
		 {
			$initArr[$_keyPreFx.$value] = '';
			if(isset($_presetVal[$value]))
			   {
				  $initArr[$_keyPreFx.$value] = $_presetVal[$value];
			   }
		 }

	  return $initArr;
   }

   // --------------------------------------------------------------------
   /**
	* seter method for $this->datepickerDefaultClass
	*
	* @access	public
	* @param 	string	class for datepicker
	*/

   public function setDateclass($_newDefClass)
   {
	  $this->datepickerDefaultClass = $_newDefClass;
   }
   // --------------------------------------------------------------------
   /**
	* function gets default config array for all fields
	*
	* @access 	public	
	* @param 	string	database that relates to the fields
	* @param 	string	default css class
	* @param 	string	default html entity
	* @return 	array	confit to fill in $this->prep()
	*/
   function lazyDefConf($_db_table, $_defaultEntity, $_defaultClass = '')
   {

	  $field_info = $this->CI->db->list_fields($_db_table);

	  // set default config, all information display only
	  foreach($field_info as $key => $field)
		 {
			$conf[$field]['type'] = $_defaultEntity;
			$conf[$field]['class'] = $_defaultClass;
		 }

	  return $conf;
   }

   // --------------------------------------------------------------------
   /**
	* function returns array with enum values to use in form_dropdown as options array
	*
	* @access 	public	
	* @param 	string	tablename
	* @param 	string	fieldname
	* @return 	array	
	*/
   public function getEnumOptions($table , $field )
   {
	  $query = "SHOW COLUMNS FROM ".$table." LIKE '$field'";
	  $row = $this->CI->db->query("SHOW COLUMNS FROM ".$table." LIKE '$field'")->row()->Type;
	  $regex = "/'(.*?)'/";

	  preg_match_all( $regex , $row, $enum_array );

	  $enum_fields = $enum_array[1];

	  foreach ($enum_fields as $key=>$value)
		 {
            $enums[$value] = $value; 
		 }

	  return $enums;
   }     

   // --------------------------------------------------------------------
   
}


/* End of file prepFormElements.php */
/* Location: ./application/libraries/prepFormElements.php */
