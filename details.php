<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Cockpit Module
 *
 * @author		tobias@mmsetc.de
 * @package		Ihre energieberater
 */
class Module_Cockpit extends Module {

   public $version = '0.0.10';

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
										'type'=>'int',
										'constraint'=>'11',
										),
						   'initial_contact'=>array(
													'type'=>'timestamp',
													),
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
						   'hv_users_id'=>array(
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

	$this->db->delete('settings', array('module' => 'cockpit'));
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
}
