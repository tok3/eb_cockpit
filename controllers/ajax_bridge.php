<?php 
if (! defined('BASEPATH')) exit('No direct script access');
/**
 * in this controller are functions that are called asyncronously by ajax 
 */

class ajax_bridge extends Public_Controller 
{
   function __construct() 
   {
	  parent::__construct();

   }

   // --------------------------------------------------------------------
   /**
	* get ci session data
	* @access 	public	
	* @param 	string	session var name
	* @return 	mixed	
	*/   
   public function getSessionData()
   {

	  $_reqData= $this->input->post('reqData');

	  if($_reqData == '')
		 {
			$this->output->set_output(json_encode($this->session->userdata));
		 }
	  else
		 {
			$reqestedData = $this->session->userdata($_reqData);

			$this->output->set_output(json_encode($reqestedData));
		 }
   }

   // --------------------------------------------------------------------
   /**
	* set ci session data
	*
	* @access 	public	
	* @param 	mixed	data that have to be stored in session
	* @return 	void	
	*/   

   public function setSessionData()
   {

	  $_sessVar = $this->input->post('sessVar');
	  $_setData = $this->input->post('value');
	  $this->session->set_userdata($_sessVar, $_setData);
	  
   }

   // --------------------------------------------------------------------
   /**
	* unset set ci session data
	*
	* @access 	public	
	* @param 	string 	variable name to be unset
	* @return 	void	
	*/   

   public function unsetSessionData()
   {
	  $_sessVar = $this->input->post('sessVar');
	  $this->session->unset_userdata($_sessVar);
   }
   // --------------------------------------------------------------------
   /**
	* get language variables, intedned to called by ajax to use these vars in javascript 
	* 
	*/
   public function getLangLines()
   {

	  if($this->input->post('languageFile') != '')
		 {
			$_file = $this->input->post('languageFile');
			$_lang = $this->input->post('language');

			$this->lang->load($_file, $_lang);
		 }

	  $this->output->set_output(json_encode($this->lang->language));
   }

   // --------------------------------------------------------------------
   
}
/* End of file ajax_bridge.php */
/* Location: ./application/controllers/ajax_bridge.php */
