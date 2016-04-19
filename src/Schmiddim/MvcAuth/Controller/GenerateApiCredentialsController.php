<?php

namespace Schmiddim\MvcAuth\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class GenerateApiCredentialsController extends AbstractActionController
{


    public function createAction()
    {
        $apiUser = new \PWGen(25, true, true, true);
        $apiPassword = new \PWGen(25, true, true, true);
        echo sprintf(" '%s' => '%s',", $apiUser, $apiPassword) . PHP_EOL;


    }
}