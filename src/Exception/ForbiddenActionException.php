<?php

namespace EasyCorp\Bundle\EasyAdminBundle\Exception;

use EasyCorp\Bundle\EasyAdminBundle\Context\ApplicationContext;

/**
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
final class ForbiddenActionException extends BaseException
{
    public function __construct(ApplicationContext $applicationContext)
    {
        $parameters = [
            'action' => $applicationContext->getCrud()->getCurrentAction(),
            'crud_controller' => $applicationContext->getRequest()->query->get('crudController'),
        ];

        $exceptionContext = new ExceptionContext(
            'exception.forbidden_action',
            sprintf('You don\'t have enough permissions to run the "%s" action on the "%s" or the "%s" action has been disabled.', $parameters['action'], $parameters['crud_controller'], $parameters['action']),
            $parameters,
            403
        );

        parent::__construct($exceptionContext);
    }
}
