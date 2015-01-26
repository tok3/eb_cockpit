<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Public Journal module controller
 *
 * @author  tobias@mmsetc.de
 * @package energieberaer
 */
//use Former\Facades\Former;

class Contact_Details extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();
        Asset::add_path('theme', site_url('addons/shared_addons/modules/cockpit').'/');

        $this->template->enable_parser(true);
        $this->template->set_layout('cockpit.php');
        $this->template->append_css('module::jquery.datetimepicker.css');
        $this->template->append_js('module::jquery.datetimepicker.js');
        $this->template->append_js('module::app.js');


        $this->lang->load('cockpit');

        $contacts_m = $this->load->model('contacts_m');	   

        $this->formFields = $this->load->library('form_inputs');

    }
    public function index($_contacts_id = 0)
    {
        $this->contact($_contacts_id);
    }
    // --------------------------------------------------------------------
   
    public function contact($_contacts_id = '')
    {
	  	  

        $contact_id = $_contacts_id;

        if($this->current_user->group_id != 1) // wenn nicht admin 
        {

			$contact_id = $this->session->userdata('contact_id');

        }

        $contact_data = $this->contacts_m->get_contact_details($contact_id);

        if($this->current_user->group_id == 2 && !$this->input->post('details')) // group 2 user
        {
			
			$autData = $this->ion_auth->get_user();

			// preset contactdata from auth for group 2 = users
			if($contact_data['persons'][0]['email'] ==  '')
            {
                $contact_data['persons'][0]['email'] = $autData->email;
            }	  
			if($contact_data['persons'][0]['firstname'] ==  '')
            {
                $contact_data['persons'][0]['firstname'] = $autData->first_name;
            }	  
			if($contact_data['persons'][0]['name'] ==  '')
            {
                $contact_data['persons'][0]['name'] = $autData->last_name;
            }	  
			
        }
	  

 
        $follow_upSplit =  explode(' ', $contact_data['follow_up']);
        $contact_data['followup_date'] = $follow_upSplit['0'];
        $contact_data['followup_time'] = $follow_upSplit['1'];


        foreach($contact_data['persons'] as $key => $item)
        {
  
			$this->inpPersons($item,'persons['.$key.']');			
        }
        foreach($contact_data['addresses'] as $key => $item)
        {
			$this->inpAddr($item,'addresses['.$key.']');			
        }

	  
        $this->inpComp($contact_data);			

        $sent = $this->input->post('details');

        if(isset($sent['typ'])) 
        { 
			$contact_data['typ'] = $sent['typ'];

			if(($sent['typ'] != 2) || ($this->current_user->group_id == 1)) // wenn kontakttyp nicht firma dann form validierungsregel leer setzen 
            {
                $this->formFields->overwrite_rules('comp[name]', '');
                $this->formFields->overwrite_rules('comp[str_id]', '');

            }
        }
        $this->inpContacs($contact_data);			
	  

        $this->formFields->rules(); // validation rules anwenden
	  

        $this->form_validation->set_error_delimiters('<div class="">', '</div>');
        $errors =	 '';
 
        if($this->input->post('save') !=  '')
        {
			if ($this->form_validation->run() != 1)
            {
                $errors .= '<div class="medium-6 small-12 columns"><div class="alert alert-danger alert-dismissable" data-alert=""><i class="fa fa-ban"></i>
<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
				' . validation_errors() .'
				</div></div>';
            }
			else
            {

                // kontakteigenschaften setzen 
                if($this->input->post('properties'))
                {
                    $this->properties($contact_id, $this->input->post('properties'));
                }

                $contacts_data = $this->input->post('details');
				  
                $contacts_data['id'] = $contact_id;

                $contacts_data['follow_up'] = $this->format->dateDe2en($contacts_data['followup_date']) . ' ' . $contacts_data['followup_time'];

                unset($contacts_data['followup_date']);
                unset($contacts_data['followup_time']);


                if($contact_id == '')
                {
                    $contacts_data['users_id'] = $this->current_user->id;
                }
                if($contacts_data['follow_up'] == "")
                {

                }
						
                $contact_insert_id = $this->contacts_m->insert_update($contacts_data, 'eb_contacts');

                if($contact_id == '')
                {
                    $contact_id = $contact_insert_id;
                    Events::trigger('setcontact_id');
                }
                if($this->session->userdata('contact_complete') != 1) 
                {

                    Events::trigger('set_contact_id');
                }

                // insert/update companies
                $contacts = $this->input->post('details');
				 
                if(is_array($this->input->post('comp')) && $contacts['typ'] == 2)
                {
					
                    $comp_data = $this->input->post('comp');

                    $comp_data['contacts_id'] = $contact_id;


                    $this->contacts_m->insert_update($comp_data, 'eb_companies');
                }
                // insert/update addresses
                foreach($this->input->post('addresses') as $addr_data)
                {

                    $addr_data['contacts_id'] = $contact_id;
                    $this->contacts_m->insert_update($addr_data, 'eb_addresses');
                }

                // insert/update persons
                foreach($this->input->post('persons') as $personal_data)
                {
                    $personal_data['birthday'] = $this->format->dateDe2en($personal_data['birthday']);
                    $personal_data['contacts_id'] = $contact_id;

                    $this->contacts_m->insert_update($personal_data, 'eb_persons');
                }
                //$this->setFollowup($contact_id);

                redirect($this->uri->segment(1) . '/'  .$this->uri->segment(2). '/'  .$this->uri->segment(3) . '/' . $contact_id);
            }
        }
	  

        $fields = $this->formFields->get_fields();

        $data['persons'] = $this->loop_view($fields['persons'], 'contacts/person');	  
        $data['addresses'] = $this->loop_view($fields['addresses'], 'contacts/addresses');	  
 	  
        $data['contact_info'] = $this->load->view('contacts/details', $fields['details'], TRUE);

        $data['company'] = $this->load->view('contacts/company', $fields['comp'], TRUE);


        $data['errors'] = $errors;

// properties nur für admin (group_id = 1) anzeigen
        $data['properties'] = ($this->current_user->group_id == 1 ? $this->properties($contact_id) : '');

        $content = $this->load->view('contacts/edit', $data, TRUE);

        $aside['title'] = 'Meine Kontaktdaten';
        $aside['breadcrumb'] = '<li><a href="#"><i class="fa fa-user"></i> Home</a></li>
	                            <li class="active">Meine Kontaktdaten</li>';

        $selectiveTabs = usr_contact_tabs($contact_id);
        if($contact_data['is_affiliate'] != 1)
        {
            unset($selectiveTabs[array_search('ad_by_aff', $selectiveTabs)]); // geworbne kunden tab entfernen wenn kein affiliate
        }
        
        $this->template
            ->set_partial('header','header',array())
            ->set_partial('aside','sidebar',$aside)
            ->set('content', $content)
            ->set('tab_navigation',$this->navigation->load('contact_tabs',$selectiveTabs)->get_tabs())
            ->append_js('module::modules.js')
            ->append_js('module::contacts.js') 
            ->build('default');

    } 
