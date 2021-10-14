<?php

declare(strict_types=1);

namespace MediaMonks\FrontendConnectorBundle\DependencyInjection;

use MediaMonks\FrontendConnectorBundle\Controller\FrontendConnector;
use MediaMonks\FrontendConnectorBundle\Controller\FrontendController;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

class CompilerPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        try {
            $twig = $container->getDefinition('twig');

            $definition = $container->setDefinition(FrontendController::class, new Definition(FrontendController::class, [$twig]));
            $definition->setPublic(true);
            $definition->addTag('controller.service_arguments');

            $container->setAlias(FrontendConnector::class, FrontendController::class);
        } catch (ServiceNotFoundException $e) {
            throw new \Exception('This bundle depends on symfony/twig-bundle.', 0, $e);
        }
    }
}