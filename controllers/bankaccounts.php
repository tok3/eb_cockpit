<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Public Journal module controller
 *
 * @author  tobias@mmsetc.de
 * @package energieberaer
 */
//use Former\Facades\Former;

class bankaccounts extends Public_Controller
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

        $this->validation_rules = array();

        $this->formFields = $this->load->library('form_inputs');

    }
    function index($_contacts_id)
    {
        $this->show($_contacts_id);
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
    public function show($_contacts_id)
    {
        $contact_id = $_contacts_id;

        if($this->current_user->group_id != 1) // wenn nicht admin 
        {
			$contact_id = $this->session->userdata('contact_id');
        }

        $table = 'eb_bank_accounts';
        $this->general_m->set_table($table);

        
        $bank_data =  $this->general_m->get_many_by(array('contacts_id'=> $contact_id));

        if(count($bank_data) == 0)
        {
            $insDat = array_fill_keys($this->general_m->list_fields($table), '');
           
            unset($insDat['id']);

            $insDat['contacts_id'] = $contact_id;
            $insDat['last_upd'] = date('Y-m-d H:i:s',now());                    

            $this->general_m->insert($insDat);

            $bank_data =  $this->general_m->get_many_by(array('contacts_id'=> $contact_id));

        }



        // form 
        $this->set_fields($bank_data[0]);    

        $fields =  $this->form_inputs->get_fields();			

        $fields['bankdata']['errors']  =	 '';

        if($this->input->post('save') !=  '')
        {
			if ($this->form_validation->run() != 1)
            {
                $fields['bankdata']['errors']  .= '<div class="medium-6 small-12 columns">
                                                   <div class="alert alert-danger alert-dismissable" data-alert="">
                                                   <i class="fa fa-ban"></i>
                                                   <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
                                                   ' . validation_errors() .'
                                                   </div></div>';
            }
            else
            {

                $postData = $this->input->post('bankdata');
                $this->general_m->update($postData['id'],$postData );
                echo                 redirect($this->uri->segment(1) . '/'  .$this->uri->segment(2). '/'  .$this->uri->segment(3) . '/' . $contact_id);
            }
        }

        

        $content =  $this->load->view('contacts/v_bank_account', $fields['bankdata'], TRUE);

        $aside['title'] = 'Meine Kontodaten';
        $aside['breadcrumb'] = '<li><a href="#"><i class="fa fa-user"></i> Home</a></li>
	  <li class="active">Meine Konto</li>';

        $this->template
            ->set_partial('header','header',array())
  ->set_partial('aside','sidebar',$aside)        
            ->set('content', $content)
            ->set('tab_navigation',$this->navigation->load('contact_tabs',usr_contact_tabs($contact_id))->get_tabs())
            ->append_js('module::modules.js')
            ->append_js('module::contacts.js') 
            ->build('default');
        
    }

    // --------------------------------------------------------------------
    function set_fields($_data)
    {

        $conf = array(

            'name'        => 'bankdata[id]',
            'id'          => 'id',
            'value'       => $_data->id,
            'rules'       => '',
            'type'       => 'hidden',
        );

        $this->form_inputs->add_field($conf);			

        $conf = array(

            'name'        => 'bankdata[acc_holder]',
            'id'          => 'id',
            'label'   => 'Kontoinhaber',
            'value'       => $_data->acc_holder,
            'rules'       => 'required',
            'class'       => 'form-control ',
            'type'       => 'text',
        );

        $this->form_inputs->add_field($conf);			

        $conf = array(

            'name'        => 'bankdata[bank_name]',
            'id'          => 'bank_name',
            'label'   => 'Bank',
            'value'       => $_data->bank_name,
            'rules'       => 'required',
            'class'       => 'form-control ',
            'type'       => 'text',
        );
        $this->form_inputs->add_field($conf);			

        $conf = array(

            'name'        => 'bankdata[iban]',
            'id'          => 'iban',
            'label'   => 'IBAN',
            'maxlength'   => '34',
            'value'       => $_data->iban,
            'rules'       => 'required|max_length[34]',
            'class'       => 'form-control ',
            'style'       => 'text-transform:uppercase',
            'type'       => 'text',
        );
        $this->form_inputs->add_field($conf);			

        $conf = array(

            'name'        => 'bankdata[bic]',
            'id'          => 'bic',
            'label'   => 'BIC',
            'maxlength'   => '11',
            'value'       => $_data->bic,
            'rules'       => 'required|max_length[11]',
            'class'       => 'form-control ',
            'style'       => 'text-transform:uppercase',
            'type'       => 'text',
        );
        $this->form_inputs->add_field($conf);			



        $this->form_inputs->rules();

        $this->form_validation->set_error_delimiters('<div class="">', '</div>');

    }

}// class ends here