<?php
namespace Application\Factory\Filter;

use Interop\Container\ContainerInterface;
use Application\Filter\SignupFormFilter;
use Zend\ServiceManager\Factory\FactoryInterface;

class SignupFormFilterFactory implements FactoryInterface 
{
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
	{
		$request = $container->get("Request");
		return new SignupFormFilter($request);
	}
}