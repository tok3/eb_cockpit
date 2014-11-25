<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Public Journal module controller
 *
 * @author  tobias@mmsetc.de
 * @package energieberaer
 */
class affiliate extends Public_Controller
{
   private $affiliate_group_id;
	public function __construct()
	{
		parent::__construct();
	  Asset::add_path('theme', site_url('addons/shared_addons/themes/ihre_energieberater').'/');


	  $this->lang->load('cockpit');

	  $this->affiliate_group_id = 3;
	}



	/**
	 * Method to register a new user
	 */
	public function register()
	{

	  
		if ($this->current_user)
		{
			$this->session->set_flashdata('notice', lang('user:already_logged_in'));
			redirect();
		}

		/* show the disabled registration message */
		if ( ! Settings::get('enable_registration'))
		{
			$this->template
				->title(lang('user:register_title'))
				->build('disabled');
			return;
		}

		// Validation rules
		$validation = array(
			array(
				'field' => 'password',
				'label' => lang('global:password'),
				'rules' => 'required|min_length['.$this->config->item('min_password_length', 'ion_auth').']|max_length['.$this->config->item('max_password_length', 'ion_auth').']'
			),
			array(
				'field' => 'email',
				'label' => lang('global:email'),
				'rules' => 'required|max_length[60]|valid_email|callback__email_check',
			),
			array(
				'field' => 'username',
				'label' => lang('user:username'),
				'rules' => Settings::get('auto_username') ? '' : 'required|alpha_dot_dash|min_length[3]|max_length[20]|callback__username_check',
			),
			array(
				'field' => 'agb',
				'label' => 'Gesch&auml;ftsbedingungen',
				'rules' => 'required',
			),

		);

		// --------------------------------
		// Merge streams and users validation
		// --------------------------------
		// Why are we doing this? We need
		// any fields that are required to
		// be filled out by the user when
		// registering.
		// --------------------------------

		// Get the profile fields validation array from streams
		$this->load->driver('Streams');
		$profile_validation = $this->streams->streams->validation_array('profiles', 'users');

		// Remove display_name
		foreach ($profile_validation as $key => $values)
		{
			if ($values['field'] == 'display_name')
			{
				unset($profile_validation[$key]);
				break;
			}
		}

		// Set the validation rules
		$this->form_validation->set_rules(array_merge($validation, $profile_validation));

		// Get user profile data. This will be passed to our
		// streams insert_entry data in the model.
		$assignments = $this->streams->streams->get_assignments('profiles', 'users');

		// This is the required profile data we have from
		// the register form
		$profile_data = array();

		// Get the profile data to pass to the register function.
		foreach ($assignments as $assign)
		{
			if ($assign->field_slug != 'display_name')
			{
				if (isset($_POST[$assign->field_slug]))
				{
					$profile_data[$assign->field_slug] = escape_tags($this->input->post($assign->field_slug));
				}
			}
		}

		// --------------------------------

		// Set the validation rules
		$this->form_validation->set_rules($validation);

		$user = new stdClass();

		// Set default values as empty or POST values
		foreach ($validation as $rule)
		{
			$user->{$rule['field']} = $this->input->post($rule['field']) ? escape_tags($this->input->post($rule['field'])) : null;
		}

		// Are they TRYing to submit?
		if ($_POST)
		{
			if ($this->form_validation->run())
			{
				// Check for a bot usin' the old fashioned
				// don't fill this input in trick.
				if (escape_tags($this->input->post('d0ntf1llth1s1n')) !== ' ')
				{
					$this->session->set_flashdata('error', lang('user:register_error'));
					redirect(current_url());
				}

				$email = escape_tags($this->input->post('email'));
				$password = escape_tags($this->input->post('password'));

				// --------------------------------
				// Auto-Username
				// --------------------------------
				// There are no guarantees that we 
				// will have a first/last name to
				// work with, so if we don't, use
				// an alternate method.
				// --------------------------------

				if (Settings::get('auto_username'))
				{
					if ($this->input->post('first_name') and $this->input->post('last_name'))
					{
						$this->load->helper('url');
						$username = url_title(escape_tags($this->input->post('first_name')).'.'.escape_tags($this->input->post('last_name')), '-', true);

						// do they have a long first name + last name combo?
						if (strlen($username) > 19)
						{
							// try only the last name
							$username = url_title(escape_tags($this->input->post('last_name')), '-', true);

							if (strlen($username) > 19)
							{
								// even their last name is over 20 characters, snip it!
								$username = substr($username, 0, 20);
							}
						}
					}
					else
					{
						// If there is no first name/last name combo specified, let's
						// user the identifier string from their email address
						$email_parts = explode('@', $email);
						$username = $email_parts[0];
					}

					// Usernames absolutely need to be unique, so let's keep
					// trying until we get a unique one
					$i = 1;

					$username_base = $username;

					while ($this->db->where('username', $username)
						->count_all_results('users') > 0)
					{
						// make sure that we don't go over our 20 char username even with a 2 digit integer added
						$username = substr($username_base, 0, 18).$i;

						++$i;
					}
				}
				else
				{
					// The user specified a username, so let's use that.
					$username = escape_tags($this->input->post('username'));
				}

				// --------------------------------

				// Do we have a display name? If so, let's use that.
				// Othwerise we can use the username.
				if ( ! isset($profile_data['display_name']) or ! $profile_data['display_name'])
				{
					$profile_data['display_name'] = $username;
				}

				// We are registering with a null group_id so we just
				// use the default user ID in the settings.
				$id = $this->ion_auth->register($username, $password, $email, $this->affiliate_group_id, $profile_data);

				// Try to create the user
				if ($id > 0)
				{
					// Convert the array to an object
					$user->username = $username;
					$user->display_name = $username;
					$user->email = $email;
					$user->password = $password;

					// trigger an event for third party devs
					Events::trigger('post_user_register', $id);

					/* send the internal registered email if applicable */
					if (Settings::get('registered_email'))
					{
						$this->load->library('user_agent');

						Events::trigger('email', array(
							'name' => $user->display_name,
							'sender_ip' => $this->input->ip_address(),
							'sender_agent' => $this->agent->browser().' '.$this->agent->version(),
							'sender_os' => $this->agent->platform(),
							'slug' => 'registered',
							'email' => Settings::get('contact_email'),
						), 'array');
					}

					// show the "you need to activate" page while they wait for their email
					if ((int)Settings::get('activation_email') === 1)
					{
						$this->session->set_flashdata('notice', $this->ion_auth->messages());
						redirect('users/activate');
					}
					// activate instantly
					elseif ((int)Settings::get('activation_email') === 2)
					{
						$this->ion_auth->activate($id, false);

						$this->ion_auth->login(escape_tags($this->input->post('email')), escape_tags($this->input->post('password')));
						redirect($this->config->item('register_redirect', 'ion_auth'));
					}
					else
					{
						$this->ion_auth->deactivate($id);

						/* show that admin needs to activate your account */
						$this->session->set_flashdata('notice', lang('user:activation_by_admin_notice'));
						redirect('users/register'); /* bump it to show the flash data */
					}
				}

				// Can't create the user, show why
				else
				{
					$this->template->error_string = $this->ion_auth->errors();
				}
			}
			else
			{
				// Return the validation error
				$this->template->error_string = $this->form_validation->error_string();
			}
		}

		// Is there a user hash?
		else {
			if (($user_hash = $this->session->userdata('user_hash')))
			{
				// Convert the array to an object
				$user->email = ( ! empty($user_hash['email'])) ? $user_hash['email'] : '';
				$user->username = $user_hash['nickname'];
			}
		}

		// --------------------------------
		// Create profile fields.
		// --------------------------------

		// Anything in the post?

		$this->template->set('profile_fields', $this->streams->fields->get_stream_fields('profiles', 'users', $profile_data));

		// --------------------------------

		$this->template
			->title(lang('user:register_title'))
			->set('_user', $user)
			->build('affiliate/register');
	}

	/**
	 * Email check
	 *
	 * @author Ben Edmunds
	 *
	 * @param string $email The email to check.
	 *
	 * @return bool
	 */
	public function _email_check($email)
	{
		if ($this->ion_auth->email_check($email))
		{
			$this->form_validation->set_message('_email_check', lang('user:error_email'));
			return false;
		}

		return true;
	}

// --------------------------------------------------------------------

}