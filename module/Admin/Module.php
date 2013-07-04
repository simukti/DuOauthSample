<?php

namespace Admin;

use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $event)
    {
        $shm = $event->getApplication()->getEventManager()->getSharedManager();
        $shm->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', array($this, 'authenticationCheck'), 901);
    }
    
    public function authenticationCheck(MvcEvent $event)
    {
        $controller      = $event->getTarget();
        $controllerClass = get_class($controller);
        $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
        if($moduleNamespace !== __NAMESPACE__) {
            return;
        }
        $userService = $event->getApplication()->getServiceManager()->get('duoauth-service-user');
        $authService = $userService->getAuthService();
        $request     = $controller->getRequest();
        if(! $authService->hasIdentity()) {
            $controller->redirect()->toRoute('duoauth-login-index');
        }
    }
    
    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'identity' => function ($services) {
                    $sm     = $services->getServiceLocator();
                    $duOauthUser = $sm->get('duoauth-service-user');
                    $authService = $duOauthUser->getAuthService();
                    
                    $identityViewHelper = new \Zend\View\Helper\Identity;
                    $identityViewHelper->setAuthenticationService($authService);
                    return $identityViewHelper;
                }
            )
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src'
                ),
            ),
        );
    }
}