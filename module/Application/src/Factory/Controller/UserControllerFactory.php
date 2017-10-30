<?php
namespace Application\Factory\Controller;

use Interop\Container\ContainerInterface;
use Application\Controller\UserController;
use Zend\ServiceManager\Factory\FactoryInterface;

class UserControllerFactory implements FactoryInterface 
{
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
	{
		$userService = $container->get('UserService');
		$signupFormFilter = $container->get('SignupFormFilter');
		$userController = new UserController($userService, $signupFormFilter);
		return $userController;
	}
}