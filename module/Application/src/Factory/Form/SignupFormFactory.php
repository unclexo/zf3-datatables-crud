<?php
namespace Application\Factory\Form;

use Interop\Container\ContainerInterface;
use Application\Form\SignupForm;
use Zend\ServiceManager\Factory\FactoryInterface;

class SignupFormFactory implements FactoryInterface 
{
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
	{
		$filter = $container->get("SignupFormFilter");
		$form = new SignupForm();
		$form->setInputFilter($filter);
		return $form;
	}
}