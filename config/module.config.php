<?php
return array(

    'controllers' => array(
        'invokables' => array(
            Schmiddim\MvcAuth\Controller\GenerateApiCredentialsController::class =>
                Schmiddim\MvcAuth\Controller\GenerateApiCredentialsController::class
        )
    ),

    'service_manager' => array(
        'delegators' => array(
            'ZF\MvcAuth\Authentication\DefaultAuthenticationListener' => array(
                Schmiddim\MvcAuth\Factory\AuthenticationAdapterDelegatorFactory::class,
            ),
        ),
    ),

    'console' => array(
        'router' => array(
            'routes' => array(
                'generate-route' => array(
                    'type' => 'simple',
                    'options' => array(
                        'route' => 'generate-api-credentials',
                        'defaults' => array(
                            'controller' =>   Schmiddim\MvcAuth\Controller\GenerateApiCredentialsController::class,
                            'action' => 'create'
                        )
                    )
                )
            )
        )
    )
);