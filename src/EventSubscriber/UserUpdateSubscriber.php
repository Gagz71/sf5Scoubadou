<?php

namespace App\EventSubscriber;

use App\Entity\User;
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
        if(!$user instanceof User) {
            return;
        }

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
