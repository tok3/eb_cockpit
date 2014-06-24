<?php
if( !defined('BASEPATH'))
   exit('No direct script access allowed');

// ------------------------------------------------------------------------
/**
 * this library contains commonly used function for formating
 * text, currency dates and so on
 *
 *
 *
 * @category	Libraries
 * @author		tobias.koch@mmstc.de.com
 */

class form_inputs
{
   private $CI;
   public $fields;
   public $inline_errors = TRUE;
   private $form_inputs = array();
   public $validation_rules = array();
   public $sliceRetArr = 0; // elemente von return array entfernen bsp. wenn ret arr z.b. data[0][id] heisst und wert auf 1 ist, ist retArr array([0]array([id]=>'value' anstatt array([data]array([0]array([id]=>'value'
	
   function __construct() 
   {
	  $this->CI =& get_instance();
	  // load required libraries & helpers
	  $this->CI->load->library('form_validation');
	  $this->CI->load->helper(array('array','form','url'));

		
   }


   // --------------------------------------------------------------------
   /**
	* set rule for ci form validation given with config 
	* 
	*/   
   function rules()
   {

	  $this->CI->form_validation->set_rules($this->validation_rules);

   }

   // --------------------------------------------------------------------
   /**
	* validierungsregel für feld überschreiben
	* 
	* @access 	public	
	* @param 	string	name of input
	* @param 	string	new validation rules
	*/
   function overwrite_rules($_field, $_rules = '')
   {

	  foreach($this->validation_rules as $key => $rulesArr)
		 {
			
			$match = array_search($_field, $rulesArr);

			if($match != FALSE)
			   {
				  $this->validation_rules[$key]['rules'] = $_rules;
			   }
		 }
   }

   // --------------------------------------------------------------------
   /**
	* get all fields added to this library
	* 
	*/   
   public function get_fields($data = '')
   {

	  $retVal = array();
	  foreach($this->form_inputs as $key => $item)
		 {
			//$this->set_rule($item);
			if($item['value'] == '')
			   {
				  $item['value'] = set_value($item['name']);

			   }

			// --------------------------------------------------------------------
			// form input, default
			$retVal[$item['name']] = form_input($item);

			// --------------------------------------------------------------------
			// dropdown
			if($item['type'] == 'dropdown')
			   {
				  $id = '';
				  if(isset($item['id']))
					 {
						$id = 'id="'. $item['id'] . '"';
					 }

				  $retVal[$item['name']]= form_dropdown($item['name'], $item['options'], $item['value'], 'class="' . $item['class'] . '" ' .  $id );

			   }

			// --------------------------------------------------------------------
			// textarea
			if($item['type'] == 'textarea')
			   {
				  $retVal[$item['name']] = form_textarea($item);
			   }

			// --------------------------------------------------------------------
			// raw data
			if($item['type'] == 'raw')
			   {
				  $retVal[$item['name']] = $item['value'];

			   }




		 }

	  $retVal = $this->set_ret_arr($retVal);
			
	  return $retVal;
   } 

   // --------------------------------------------------------------------
   /**
	* return array exact wie post fields setzen bsp. input post name data[0][id] dann i<st feld in return value als $data
	* 
	* @access 	private	
	* @param 	string	
	* @return 	mixed	string or array
	* 
	*/
   private function set_ret_arr($_fieldsArr)
   {

	  $retVal = array();
	  foreach($_fieldsArr as $key => $formfield)
		 {

			$nameParts = explode( '[', str_replace(']','',$key));
			if($this->sliceRetArr > 0)
			   {
				  $nameParts = array_slice($nameParts, $this->sliceRetArr);
			   }
			$n_parts = count($nameParts);
	
			if($n_parts == 3)
			   {

				  $retVal[$nameParts[0]][$nameParts[1]][$nameParts[2]] = $formfield;
			   }
			elseif($n_parts == 2)
			   {
				  $retVal[$nameParts[0]][$nameParts[1]] = $formfield;
			   }
			elseif($n_parts == 1)
			   {
				  $retVal[$nameParts[0]] = $formfield;
			   }
			   
		 }

	  return $retVal;

   }
   // --------------------------------------------------------------------
   // config für formfeld reinschmeissen 
   public function add_field($data = '')
   {
	  $rules['rules'] = '';
	  $rules['field'] = $data['name'];
	  $rules['label'] = $data['name'];

	  if(isset($data['rules']))
		 {
			$rules['rules'] = $data['rules'];
			unset($data['rules']);
		 }
	  if(isset($data['field']))
		 {
			$rules['field'] = $data['field'];
			unset($data['field']);
		 }
	  if(isset($data['label']))
		 {
			$rules['label'] = $data['label'];
			unset($data['label']);
		 }



	  // set validation rulses
	  array_push($this->validation_rules,$rules);


	  array_push($this->form_inputs,$data);


	  return TRUE;
   } 



   // --------------------------------------------------------------------
   
}
