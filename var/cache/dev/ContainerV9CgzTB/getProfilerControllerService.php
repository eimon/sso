<?php

namespace ContainerV9CgzTB;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getProfilerControllerService extends App_KernelDevDebugContainer
{
    /**
     * Gets the public 'Doctrine\Bundle\DoctrineBundle\Controller\ProfilerController' shared service.
     *
     * @return \Doctrine\Bundle\DoctrineBundle\Controller\ProfilerController
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/doctrine/doctrine-bundle/Controller/ProfilerController.php';

        return $container->services['Doctrine\\Bundle\\DoctrineBundle\\Controller\\ProfilerController'] = new \Doctrine\Bundle\DoctrineBundle\Controller\ProfilerController(($container->privates['twig'] ?? self::getTwigService($container)), ($container->services['doctrine'] ?? self::getDoctrineService($container)), ($container->services['.container.private.profiler'] ?? self::get_Container_Private_ProfilerService($container)));
    }
}
