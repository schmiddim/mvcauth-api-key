<?php


namespace Schmiddim\MvcAuth\Factory;


use Schmiddim\MvcAuth\Adapter\ApiKeyAdapter;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\ServiceLocatorInterface;

final class AuthenticationApiKeyAdapterFactory

{

    private function __construct()
    {
    }


    public static function factory($type, array $config, ServiceLocatorInterface $services)
    {
        if (!$services->has('authentication')) {
            throw new ServiceNotCreatedException(
                'Cannot create HTTP authentication adapter; missing AuthenticationService'
            );
        }

        $config = $services->get('Config')['api-key-authentication'];
        return new ApiKeyAdapter($services->get('authentication'), $config);

    }

}