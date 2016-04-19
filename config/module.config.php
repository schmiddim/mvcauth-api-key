<?php
return array();
return array(

    'service_manager' => array(

        'delegators' => array(
            'ZF\MvcAuth\Authentication\DefaultAuthenticationListener' => array(
                ApiKey\Factory\AuthenticationAdapterDelegatorFactory::class,
            ),
        ),
    )
);