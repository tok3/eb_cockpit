<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Public Journal module controller
 *
 * @author  tobias@mmsetc.de
 * @package energieberaer
 */
class Cockpit extends Public_Controller
{

   public function __construct()
   {
	  parent::__construct();
	  Asset::add_path('theme', site_url('addons/shared_addons/modules/cockpit').'/');

      $this->template->append_js('module::app.js');

	  $this->lang->load('cockpit');

   }

   /**
	* Index
	*/
   public function index()
   {

     
/*
       $usrInf = $this->ion_auth->get_user(166);
                $userdata = (array) $usrInf;        
        $userdata['contacts_id'] = 161;

       $this->ev_user->transfer_profile_data($userdata);
*/
       $sidenav = new $this->navigation();        

	  /* //permisssionstest
	   role_or_die($this->module,'customer');
	   $this->permissions['cockpit']['customer'];
	   if (group_has_role($this->module, 'customer'))
	   {
	   echo "<pre><code>";
	   print_r($this->permissions);
	   echo "</code></pre>";
   
	   }
	  */

         if(($this->session->userdata('contact_complete') == 0) && ($this->current_user->group_id == 3))
         {
             redirect($this->router->fetch_module().'/contact_details/contact/' . $this->session->userdata('contact_id'));
         }
         
	  $contacts_m = $this->load->model('contacts_m');	   
	  $this->template->enable_parser(true);
	  $this->template->set_layout('cockpit.php');

	  $dash = $this->load->view($this->current_user->group . '_dashboard', '',true);

	  $section['title'] = 'Nachrichtenzentrale';
	  $section['breadcrumb'] = '<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	  <li class="active">Dashboard</li>';
	

	  $this->template
		 ->set_partial('header','header',array())
		 ->set_partial('aside','sidebar',$section)
		 ->append_js('module::contacts_grid.js') 
		 ->append_js('module::modules.js')
		 ->append_js('module::app.js')
		 ->set('content', $dash)
		 ->build('default')

		 ;



   }

   // --------------------------------------------------------------------
	
   public function versorger()
   {



	  $this->template->enable_parser(true);
	  $this->template->set_layout('cockpit.php');


	  $dash = $this->load->view('versorger', '',true);

	  $aside['title'] = 'Energieversorger';
	  $aside['breadcrumb'] = '<li><a href="#"><i class="fa fa-fire"></i> Home</a></li>
	  <li class="active">Energieversorger</li>';

	  $this->template
		 ->set_partial('header','header',array())
		 ->set_partial('aside','sidebar',$aside)
		 ->append_js('module::versorger.js')
		 ->append_js('module::contacts_grid.js') 
		 ->append_js('module::modules.js')
		 ->set('content', $dash)
		 ->build('default')

		 ;

   }

// --------------------------------------------------------------------

