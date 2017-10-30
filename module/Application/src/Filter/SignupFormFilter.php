<?php
namespace Application\Filter;

use Zend\Filter;
use Zend\InputFilter;
use Zend\Stdlib\RequestInterface;
use Zend\Validator;

class SignupFormFilter extends InputFilter\InputFilter
{
	/**
	 * @var RequstInterface
	 */
	protected $request;

	public function __construct(RequestInterface $request)
	{	
		// Current request object
		$this->request = $request;
		$this->addFilters();
	}

	public function addFilters()
	{
		$this->add([
			'name' => 'userId',
			'required' => $this->request->getPost('userId') ? true : false,
			'filters' => [
				['name' => Filter\ToInt::class],
				['name' => Filter\StripTags::class],
				['name' => Filter\StringTrim::class],
			],		
		]);
		$this->add([
			'name' => 'firstname',
			'required' => true,
			'filters' => [
				['name' => Filter\StripTags::class],
				['name' => Filter\StringTrim::class],
			],
			'validators' => [
				[
					'name' => Validator\NotEmpty::class,
					'options' => [
						'message' => 'First name can not be empty',
					],
					'break_chain_on_failure' => true,
				],
			],
		]);

		$this->add([
			'name' => 'lastname',
			'required' => true,
			'filters' => [
				['name' => Filter\StripTags::class],
				['name' => Filter\StringTrim::class],
			],
			'validators' => [
				[
					'name' => Validator\NotEmpty::class,
					'options' => [
						'message' => 'Last name can not be empty',
					],
					'break_chain_on_failure' => true,
				],
			],
		]);		

		$this->add([
			'name' => 'email',
			'required' => true,
			'filters' => [
				['name' => Filter\StripTags::class],
				['name' => Filter\StringTrim::class],
			],
			'validators' => [
				[
					'name' => Validator\NotEmpty::class,
					'options' => [
						'message' => 'Email can not be empty',
					],					
					'break_chain_on_failure' => true,
				],
				[
					'name' => Validator\EmailAddress::class,
					'options' => [
						'message' => 'Email must be a valid one',
					],					
					'break_chain_on_failure' => true,
				]
			],
		]);

		$this->add([
			'name' => 'password',
			'required' => $this->request->getPost('userId') ? false : true,
			'filters' => [
				['name' => Filter\StripTags::class],
				['name' => Filter\StringTrim::class],
			],
			'validators' => [
				[
					'name' => Validator\NotEmpty::class,
					'options' => [
						'message' => 'Password can not be empty',
					],					
					'break_chain_on_failure' => true,
				],
				[
					'name' => Validator\StringLength::class,
					'options' => [
						'min' => 6,
						'max' => 60,
						'message' => 'Password length must be between 6 to 60 characters'
					],
					'break_chain_on_failure' => true,
				]
			],
		]);		
	}
}