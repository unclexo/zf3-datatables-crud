<?php
namespace Application\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class SignupForm extends Form
{
	
	public function __construct($name = null)
	{
		parent::__construct('usersignup');
		$this->setAttribute('method', 'post');
		$this->addFields();
	}

	public function addFields()
	{
		$this->add([
			'name' => 'firstname',
			'type' => Element\Text::class,
			'options' => [
				'label' => 'First Name',
				'label_attributes' => [
					'class' => 'control-label'
				],
			],
            'attributes' => [
                'class'  => 'firstname',
			],			
		]);

		$this->add([
			'name' => 'lastname',
			'type' => Element\Text::class,
			'options' => [
				'label' => 'Last Name',
				'label_attributes' => [
					'class' => 'control-label',
				],
			],
			'attributes' => [
				'class' => 'lastname',
			],
		]);

		$this->add([
			'name' => 'email',
			'type' => Element\Email::class,
			'options' => [
				'label' => 'Email',
				'label_attributes' => [
					'class' => 'control-label'
				],
			],
            'attributes' => [
                'class'  => 'email',
			],			
		]);

		$this->add([
			'name' => 'password',
			'type' => Element\Password::class,
			'options' => [
				'label' => 'Password',
				'label_attributes' => [
					'class' => 'control-label'
				],
			],
            'attributes' => [
                'class'  => 'password',
			],			
		]);

		$this->add(new Element\Csrf('csrf'));

		$this->add([
            'name' => 'signup',
            'attributes' => [
                'type'  => 'submit',
                'value' => 'Sign up',
                'class' => 'btn btn-primary'
			],
		]);
	}
}


