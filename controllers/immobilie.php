<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Public Journal module controller
 *
 * @author  tobias@mmsetc.de
 * @package energieberaer
 */
class immobilie extends Public_Controller
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
    // --------------------------------------------------------------------
    /**
     * immobilien detailform
     * 
     * @access 	public	
     * @param 		
     * @return 		
     * 
     */
    public function details()
    {
        $this->general_m->set_table('eb_immobilien');

        // $this->load->config( 'navigation');
        // echo "<pre><code>";
        // print_r($this->config->item('nav_sidebar'));
        // echo "</code></pre>";
      
	  
        if($this->input->post())
        {
			$crud_dat = $this->input->post('formdata');
            $id = $crud_dat['id'];
            unset($crud_dat['id']);
			if($id > 0)
            {
                
                $this->general_m->update($id, $crud_dat);

            }
            else
            {
                $crud_dat['contacts_id'] = $this->uri->rsegment(3);
                $crud_dat['stream_entry_id'] = $this->uri->rsegment(3);

                $this->general_m->insert($crud_dat);
            }

        }
        $_dat = $this->general_m->get_many_by(array('contacts_id' => $this->uri->rsegment(3)));

                
        if(isset($_dat[0]) && is_object($_dat[0]))
        {	  
			$_dat =  (array) $_dat[0];
        }


        $data = $this->get_formfields($_dat);
        $data['contact'] = $this->contacts_m->get_contact_details($this->uri->rsegment(3));

        $content = $this->load->view('energieausweis/v_immobilie', $data, TRUE);

        $aside['title'] = 'Immobilie';
        $aside['breadcrumb'] = '<li><a href="#"><i class="fa fa-user"></i> Home</a></li>
                                <li class="active">Immobilie</li>';

        $this->get_formfields();

        $this->template
            ->set_partial('header','header',array())
            ->set_partial('aside','sidebar',$aside)
            ->set('content',$content)
            ->set('tab_navigation',$this->navigation->load('contact_tabs')->get_tabs())
            ->append_js('module::modules.js')
            ->append_js('module::contacts.js') 
            ->build('default');




    }
    // --------------------------------------------------------------------
    /**
     * test
     * 
     * @access 		
     * @param 		
     * @return 		
     * 
     */
    function test()
    {
        $config = array(
            'nav_contact'=>array(
                'name'=>'scasdjf',
                'target'=>'contact_details/contact/' . $this->uri->rsegment(3),
            ),
            'nav_immo'=>array(
                'name'=>'lsakjfdl ',
                'target'=>'immobilie/details/' . $this->uri->rsegment(3),
            )

        );


        $tabnav = new $this->navigation();        
        $tabnav->set($this->config->item('nav_sidebar'));
        $items = $tabnav->get_entries();

        echo $items;
    }
    // --------------------------------------------------------------------
    /**
     * formfelder
     * 
     * @access 		
     * @param 		
     * @return 		
     * 
     */
    function get_formfields ($_data = '')
    {
        $postName = 'formdata';
        $namePreFx = '';
        $idPreFx = 'weight_';

        $fields['id']['type'] = 'hidden';
        $fields['contacts_id']['type'] = 'hidden';

        $fields['stream_entry_id']['type'] = 'hidden';

        $fields['strasse']['type'] = 'input';

        $fields['plz']['type'] = 'input';

        $fields['ort']['type'] = 'input';

        $fields['qm']['type'] = 'input';

        $fields['qm_grund']['type'] = 'input';

        $fields['bauart']['type'] = 'input';

        $fields['heizung']['type'] = 'input';

        $fields['wasser']['type'] = 'input';

        $fields['rg_verbrauch']['type'] = 'checkbox';

                $fields['makler_kontaktiert']['type'] = 'checkbox';

                $fields['makler']['type'] = 'input';

                $fields['an_makler']['type'] = 'checkbox';

                                $fields['an_energieberater']['type'] = 'checkbox';

                                $fields['innenprovision']['type'] = 'input';
                                $fields['aussenprovision']['type'] = 'input';
                                
        $fields['bauplan']['type'] = 'checkbox';

        $fields['instanthaltungsm']['type'] = 'input';

        $fields['est_preis']['type'] = 'input';

        $fields['vk_preis']['type'] = 'input';

        $fields['verkauft']['type'] = 'checkbox';

        $fields['an_makler']['type'] = 'checkbox';
        $fields['an_energieberater']['type'] = 'checkbox';

        $fields['baujahr']['type'] = 'input';

        $fields['objektart']['type'] = 'dropdown';
        $fields['objektart']['options']  = lang('cockpit:immo_art_option');

        $fields['bezugsfrei']['type'] = 'dropdown';
        $fields['bezugsfrei']['options']  = lang('cockpit:immo_bezugsfrei_option');

        $fields['bemerkung']['type'] = 'textarea';

        $fields['verausserung_art']['type'] = 'input';

        $fields['str']['type'] = 'input';
        $fields['plz']['type'] = 'input';
        $fields['ort']['type'] = 'input';

        // werte setzen
        if(is_array($_data))
        {
            foreach($_data as $name => $value)
            {
                if(isset($fields[$name]))
                {		

                    $fields[$name]['value'] = $value;
                }
            }

        }

        foreach ($fields as $key => $field)
        {

			$field['name'] = $key;
			$field['type'];
			$value = '';

			if(isset($field['value']))
            {
                $value = $field['value'];
            }
			
			// standard input	  
			$conf = array(
                'name'        => $postName . '[' . $field['name'] . ']',
                'id'          => $key  . $field['name'],
                'value'       => $value,
                'class'       => 'form-control',
            );

			$formfields[$namePreFx . $field['name']] = form_input($conf);

			if($field['type'] == 'dropdown')
            {

                $formfields[$namePreFx . $field['name']] = form_dropdown($postName . '[' . $field['name'] . ']', $field['options'], trim($value), 'class="form-control"');

            }

			if($field['type'] == 'hidden')
            {
                $formfields[$namePreFx . $field['name']] = form_hidden($postName . '[' . $field['name'] . ']', $value);
            }

			if($field['type'] == 'textarea')
            {
                $formfields[$namePreFx . $field['name']] = form_textarea($conf);
            }

            			if($field['type'] == 'checkbox')
            {

                $conf['checked'] = $conf['value'];
                if($conf['checked'] != 1)
                {
                    $conf['value'] = 1;
                }
                $formfields[$namePreFx . $field['name']] =   form_hidden($conf['name'], 0) . form_checkbox($conf);

            }
        }
        return $formfields;	  

    }

    

    // --------------------------------------------------------------------

}