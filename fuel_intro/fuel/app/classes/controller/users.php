<?php

class Controller_Users extends Controller_Template {

	public function action_login()
	{
		$view = View::factory('users/login');
		$form = Form::factory('login');
		$auth = Auth::instance();
		$form->add('username', 'Username:');
		$form->add('password', 'Password:', array('type' => 'password'));
		$form->add('submit', ' ', array('type' => 'submit', 'value' => 'Login'));
		if($_POST)
		{
			if($auth->login(Input::post('username'), Input::post('password')))
			{
				Session::set_flash('notice', 'Successfully logged in! Welcome '.$auth->get_screen_name());
				Response::redirect('messages/');
			}
			else
			{
				Session::set_flash('notice', 'Username or password incorrect.');
			}
		}
		$view->set('form', $form, false);
		$this->template->title = 'User &raquo; Login';
		$this->template->content = $view;
	}
	
	public function action_logout()
	{
		$auth = Auth::instance();
		$auth->logout();
		Session::set_flash('notice', 'Logged out.');
		Response::redirect('messages/');
	}

	public function action_register()
	{
		$auth = Auth::instance();
		$view = View::factory('users/register');
		$form = Fieldset::factory('register');
		Model_User::register($form);
		if($_POST)
		{
			$form->repopulate();
			$result = Model_User::validate_registration($form, $auth);
			if($result['e_found'])
			{
				$view->set('errors', $result['errors'], false);
			}
			else
			{
				Session::set_flash('notice', 'User created.');
				Response::redirect('./');
			}
		}
		$view->set('reg', $form->build(), false);
		$this->template->title = 'User &raquo; Register';
		$this->template->content = $view;
	}

}

/* End of file users.php */