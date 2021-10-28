<?php

namespace App\EventSubscriber;

use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserUpdateSubscriber implements EventSubscriberInterface
{
    /**
     * @param BeforeEntityPersistedEvent $event
     */
    public function onBeforeEntityPersistedEvent( BeforeEntityPersistedEvent $event)
    {
        // ...
        $user = $event->getEntityInstance();

    }


    /**
     * @return string[]
     */
    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => 'onBeforeEntityPersistedEvent',
        ];
    }
}