    function stream_example()
    {
        $this->load->driver('Streams');
        $stream_slug = 'leads_energy';
        $namespace = 'streams';
        $field_preFX = "el_";
        /* testen ob stream existiert. muss so getestet werden, da pyro team zu doof ist get_stream() fehlerfrei zu machen: https://forum.pyrocms.com/discussion/12829/check-if-stream-exists
         */
        
        $query = $this->db->query('Select * from default_data_streams where stream_slug = "'. $stream_slug .'"');
        $res = $query->result();

        
        if(isset($res[0]->id))
        {
// $this->streams->fields->assign_field($namespace, $stream_slug, 'aa_testfeld', array('required' => true));
            $assignments = $this->streams->streams->get_assignments($stream_slug, $namespace);
// deassign and delete fields
            foreach($assignments as $key => $assignment)
            {
                
                $this->streams->fields->deassign_field($namespace, $stream_slug, $assignment->field_slug);
                $this->streams->fields->delete_field($assignment->field_slug, $assignment->field_namespace);
            }

            $this->streams->streams->delete_stream($stream_slug, $namespace);

            echo             anchor("admin/streams/entries/add/" . ($assignments[0]->stream_id + 1));
        }
        //die();
        $fields = array(
                        array(
                'name'          => 'Affiliate ID',
                'slug'          => $field_preFX . 'affiliate_id',
                'namespace'     => $namespace,
                'type'          => 'text',
                'extra'         => array('max_length' => 11),
                'assign'        => $stream_slug,
                'title_column'  => false,
                'required'      => false
            ),
            array(
                'name'          => 'Aktionscode',
                'slug'          => $field_preFX . 'aktions_code',
                'namespace'     => $namespace,
                'type'          => 'text',
                'extra'         => array('max_length' => 23),
                'assign'        => $stream_slug,
                'title_column'  => false,
                'required'      => false
            ),
                        array(
                'name'          => 'Angenommen',
                'slug'          => $field_preFX . 'approved',
                'namespace'     => $namespace,
                'type'          => 'choice',
                'extra'         => array('choice_type'=>'radio','default_value'=>'0','choice_data'=>"1 : Ja\n 0 : Nein"),
                'assign'        => $stream_slug,
                'title_column'  => false,
                'required'      => false
                        ),

                        array(
                'name'          => 'Anrede',
                'slug'          => $field_preFX . 'anrede',
                'namespace'     => $namespace,
                'type'          => 'choice',
                'extra'         => array('choice_type'=>'radio','choice_data'=>"m : Herr\n f : Frau"),
                'assign'        => $stream_slug,
                'title_column'  => false,
                'required'      => true
                        ),

            array(
                'name'          => 'Name',
                'slug'          => $field_preFX . 'name',
                'namespace'     => $namespace,
                'type'          => 'text',
                'extra'         => array('max_length' => 200),
                'assign'        => $stream_slug,
                'title_column'  => false,
                'required'      => true
            ),
                        array(
                'name'          => 'Firma',
                'slug'          => $field_preFX . 'firma',
                'namespace'     => $namespace,
                'type'          => 'text',
                'extra'         => array('max_length' => 200),
                'assign'        => $stream_slug,
                'title_column'  => false,
                'required'      => true
            ),
                        array(
                'name'          => 'Email',
                'slug'          => $field_preFX . 'email',
                'namespace'     => $namespace,
                'type'          => 'email',
                'extra'         => array('max_length' => 200),
                'assign'        => $stream_slug,
                'title_column'  => false,
                'required'      => true
            ),
                        array(
                'name'          => 'Telefon',
                'slug'          => $field_preFX . 'telefon',
                'namespace'     => $namespace,
                'type'          => 'text',
                'extra'         => array('max_length' => 20),
                'assign'        => $stream_slug,
                'title_column'  => false,
                'required'      => true
                        ),
                                                array(
                'name'          => 'Plz',
                'slug'          => $field_preFX . 'plz',
                'namespace'     => $namespace,
                'type'          => 'text',
                'extra'         => array('max_length' => 5),
                'assign'        => $stream_slug,
                'title_column'  => false,
                'required'      => true
            ),
                        array(
                'name'          => 'Ort',
                'slug'          => $field_preFX . 'ort',
                'namespace'     => $namespace,
                'type'          => 'text',
                'extra'         => array('max_length' => 200),
                'assign'        => $stream_slug,
                'title_column'  => false,
                'required'      => true
            ),

                        array(
                'name'          => 'Branche',
                'slug'          => $field_preFX . 'branche',
                'namespace'     => $namespace,
                'type'          => 'choice',
                'extra'         => array('choice_data'=>"\" \" : Branche*\nBaustoffe\nB&auml;ckereien mit Backstube\nB&uuml;ros/Verwaltungseinrichtungen\nEinzelhandel\nGastronomie\nHotellerie\nProduktionsbetriebe/Werkst&auml;tten\nMaschinenbau\nWohnungswesen\nSchulen/Kinderg&auml;rten\nPflegeeinrichtungen\nSonstiges"),
                'assign'        => $stream_slug,
                'title_column'  => false,
                'assign'        => $stream_slug,
                'default'        => 2,
                'required'      => true
                        ),
                        array(
                'name'          => 'Art',
                'slug'          => $field_preFX . 'art',
                'namespace'     => $namespace,
                'type'          => 'choice',
                'extra'         => array('choice_type'=>'radio','choice_data'=>"e : Strom \n g : Gas"),
                'assign'        => $stream_slug,
                'title_column'  => false,
                'required'      => true
                        ),
            array(
                'name'          => 'Verbrauch',
                'slug'          => $field_preFX . 'verbrauch',
                'namespace'     => $namespace,
                'type'          => 'text',
                'extra'         => array('max_length' => 20),
                'assign'        => $stream_slug,
                'title_column'  => false,
                'required'      => true
                        ),
                        array(
                'name'          => 'Leistung',
                'slug'          => $field_preFX . 'leistung',
                'namespace'     => $namespace,
                'type'          => 'text',
                'extra'         => array('max_length' => 20),
                'assign'        => $stream_slug,
                'title_column'  => false,
                'required'      => false
                        ),
                        array(
                'name'          => 'Abnahmestellen',
                'slug'          => $field_preFX . 'abnahmestellen',
                'namespace'     => $namespace,
                'type'          => 'choice',
                'extra'         => array('choice_type'=>'radio','default_value'=>'1','choice_data'=>"1 : Eine Abnahmestelle\n n : Mehrere Abnahmestellen"),
                'assign'        => $stream_slug,
                'title_column'  => false,
                'required'      => true
                        ),
                        array(
                'name'          => 'Interest',
                'slug'          => $field_preFX . 'interest',
                'namespace'     => $namespace,
                'type'          => 'choice',
                'extra'         => array('choice_type'=>'checkboxes','choice_data'=>"oekostrom : Ich interessiere mich f&uuml;r &Ouml;kostrom\n erdgas : Ich interessiere mich f&uuml;r Erdgas"),
                'assign'        => $stream_slug,
                'title_column'  => false,
                'required'      => false
                        ),

                        
        );

        $this->streams->streams->add_stream('Leads Energy', $stream_slug, $namespace, null, null);
        $this->streams->fields->add_fields($fields);
    }