// --------------------------------------------------------------------
/**
 * checkboxen um contact eigenschaften zuzuordnen
 * 
 */
    function properties($_contacts_id, $_values = '')
    {
        $avail_contact_tabs = array_keys($this->load->config('navigation/contact_tabs', true));        
        
        $propTable = 'default_eb_contact_properties';
        $this->load->model('general_m');
        $props = $this->general_m->set_table('eb_contact_properties');

        if(is_array($_values))
        {
            $usr_properties = $props->get_many_by('contacts_id', $_contacts_id);


            foreach($_values as $key => $value)
            {
                $insDat['property'] =  $value;
                $insDat['contacts_id'] =  $_contacts_id;
                $this->db->insert($propTable, $insDat);

            }

        }

        $usr_properties = $props->get_many_by('contacts_id', $_contacts_id);

        $availProps = $this->format->getEnumOptions($propTable, 'property');
        unset($availProps['']);

        $checked = array();
        foreach($usr_properties as $kay => $item)
        {
            $checked[$item->property] = $item->property;
        }

        
        $retVal = '';
        foreach($availProps as $key => $item)
        {
            $data = array(
                'name'        => 'properties['.$item.']',
                'value'       => $item,
                'checked'     => (isset($checked[$item]) ? true : false),
                'Style'       => 'margin:10px',
            );


            $retVal .= '<label for="property[strom]" class="checkbox">' . form_checkbox($data) . humanize($item) . '</label>';
            //$avP[$item] ='property['.$item.']';                
        }


        return $retVal;
        
    }
    // --------------------------------------------------------------------
    /**
     * function wird als callback für inputs verwendet
     * 
     */
    function deDate($_val)
    {
        return $this->format->date2german($_val);
    }

    // --------------------------------------------------------------------
    /**
     * forminputs table persons
     * 
     */
    function inpPersons($_data, $_arr_name)
    {

        $config['birthday'] = array
            (
                'callback'=>'deDate',
                'rules'=>'',

            );
	  
        $config['id'] = array
            (
                'type'=>'hidden',
                'rules'=>'',

            );

        $config['contacts_id'] = array
            (
                'type'=>'hidden',
                'rules'=>'',

            );


        $options = array(
            ''  => 'Bitte W&auml;hlen',
            'm'    => 'Herr',
            'f'   => 'Frau',
        );

        $config['sex'] = array
            (
                'options'=>$options,
                'type'=>'dropdown',
                'rules'=>'required',
                'label'=>'Anrede',

            );

        $config['firstname'] = array
            (
                'rules'=>'required',
                'label'=>'Vorname',

            );

        $config['name'] = array
            (
                'rules'=>'required',
                'label'=>'Name',

            );

        $config['email'] = array
            (
                'rules'=>'required|valid_email',
                'label'=>'Email'
            );

        $config['mobile'] = array
            (
                'rules'=>'',
                'label'=>'Kontakt --> Mobiltelefon',

            );

        $config['tel'] = array
            (
                'rules'=>'required',
                'label'=>'Kontakt --> Telefon',

            );




        $this->gen_form_inputs($_data, $_arr_name, $config);

    }

    // --------------------------------------------------------------------
    /**
     * forminputs for table addresses
     * 
     */
    function inpAddr($_data, $_arr_name)
    {
        $config['contacts_id'] = array
            (
                'type'=>'hidden',
                'rules'=>'',

            );
        $config['id'] = array
            (
                'type'=>'hidden',
                'rules'=>'',

            );
	  

        $config['str'] = array
            (
                'rules'=>'required',
                'label'=>'Strasse',

            );

        $config['no'] = array
            (
                'rules'=>'required',
                'label'=>'Hausnummer',

            );

        $config['plz'] = array
            (
                'rules'=>'required|numeric|max_length[5]',
                'label'=>'PLZ',

            );

        $config['city'] = array
            (
                'rules'=>'required',
                'label'=>'Ort',

            );


        $this->gen_form_inputs($_data, $_arr_name, $config);
    }

    // --------------------------------------------------------------------
    /**
     * forminputs table companies
     * 
     */

    function inpComp($_data = '')
    {

        $compData = array();	  

        foreach($_data as $key => $item)
        {
			$needle = 'comp_';
			if(stristr($key, $needle))
            {
                $compData[str_replace($needle,'',$key)] = $item;
            }
        }
	  
        
        $config['id'] = array
            (
                'type'=>'hidden',
                'rules'=>'',

            );

        $config['name'] = array
            (
                'rules'=>'required',
                'label'=>'Firma Name',

            );


        $config['name_2'] = array
            (
                'type'=>'hidden',
                'rules'=>'',

            );

        $config['email'] = array
            (
                'type'=>'hidden',
                'rules'=>'',

            );

        $config['ust_id'] = array
            (
                'type'=>'text',
                'rules'=>'',

            );

        $config['str_id'] = array
            (
                'type'=>'text',
                'rules'=>'',
                'label'=>'Steuernummer',

            );


        $this->gen_form_inputs($compData, 'comp',$config);

        //$this->axTest();

    }

    // --------------------------------------------------------------------
    /**
     * formninputs table contacts
     * 
     */

    function inpContacs($_data)
    {

        // --------------------------------------------------------------------
        $config['id'] = array
            (
                'type'=>'hidden',
                'rules'=>'',

            );



        // --------------------------------------------------------------------
        $config['initial_contact'] = array
            (
                'type'=>'raw',

            );

        // --------------------------------------------------------------------
        $_data['followup_date'] =  $this->format->date2german($_data['followup_date']);
        $config['followup_date'] = array
            (
                'class'=>'timepicker form-control',
                'id'=>'followupDate',
                'value'=>date('d.m.Y', time() + 86400)


            );

        // --------------------------------------------------------------------
        $config['followup_time'] = array
            (
                'class'=>'timepicker form-control',
                'id'=>'followupTime',
                'value'=>'00:00:00'


            );

        // --------------------------------------------------------------------
	  
        $_data['memo'] =  trim($_data['memo']);

        $config['memo'] = array
            (
                'type'=>'textarea',
                'class'=>'hide form-control',
                'id'=>'inpContactsMemo',
                'cols'=>'40',
                'rows'=>'2',
            );


        // --------------------------------------------------------------------
        $options = array(
            ''  => 'Bitte W&auml;hlen',
            '1'    => 'Privatperson',
            '2'   => 'Firma',
        );


        $config['typ'] = array
            (
                'type'=>'dropdown',
                'label'=>'Kontakt Typ',
                'rules'=>'required',
                'id'=>'contactType',
                'options'=>$options,
                'class'=>'contactType  form-control',

            );


        // --------------------------------------------------------------------
        /**
         * elemente die array als wert haben entfernen
         * kommt z.b. bei addressen, personen, abnahmestellen vor ... 
         * 
         */

        foreach($_data as $key => $value)
        {
            if(is_array($value))
            {
                unset($_data[$key]);

            }
        }

        $this->gen_form_inputs($_data, 'details', $config);
    }

    // --------------------------------------------------------------------
    /**
     * forminputs generieren
     * 
     * @access 	private	
     * @param 	array	daten
     * @param 	string	post array name
     * @param 	array	config 	
     * 
     */
    private   function gen_form_inputs($_data, $_arr_name, $config = array())
    {

        foreach($_data as $key => $value)
        {

			$conf = array(

                'name'        => $_arr_name.'['.$key.']',
                'id'          => $key,
                'maxlength'   => '',
                'value'       => $value,
                'rules'       => '',
                'class'       => 'form-control ',
                'type'       => 'text',


            );

			if(isset($config[$key]))
            {
		 		   
                if(isset($config[$key]['callback']))
                {
                    // callback funktion auf value anwenden, z.b. datum formatieren
                    $conf['value'] = call_user_func(array($this, $config[$key]['callback']),$value); 
                }

                if(isset($config[$key]['value']) && $value)
                {
                    unset($config[$key]['value']);
                }

                // merge def conf und config
                $conf = $config[$key] + $conf;
            }

			$this->form_inputs->add_field($conf);			
        }
	  

    }
    // --------------------------------------------------------------------
    /**
     * view iterieren und html zurückgeben
     * 
     * @param 	array	two demensional array containing the data
     * @return 	string	html
     */
    private function loop_view($_data, $_view)
    {
        $retVal = '';
        foreach($_data as $key => $items)
        {
		
			$items['key'] = $key;
			$retVal .= $this->load->view($_view, $items, TRUE);
        }
        return $retVal;

    }

// --------------------------------------------------------------------
    
}