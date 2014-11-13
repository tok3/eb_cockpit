<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Cockpit Module
 *
 * @author		tobias@mmsetc.de
 * @package		Ihre energieberater
 */
class Module_Cockpit extends Module {

    public $version = '0.0.44';

    public function info()
    {
        return array(
            'name' => array(
                'en' => '"Ihre Energieberater" <strong>Cockpit</strong>',
                'de' => 'Ihre Energieberater <strong>Cockpit</strong>'
            ),
            'description' => array(
                'en' => 'Cockpit for customers, affilliates and backoffice.',
                'de' => 'Cockpit f&uuml;r Kunden, Affilliates und Backoffice.', #update translation
            ),
            'frontend' => true,
            'backend'  => true,
            'skip_xss' => true,
            'menu'	  => 'content',

            'roles' => array(
                'customer', 'supervisor','affiliate', 'handelsvertreter'
            ),

        );
    }

    public function install()
    {
        $eb_addresses = array(
            'id'=>array(
                'type'=>'int',
                'constraint'=>'11',
                'auto_increment' => TRUE,
            ),
            'contacts_id'=>array(
                'type'=>'int',
                'constraint'=>'11',
            ),
            'str'=>array(
                'type'=>'varchar',
                'constraint'=>'100',
            ),
            'no'=>array(
                'type'=>'varchar',
                'constraint'=>'5',
            ),
            'plz'=>array(
                'type'=>'varchar',
                'constraint'=>'5',
            ),
            'city'=>array(
                'type'=>'varchar',
                'constraint'=>'100',
            ),
        );
        $this->dbforge->drop_table("eb_addresses");

        $this->dbforge->add_field($eb_addresses);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table("eb_addresses");




        $eb_companies = array(
            'id'=>array(
                'type'=>'int',
                'constraint'=>'11',
                'auto_increment' => TRUE,
            ),
            'contacts_id'=>array(
                'type'=>'int',
                'constraint'=>'11',
            ),
            'name'=>array(
                'type'=>'varchar',
                'constraint'=>'100',
            ),
            'name_2'=>array(
                'type'=>'varchar',
                'constraint'=>'100',
            ),
            'tel'=>array(
                'type'=>'varchar',
                'constraint'=>'30',
            ),
            'fax'=>array(
                'type'=>'varchar',
                'constraint'=>'30',
            ),
            'email'=>array(
                'type'=>'varchar',
                'constraint'=>'100',
            ),
            'homepage'=>array(
                'type'=>'varchar',
                'constraint'=>'155',
            ),
        );
        $this->dbforge->drop_table("eb_companies");

        $this->dbforge->add_field($eb_companies);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table("eb_companies");





        $eb_contacts = array(
            'id'=>array(
                'type'=>'int',
                'constraint'=>'11',
                'auto_increment' => TRUE,
            ),
            'typ'=>array(
                'type' => 'ENUM("0","privat","firma")',
                'default' => '',
                'null' => FALSE,
            ),				
            'is_affiliate'=>array(
                'type'=>'int',
                'constraint'=>'1',
                'default'=> "0"
            ),
            'initial_contact TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'follow_up'=>array(
                'type'=>'timestamp',
            ),
            'memo'=>array(
                'type'=>'text',
            ),
            'deleted'=>array(
                'type'=>'int',
                'constraint'=>'1',
            ),
            'creator_users_id'=>array(
                'type'=>'int',
                'constraint'=>'11',
                'default'=> "0"

            ),
            'users_id'=>array(
                'type'=>'int',
                'constraint'=>'11',
                'default'=> "0"

            ),

        );
        $this->dbforge->drop_table("eb_contacts");

        $this->dbforge->add_field($eb_contacts);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table("eb_contacts");


