<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Public Journal module controller
 *
 * @author  tobias@mmsetc.de
 * @package energieberaer
 */

use Former\Facades\Former;

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
        $this->template->append_js('module::app.js');


        $this->lang->load('cockpit');

        $contacts_m = $this->load->model('contacts_m');	   
        $this->load->library('form_validation');


    }
    /**
     * Index
     */
    public function index($_prop = 0)
    {
        $this->session->set_userdata('contacts_backlink', current_url());
        if($_prop == 100)
        {
            $this->db->where('is_affiliate',1); // nur affiliates selectieren
            $prop = '';
        }
        else
        {
            $prop = (int) $_prop;

        }
        
        $grid = $this->get_contacts_grid($prop);
       
        $this->template
            ->set_partial('header','header',array())
            ->set_partial('aside','sidebar',array())
            ->set('active_kontakt','active')
            ->append_js('module::modules.js')
            ->append_js('module::contacts_grid.js') 
            ->set('content', $grid)
            ->build('default')
            ;

    }

    // --------------------------------------------------------------------
    /**
     * contact grid generieren FÜR AFFILIATE ANSICH GEWOBENE KONTAKTE
     * 
     * @access 		
     * @param 		
     * @return 		
     * 
     */
    public function by_aff($_affiliate_id = 0)
    {
        $this->db->where('affiliate_id',$this->session->userdata('contact_id')); // nur affiliates selectieren

        $grid = $this->get_aff_grid();
       
        $this->template
            ->set_partial('header','header',array())
            ->set_partial('aside','sidebar',array())
            ->set('active_kontakt','active')
            ->append_js('module::contacts_grid.js') 
            ->append_js('module::modules.js')
            ->set('content', $grid)
            ->build('default')
            ;

    }
    // --------------------------------------------------------------------
    /**
     * contact grid generieren ADMIN ANSICHT GEWORBENE KONTAKTE DES AFFILIATES
     * 
     * @access 		
     * @param 		
     * @return 		
     * 
     */
    public function by_aff_admin($_affiliate_id = 0)
    {
        if($this->current_user->group_id != 1)
        {
            die('');
        }
        $this->db->where('affiliate_id',$_affiliate_id); // nur affiliates selectieren

        $grid = $this->get_aff_grid();
        
        $this->template
            ->set_partial('header','header',array())
            ->set_partial('aside','sidebar',array())
            ->set('tab_navigation',$this->navigation->load('contact_tabs',usr_contact_tabs($_affiliate_id))->get_tabs())
            ->set('active_kontakt','active')
            ->append_js('module::contacts_grid.js') 
            ->append_js('module::modules.js')
            ->set('content', $grid)
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
    function get_contacts_grid($_property = 0)
    {

        // --------------------------------------------------------------------
        $contacts = $this->contacts_m->get_persons($_property);

        $tableData = array();
        if($contacts != FALSE)
        {
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

                //			$tableData[$key]['user'] = $mitarbeiter;
                $tableData[$key]['initial_contact'] = date('d.m.Y',human_to_unix($item['initial_contact']));
                $tableData[$key]['kontakt_id'] = str_pad($item['contacts_id'],6,0,STR_PAD_LEFT);

                $tableData[$key]['vorname'] = $item['firstname'];
                $tableData[$key]['name'] = $item['name'];
                $tableData[$key]['plz'] = $item['plz'];
                $tableData[$key]['city'] = $item['city'];
                $tableData[$key]['comp_name'] = $item['comp_name'];
                $tableData[$key]['tel'] = '<span data-usage="tel">' . $item['tel']. '</span>' ; // usage wird per jquery.each sesetzt !!
                $tableData[$key]['mobile'] = '<span data-usage="cellphone">' . $item['mobile'] .'</span>';// usage wird per jquery.each sesetzt !!


                $tableData[$key]['id'] = '<span class="editDelBtn"><a href="' . site_url('cockpit/contacts/delete/' .$item['contacts_id']) . '" class="gridDelete right hide-for-touch"><span title="L&ouml;schen" class="fa fa-trash-o"></span></a>&nbsp;<a href="' . site_url('cockpit/contact_details/contact/' .$item['contacts_id']) . '" class="gridEdit right"><span title="Bearbeiten" class="fa fa-edit"></span></a></span>';

            }
        }
        $tmpl = array ( 'table_open'  => '<table id="personsGrid"  class="display table table-bordered table-hover dataTable">');


        $this->table->set_template($tmpl); 


        $this->table->set_heading(lang('cockpit:heading_grid_contacts'));

   

        $grid = $this->table->generate($tableData);

        return $grid;
    }

    // --------------------------------------------------------------------
    /**
     * contact grid mit geworbenen kontakten für affiliates generieren
     * 
     * @access 		
     * @param 		
     * @return 		
     * 
     */
    function get_aff_grid($_property = 0)
    {
        $contacts = $this->contacts_m->get_persons($_property);

        $tableData = array();
        if($contacts != FALSE)
        {
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

                //			$tableData[$key]['user'] = $mitarbeiter;
                $tableData[$key]['initial_contact'] = date('d.m.Y',human_to_unix($item['initial_contact']));
                $tableData[$key]['kontakt_id'] = str_pad($item['contacts_id'],6,0,STR_PAD_LEFT);

                $tableData[$key]['vorname'] = str_pad(substr($item['firstname'],0,2), 7, '*');
                $tableData[$key]['name'] = str_pad(substr($item['name'],0,2), 7, '*');
                $tableData[$key]['plz'] = str_pad(substr($item['plz'],0,2), 5, '*');
                $tableData[$key]['city'] = str_pad(substr($item['city'],0,2), 7, '*');
                $tableData[$key]['comp_name'] = str_pad(substr($item['comp_name'],0,2), 7, '*');
                $tableData[$key]['tel'] = str_pad(substr($item['tel'],0,2), 8, '*');
                $tableData[$key]['mobile'] = str_pad(substr($item['mobile'],0,2), 8, '*');


                $tableData[$key]['id'] = '<a href="' . site_url('cockpit/info/contact/' . $this->format->enc_arr(array('contacts_id'=>$item['contacts_id']))) . '" class="gridEdit right"><span title="Bearbeiten" class="fa fa-info-circle"></span></a></span>';

            }
        }
        $tmpl = array ( 'table_open'  => '<table id="personsGrid"  class="display table table-bordered table-hover dataTable">');


        $this->table->set_template($tmpl); 

        $this->table->set_heading(lang('cockpit:heading_grid_contacts'));


        $grid = $this->table->generate($tableData);

        return $grid;
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

		$this->contacts_m->set_contact_deleted($_id);

		redirect($this->router->fetch_module() . '/' .$this->uri->rsegment(1));

	}

    // --------------------------------------------------------------------
    public function formertest()
    {
        $clients = array('c1', 'c2');

        echo Former::select('clients')->options($clients, 2)
                                      ->help('Pick some dude')
                                      ->state('warning');


        echo Former::open()->rules(array(
            'name'     => 'required|max:20|alpha',
            'age'      => 'between:18,24',
            'email'    => 'email',
            'show'     => 'in:batman,spiderman',
            'random'   => 'match:/[a-zA-Z]+/',
            'birthday' => 'before:1968-12-03',
            'avatar'   => 'image',
        ));
        

        echo '<input name="test"      type="text"   required maxlength="20" pattern="[a-zA-Z]+" /><input name="name"      type="text"   required maxlength="20" pattern="[a-zA-Z]+" />
<input name="age"       type="number" min="18" max="24" />
<input name="email"     type="email" />
<input name="show"      type="text"   pattern="^(batman|spiderman)$" />
<input name="random"    type="text"   pattern="[a-zA-Z]+" />
<input name="birthday"  type="date"   max="1968-12-03" />
<input name="avatar"    type="file"   accept="image/jpeg,image/png,image/gif,image/bmp" />'.form_submit() . form_close();


    }
// --------------------------------------------------------------------
    
}