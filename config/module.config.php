<?php
return array(

    'service_manager' => array(

        'delegators' => array(
            'ZF\MvcAuth\Authentication\DefaultAuthenticationListener' => array(
                Schmiddim\MvcAuth\Factory\AuthenticationAdapterDelegatorFactory::class,
            ),
        ),
    )
);