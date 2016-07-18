<?php

namespace Drupal\slakb_general\EventSubscriber;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SlakbGeneralSubscriber implements EventSubscriberInterface {

  public function checkForRedirection(GetResponseEvent $event) {
    if (UserInterface::hasRole(AccountInterface::ANONYMOUS_ROLE)) {
      $event->setResponse(new RedirectResponse('/user'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = array('checkForRedirection');
    return $events;
  }

}