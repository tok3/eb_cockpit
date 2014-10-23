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

class navigation
{
   protected $ci;
   protected $module;
   private $navConf;
   function __construct()
   {
	  $this->ci = &get_instance();

	  $this->module = $this->ci->router->fetch_module();

   }




// --------------------------------------------------------------------
/**
* 
* 
* @access 		
* @param 		
* @return 		
* 
*/
 function wrap($_wrap)
{


}


   // --------------------------------------------------------------------
   /**
	* navigationseintrag erzeugen
	* 
	* @access 	private	
	* @param 		
	* @return 	string	
	* 
	*/

   private function set_entries ()
   {

	  $_entries = array();

	  $this->set_navigation();

	  foreach($this->navConf as $key => $conf)
		 {
			$active = '';
			$targ = site_url($this->module . '/' . $conf['target']);

			if(current_url() == $targ)
			   {
				  $active = 'active ';
			   }


			$_entries[$key] =   '<li class=" ' . $active . ' "><a href="'. $targ .'" >' . $conf['name'] . '</a></li>';
		 }

	  return  implode("",$_entries	  );

   }
   // --------------------------------------------------------------------
   /**
	* Tab nav behziehen
	* 
	* @access 	public	
	* @param 	string	
	* @return 	string	
	* 
	*/
   public function get_tabs()
   {

	  $t_nav ='  <ul class="nav nav-tabs">';
	  $t_nav .= $this->set_entries();
	  $t_nav .= '</ul>';

	  return $t_nav;
   }


   // --------------------------------------------------------------------
   /**
	* get_sidebar
	* 
	* @access 	public	
	* @param 	void	
	* @return 	string	
	* 
	*/
   public function get_sidebar()
   {
	  /**
	   *   <li class="<?php  echo check_active('cockpit/leads_energieausweis/index');?>">
	   <a href="<?php echo site_url('cockpit/leads_energieausweis/index');?>">
	   <i class="glyphicon glyphicon-transfer"></i><span>Leads Energieausweis</span>
	   </a>
	   </li>
	   * 
	   */

   }

   // --------------------------------------------------------------------
   /**
	* 
	* 
	* @access 		
	* @param 		
	* @return 		
	* 
	*/
   function set_navigation ()
   {


	  $config = array(
					  'nav_contact'=>array(
										   'name'=>'Kontaktdaten',
										   'target'=>'contact_details/contact/' . $this->ci->uri->rsegment(3),
										   ),
					  'nav_immo'=>array(
										'name'=>'Energieausweis',
										'target'=>'immobilie/details/' . $this->ci->uri->rsegment(3),
										)

					  );


	  $this->navConf = $config;
   }

   // --------------------------------------------------------------------
 
}