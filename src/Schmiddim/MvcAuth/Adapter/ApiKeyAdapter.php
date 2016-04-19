<?php
namespace Schmiddim\MvcAuth\Adapter;


use Zend\Authentication\AuthenticationServiceInterface;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\View\Helper\Identity;
use ZF\MvcAuth\Authentication\AdapterInterface;
use ZF\MvcAuth\Identity\AuthenticatedIdentity;
use ZF\MvcAuth\MvcAuthEvent;

class ApiKeyAdapter implements AdapterInterface
{

    protected $authenticationService;

    protected $userConfig;

    /**
     * @return array
     */
    public function provides()
    {
        return ['api-key'];
    }


    /**
     * ApiKeyAdapter constructor.
     * @param AuthenticationServiceInterface $authenticationService
     * @param array $userConfig
     */
    public function __construct(AuthenticationServiceInterface $authenticationService, $userConfig = [])
    {
        $this->authenticationService = $authenticationService;
        $this->userConfig = $userConfig;
    }

    /**
     * @param string $type
     * @return bool
     */
    public function matches($type)
    {
        if (in_array($type, $this->provides())) {
            return true;
        }
        return false;
    }

    /**
     * @param Request $request
     * @return null
     */
    public function getTypeFromRequest(Request $request)
    {
    }

    public function preAuth(Request $request, Response $response)
    {
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param MvcAuthEvent $mvcAuthEvent
     * @return bool|AuthenticatedIdentity
     */
    public function authenticate(Request $request, Response $response, MvcAuthEvent $mvcAuthEvent)
    {

        $apiUser = $request->getHeader('xapiuser', null);
        $apiKey = $request->getHeader('xapikey', null);

        if (null === $apiKey) {
            return false;
        }
        if (null === $apiUser) {
            return false;
        }

        if (true === array_key_exists($apiUser->getFieldValue(), $this->userConfig['users'])) {
            if ($this->userConfig['users'][$apiUser->getFieldValue()] === $apiKey->getFieldValue()) {
                return new AuthenticatedIdentity(new Identity());
            }
        }
        return false;
    }


}