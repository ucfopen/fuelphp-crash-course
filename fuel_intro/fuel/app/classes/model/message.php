<?php
use Orm\Model;

class Model_Message extends Model
{
	protected static $_properties = array(
		'id',
		'name',
		'message',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('message', 'Message', 'required');

		return $val;
	}

	public static function populate_register_fieldset(Fieldset $form)
	{
		$form->add('username', 'Username:')->add_rule('required');
		$form->add('password', 'Choose Password:', array('type'=>'password'))->add_rule('required');
		$form->add('password2', 'Re-type Password:', array('type' => 'password'))->add_rule('required');
		$form->add('email', 'E-mail:')->add_rule('required')->add_rule('valid_email');
		$form->add('submit', ' ', array('type'=>'submit', 'value' => 'Register'));
		return $form;
	}

}
