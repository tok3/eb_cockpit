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
	* Tab nav behiehen
	* 
	* @access 	public	
	* @param 	string	
	* @return 	string	
	* 
	*/
   public function get_tabs()
   {


	  $this->set_navigation();


	  $t_nav ='  <ul class="nav nav-tabs">';

	  foreach($this->navConf as $key => $conf)
		 {
			$active = '';
			$targ = site_url($this->module . '/' . $conf['target']);

			if(current_url() == $targ)
			   {
				  $active = 'active ';
			   }


			$t_nav .=   '<li class=" ' . $active . ' "><a href="'. $targ .'" >' . $conf['name'] . '</a></li>';
                                 
							   
		 }
	  $t_nav .= '</ul>';

	  return $t_nav;
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