<?php 
namespace Application\Factory\Service;

use Interop\Container\ContainerInterface;
use Application\Service\UserService;
use Zend\ServiceManager\Factory\FactoryInterface;

class UserServiceFactory implements FactoryInterface
{
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
	{
		$userService = new UserService();
		$userService->setServiceManager($container);
		return $userService;
	}
}