        $eb_persons = array(
            'id'=>array(
                'type'=>'int',
                'constraint'=>'11',
                'auto_increment' => TRUE,
            ),
            'contacts_id'=>array(
                'type'=>'int',
                'constraint'=>'11',
            ),
            'sex'=>array(
                'type'=>'enum',
                'constraint' => array('f','m','n/a'),
                'default'=> "n/a"
            ),
            'name'=>array(
                'type'=>'varchar',
                'constraint'=>'100',
            ),
            'firstname'=>array(
                'type'=>'varchar',
                'constraint'=>'100',
            ),
            'name_phonetic'=>array(
                'type'=>'varchar',
                'constraint'=>'155',
            ),
            'birthday'=>array(
                'type'=>'date',
            ),
            'tel'=>array(
                'type'=>'varchar',
                'constraint'=>'30',
            ),
            'fax'=>array(
                'type'=>'varchar',
                'constraint'=>'30',
            ),
            'mobile'=>array(
                'type'=>'varchar',
                'constraint'=>'100',
            ),
            'email'=>array(
                'type'=>'varchar',
                'constraint'=>'30',
            ),
        );

        $this->dbforge->drop_table("eb_persons");

        $this->dbforge->add_field($eb_persons);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table("eb_persons");


        // --------------------------------------------------------------------
        /**
         * tabelle für kontakteigenschaftetn
         * 
         */
        $energieausweis_porperties = 'eb_contact_properties';
        $this->dbforge->drop_table($energieausweis_porperties);


        $eb_immo = array(
            'id'=>array(
                'type'=>'int',
                'constraint'=>'11',
                'auto_increment' => TRUE,
            ),
            'contacts_id'=>array(
                'type'=>'int',
                'constraint'=>'11',
            ),
            'property'=> array(
                'type' => 'ENUM("","strom","energieausweis","energieberater","immobilienmakler")',
                'default' => '',
                'null' => FALSE,
            )
        );
			
        $this->dbforge->add_field($eb_immo);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table($energieausweis_porperties);


        // --------------------------------------------------------------------
        /**
         * tabelle für immobilien erzeugen
         * 
         */

        $energieausweis_immo_tablename = 'eb_immobilien';

        $eb_immo = array(
            'id'=>array(
                'type'=>'int',
                'constraint'=>'11',
                'auto_increment' => TRUE,
            ),
            'contacts_id'=>array(
                'type'=>'int',
                'constraint'=>'11',
            ),
            'stream_entry_id'=>array(
                'type'=>'int',
                'constraint'=>'11',
            ),
            'aktionscode'=>array(
                'type'=>'varchar',
                'constraint'=>'55',
                'default' => '',
            ),
            'objektart'=> array(
                'type'=>'varchar',
                'constraint'=>'55',
            ),
            'bezugsfrei'=> array(
                'type'=>'varchar',
                'constraint'=>'55',
            ),
            'str'=>array(
                'type'=>'varchar',
                'constraint'=>'100',
            ),
            'plz'=>array(
                'type'=>'varchar',
                'constraint'=>'5',
            ),
            'ort'=>array(
                'type'=>'varchar',
                'constraint'=>'100',
            ),
            'qm'=>array(
                'type'=>'varchar',
                'constraint'=>'55',
                'default' => '',
            ),
            'qm_grund'=>array(
                'type'=>'varchar',
                'constraint'=>'55',
                'default' => '',
            ),
            'baujahr'=>array(
                'type'=>'integer',
                'constraint'=>'4',
                'null'=>TRUE,

            ),
            'bauart'=>array(
                'type'=>'varchar',
                'constraint'=>'155',
                'default' => '',
            ),
            'heizung'=>array(
                'type'=>'varchar',
                'constraint'=>'55',
                'default' => '',
            ),
            'wasser'=>array(
                'type'=>'varchar',
                'constraint'=>'55',
                'null'=>TRUE,

            ),
            'verbrauchsabr'=>array(
                'type'=>'integer',
                'constraint'=>'1',
                'null'=>TRUE,
            ),
            'instanthaltungsm'=>array(
                'type'=>'text',
                'null'=>TRUE,
                    
            ),
            'bauplan'=>array(
                'type'=>'integer',
                'constraint'=>'1',
                'null'=>TRUE,

            ),
            'makler_kontaktiert'=>array(
                'type'=>'integer',
                'constraint'=>'1',
                'null'=>TRUE,
            ),
            'makler'=>array(
                'type'=>'varchar',
                'constraint'=>'255',
                'null'=>TRUE,
            ),
            'an_makler'=>array(
                'type'=>'integer',
                'constraint'=>'1',
                'null'=>TRUE,
            ),
            'an_energieberater'=>array(
                'type'=>'integer',
                'constraint'=>'1',
                'null'=>TRUE,
            ),
            'est_preis'=>array(
                'type'=>'varchar',
                'constraint'=>'12',
                'null'=>TRUE,
            ),
            'vk_preis'=>array(
                'type'=>'varchar',
                'constraint'=>'12',
                'null'=>TRUE,
            ),
            'innenprovision'=>array(
                'type'=>'varchar',
                'constraint'=>'4',
                'null'=>TRUE,
            ),
            'aussenprovision'=>array(
                'type'=>'varchar',
                'constraint'=>'4',
                'null'=>TRUE,
            ),
            'verkauft'=>array(
                'type'=>'int',
                'constraint'=>'1',
                'null'=>TRUE,

            ),
            'verausserung_art'=>array(
                'type'=>'varchar',
                'constraint'=>'55',
                'null'=>TRUE,
            ),
            'bemerkung'=>array(
                'type'=>'text',
                'null'=>TRUE,

            ),
            'last_upd TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',

        );


