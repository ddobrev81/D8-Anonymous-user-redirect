<?php

namespace Drupal\slakb_general\EventSubscriber;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SlakbGeneralSubscriber implements EventSubscriberInterface {
  /**
   * Your Custom event here.
   */
  public function redirectAnon(GetResponseEvent $event) {
    if (UserInterface::hasRole(AccountInterface::ANONYMOUS_ROLE)) {
      $event->setResponse(new RedirectResponse(\Drupal::config('slakb_general.settings')->get('redirect_path')));
    }
  }

  /**
   * Add your event to the list of events
   */
  public static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = array('redirectAnon');
    return $events;
  }

}