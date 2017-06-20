<?php
namespace Lti\Listener;

use Tk\Event\Subscriber;

/**
 * Class StartupHandler
 *
 * @author Michael Mifsud <info@tropotek.com>
 * @link http://www.tropotek.com/
 * @license Copyright 2015 Michael Mifsud
 */
class MenuHandler implements Subscriber
{

    public function onInit(\Tk\Event\Event $event)
    {
        if (!\Lti\Provider::isLti()) return;

        // Hide the staff/student course menu
        /** @var \App\Controller\Iface $controller */
        $controller = $event->get('controller');
        if(method_exists($controller, 'getPage')) {
            $page = $event->get('page');

            // TODO: Better off to set a flag in the config or something so the menu can check id the dropdown should be shown
//            $nav = $page->getNavbar();
//            //if ($nav instanceof \App\Ui\Navbar\StaffMenu || $nav instanceof \App\Ui\Navbar\StudentMenu) {
//            if ($nav instanceof \App\Ui\Navbar\StudentMenu) {
//                $nav->showCourseDropdown(false);
//            }
        }

    }

    public function onController(\Tk\Event\ControllerEvent $event)
    {
        if (!\Lti\Provider::isLti()) return;

//        /** @var \App\Controller\Iface $controller */
//        $controller = $event->getController();
//        if(method_exists($controller, 'getPage')) {
//            $page = $controller->getPage();
//            $nav = $page->getNavbar();
//            vd($nav);
//            if ($nav instanceof \App\Ui\Navbar\StaffMenu) {
//                $nav->showCourseDropdown(false);
//            }
//        }

    }


    public static function getSubscribedEvents()
    {
        return array(
            \App\AppEvents::PAGE_INIT => array('onInit', 0),
            \Tk\Kernel\KernelEvents::CONTROLLER => array('onController', 0)
        );
    }
    
    
}