    // --------------------------------------------------------------------
	
    function test()
    {
        $this->load->driver('Streams');
// $this->streams->streams->delete_stream('leads_energy', 'streams');
//$this->streams->utilities->remove_namespace('leads_energy');

        $this->streams->fields->deassign_field('streams', 'leads_energy', 'aa_testfeld');
        $this->streams->fields->delete_field('aa_testfeld', 'streams');
/*
  $this->streams->fields->deassign_field('streams', 'leads_energy', 'aölkdsjf');
  $this->streams->fields->delete_field('aölkdsjf', 'streams');
*/


        // Just in case.
        $this->dbforge->drop_table('leads_energy');

        die;
    
        $fields = array(
            array(
                'name'          => 'AA Testfeld',
                'slug'          => 'aa_testfeld',
                'namespace'     => 'streams',
                'type'          => 'text',
                'extra'         => array('max_length' => 200),
                'assign'        => 'leads_energy',
                'title_column'  => true,
                'required'      => true,
                'unique'        => true
            )
        );
 
        $this->streams->fields->add_fields($fields);

        $this->streams->streams->add_stream('Leads Energy', 'leads_energy', 'streams', null, null);
    
        die;
       
        echo "<pre><code>";
        print_r($this->session->all_userdata());
        echo "</code></pre>";
       
        $_contacts_id = 149;
        $addr = new $this->contacts_m();
        $addr->set_table('eb_addresses');
        $addrData = $addr->get_by('contacts_id',$_contacts_id);

        $persons = new $this->contacts_m();
        $persons->set_table('eb_persons');
        $personsData = $persons->get_by('contacts_id',$_contacts_id);
  
        echo "<pre><code>";
        print_r($personsData);
        echo "</code></pre>";
 
        echo  $isComplete = count($addrData) +  count($personsData);
	  

    }
    // --------------------------------------------------------------------
}