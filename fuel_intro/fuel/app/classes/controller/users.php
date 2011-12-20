<?php

class Controller_Users extends Controller_Template
{

	public function action_login()
	{
		$view = View::factory('users/login');
		$form = Fieldset::factory('login');
		$auth = Auth::instance();
		$form->add('username', 'Username:');
		$form->add('password', 'Choose Password:', array('type'=>'password'));
		$form->add('submit', ' ', array('type'=>'submit', 'value' => 'Login'));
		if($_POST)
		{
			if($auth->login(Input::post('username'), Input::post('password')))
			{
				Session::set_flash('success', 'Successfully logged in! Welcome '.$auth->get_screen_name());
				Response::redirect('messages/');
			}
			else
			{
				Session::set_flash('error', 'Username or password incorrect');
			}
		}
		$view->set('form', $form, false);
		$this->template->title = 'Users &raquo; Login';
		$this->template->content = $view;
	}
	public function action_logout()
	{
		$auth = Auth::instance();
		$auth->logout();
		Session::set_flash('success', 'Logged out.');
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
				Session::set_flash('success', 'User created.');
				Response::redirect('./');
			}
		}
		$view->set('reg', $form->build(), false);
		$this->template->title = 'Users &raquo; Register';
		$this->template->content = $view;//View::forge('users/register');
	}

}