        $this->dbforge->drop_table($energieausweis_immo_tablename);

        $this->dbforge->add_field($eb_immo);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table($energieausweis_immo_tablename);



        $eb_jqcalendar = array(
            'Id'=>array(
                'type'=>'int',
                'constraint'=>'11',
                'auto_increment' => TRUE,
            ),
            'calendar_id'=>array(
                'type'=>'int',
                'constraint'=>'11',
            ),
            'Subject'=>array(
                'type'=>'varchar',
                'constraint'=>'1000',
            ),
            'Location'=>array(
                'type'=>'varchar',
                'constraint'=>'200',
            ),
            'Description'=>array(
                'type'=>'varchar',
                'constraint'=>'255',
            ),
            'StartTime'=>array(
                'type'=>'datetime',
            ),
            'EndTime'=>array(
                'type'=>'datetime',
            ),
            'IsAllDayEvent'=>array(
                'type'=>'smallint',
                'constraint'=>'6',
            ),
            'Color'=>array(
                'type'=>'varchar',
                'constraint'=>'200',
            ),
            'RecurringRule'=>array(
                'type'=>'varchar',
                'constraint'=>'500',
            ),
            'contacts_id'=>array(
                'type'=>'int',
                'constraint'=>'11',
            ),
            'reminder'=>array(
                'type'=>'int',
                'constraint'=>'1',
            ),
        );
        $this->dbforge->drop_table("eb_jqcalendar");

        $this->dbforge->add_field($eb_jqcalendar);
        $this->dbforge->add_key('Id', TRUE);
        $this->dbforge->create_table("eb_jqcalendar");


