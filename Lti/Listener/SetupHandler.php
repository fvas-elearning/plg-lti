<?php
namespace Lti\Listener;

use Tk\Event\Subscriber;
use Lti\Plugin;

/**
 * @author Michael Mifsud <info@tropotek.com>
 * @see http://www.tropotek.com/
 * @license Copyright 2015 Michael Mifsud
 */
class SetupHandler implements Subscriber
{


    public function onRequest(\Tk\Event\GetResponseEvent $event)
    {
        $config = \Uni\Config::getInstance();
        $institution = $config->getInstitution();
        if($institution && Plugin::getInstance()->isZonePluginEnabled(Plugin::ZONE_INSTITUTION, $institution->getId())) {
            $dispatcher = $config->getEventDispatcher();
            $dispatcher->addSubscriber(new \Lti\Listener\AuthHandler());
            $dispatcher->addSubscriber(new \Lti\Listener\MenuHandler());
        }
    }



    public function onInit(\Tk\Event\KernelEvent $event)
    {
        //vd('onInit');
    }

    public function onController(\Tk\Event\ControllerEvent $event)
    {
        //vd('onController');
    }
    

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2'))
     *
     * @return array The event names to listen to
     *
     * @api
     */
    public static function getSubscribedEvents()
    {
        return array(
            //\Tk\Kernel\KernelEvents::INIT => array('onInit', 0),
            //\Tk\Kernel\KernelEvents::CONTROLLER => array('onController', 0),
            \Tk\Kernel\KernelEvents::REQUEST => array('onRequest', -10)
        );
    }
    
    
}