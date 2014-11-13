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

class immo_m extends MY_Model 
{
   protected $_table;

   function __construct()
   {
	  parent::__construct();

	  $this->_table = 'eb_immobilien';


   }
   


    public function get_info($_contact_id)
    {
        $_dat = $this->get_many_by(array('contacts_id' => $_contact_id ));

                                   return $_dat;
    }
   
}

/* End of file mod_contacts.php */
/* Location: ./application/models/mod_contacts.php */
