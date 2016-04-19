<?php

namespace Schmiddim\MvcAuth\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use ZF\MvcAuth\Factory\AuthenticationHttpAdapterFactory;
use ZF\MvcAuth\Factory\AuthenticationOAuth2AdapterFactory;

class AuthenticationAdapterDelegatorFactory extends \ZF\MvcAuth\Factory\AuthenticationAdapterDelegatorFactory
{

    public function createDelegatorWithName(
        ServiceLocatorInterface $services,
        $name,
        $requestedName,
        $callback
    )
    {

        /*@var DefaultAuthenticationListener $listener*/
        $listener = $callback();

        $config = $services->get('Config');
        if (!isset($config['zf-mvc-auth']['authentication']['adapters'])
            || !is_array($config['zf-mvc-auth']['authentication']['adapters'])
        ) {
            return $listener;
        }

        foreach ($config['zf-mvc-auth']['authentication']['adapters'] as $type => $data) {
            if (!isset($data['adapter']) || !is_string($data['adapter'])) {
                continue;
            }

            switch ($data['adapter']) {

                case 'MvcAuth\ApiKeyAdapter':

                    $adapter = AuthenticationApiKeyAdapterFactory::factory($type, $data, $services);

                    break;
                case 'ZF\MvcAuth\Authentication\HttpAdapter':
                    $adapter = AuthenticationHttpAdapterFactory::factory($type, $data, $services);
                    break;
                case 'ZF\MvcAuth\Authentication\OAuth2Adapter':
                    $adapter = AuthenticationOAuth2AdapterFactory::factory($type, $data, $services);
                    break;
                default:
                    $adapter = false;
                    break;
            }
            if ($adapter) {
                $listener->attach($adapter);
            }
        }

        return $listener;
    }
}