        return true;
    }

    public function uninstall()
    {

        $this->dbforge->drop_table("eb_addresses");
        $this->dbforge->drop_table("eb_companies");
        $this->dbforge->drop_table("eb_contacts");
        $this->dbforge->drop_table("eb_persons");
        $this->dbforge->drop_table("eb_sessions");
        // This is a core module, lets keep it around.
        return true;
    }

    public function upgrade($old_version)
    {


// --------------------------------------------------------------------
  // affiliate id zu energieausweis stream hinzuf?gen
	  $this->load->driver('Streams');

	  $assignment = $this->streams->fields->get_field_assignments('aktionscode', 'streams');
	  if(count($assignment['0']) == 0)
		 { 
			$fields = array(
							array(
								  'name'	=> 'Aktionscode',
								  'slug'	=> 'aktionscode',
								  'namespace' => 'streams',
								  'type'	=> 'text',
								  'assign'	=> 'energieausweis',
								  'required'	=> false
								  )
							);


			$this->streams->fields->add_fields($fields);
		 }


        // --------------------------------------------------------------------
        
        $energieausweis_immo_tablename = 'eb_immobilien';

        if (!$this->db->table_exists($energieausweis_immo_tablename))
        {
        $this->dbforge->drop_table($energieausweis_immo_tablename);

        $eb_immo = array(
            'id'=>array(
                'type'=>'int',
                'constraint'=>'11',
                'auto_increment' => TRUE,
            ),
            'contacts_id'=>array(
                'type'=>'int',
                'constraint'=>'11',
            ),
            'stream_entry_id'=>array(
                'type'=>'int',
                'constraint'=>'11',
            ),
            'aktionscode'=>array(
                'type'=>'varchar',
                'constraint'=>'55',
                'default' => '',
            ),
            'objektart'=> array(
                'type'=>'varchar',
                'constraint'=>'55',
            ),
            'bezugsfrei'=> array(
                'type'=>'varchar',
                'constraint'=>'55',
            ),
            'str'=>array(
                'type'=>'varchar',
                'constraint'=>'100',
            ),
            'plz'=>array(
                'type'=>'varchar',
                'constraint'=>'5',
            ),
            'ort'=>array(
                'type'=>'varchar',
                'constraint'=>'100',
            ),
            'qm'=>array(
                'type'=>'varchar',
                'constraint'=>'55',
                'default' => '',
            ),
            'qm_grund'=>array(
                'type'=>'varchar',
                'constraint'=>'55',
                'default' => '',
            ),
            'baujahr'=>array(
                'type'=>'integer',
                'constraint'=>'4',
                'null'=>TRUE,

            ),
            'bauart'=>array(
                'type'=>'varchar',
                'constraint'=>'155',
                'default' => '',
            ),
            'heizung'=>array(
                'type'=>'varchar',
                'constraint'=>'55',
                'default' => '',
            ),
            'wasser'=>array(
                'type'=>'varchar',
                'constraint'=>'55',
                'null'=>TRUE,

            ),
            'verbrauchsabr'=>array(
                'type'=>'integer',
                'constraint'=>'1',
                'null'=>TRUE,
            ),
            'instanthaltungsm'=>array(
                'type'=>'text',
                'null'=>TRUE,
                    
            ),
            'bauplan'=>array(
                'type'=>'integer',
                'constraint'=>'1',
                'null'=>TRUE,

            ),
            'makler_kontaktiert'=>array(
                'type'=>'integer',
                'constraint'=>'1',
                'null'=>TRUE,
            ),
            'makler'=>array(
                'type'=>'varchar',
                'constraint'=>'255',
                'null'=>TRUE,
            ),
            'an_makler'=>array(
                'type'=>'integer',
                'constraint'=>'1',
                'null'=>TRUE,
            ),
            'an_energieberater'=>array(
                'type'=>'integer',
                'constraint'=>'1',
                'null'=>TRUE,
            ),
            'est_preis'=>array(
                'type'=>'varchar',
                'constraint'=>'12',
                'null'=>TRUE,
            ),
            'vk_preis'=>array(
                'type'=>'varchar',
                'constraint'=>'12',
                'null'=>TRUE,
            ),
            'innenprovision'=>array(
                'type'=>'varchar',
                'constraint'=>'4',
                'null'=>TRUE,
            ),
            'aussenprovision'=>array(
                'type'=>'varchar',
                'constraint'=>'4',
                'null'=>TRUE,
            ),
            'verkauft'=>array(
                'type'=>'int',
                'constraint'=>'1',
                'null'=>TRUE,

            ),
            'verausserung_art'=>array(
                'type'=>'varchar',
                'constraint'=>'55',
                'null'=>TRUE,
            ),
            'bemerkung'=>array(
                'type'=>'text',
                'null'=>TRUE,

            ),
            'last_upd TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',

        );


            $this->dbforge->add_field($eb_immo);
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table($energieausweis_immo_tablename);
        }
        
        // --------------------------------------------------------------------
        /**
         * tabelle für bankkonten
         * 
         */
        $bank_acc = 'eb_bank_accounts';
        $this->dbforge->drop_table($bank_acc);

        if (!$this->db->table_exists($bank_acc))
        {
	


			$ba_fields = array(
                'id'=>array(
                    'type'=>'int',
                    'constraint'=>'11',
                    'auto_increment' => TRUE,
                ),
                'contacts_id'=>array(
                    'type'=>'int',
                    'constraint'=>'11',
                ),
                'bank_name'=> array(
                    'type'=>'varchar',
                    'constraint'=>'100',
                ),
                'iban'=> array(
                    'type'=>'varchar',
                    'constraint'=>'34',
                ),
                'bic'=> array(
                    'type'=>'varchar',
                    'constraint'=>'11',
                ),
                'last_upd TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',

            );
			
			$this->dbforge->add_field($ba_fields);
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->create_table($bank_acc);
			// kontakte aktualisieren av_id

        }


        return true;

    }
}
