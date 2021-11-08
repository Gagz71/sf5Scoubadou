<?php

namespace App\EventSubscriber;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserUpdateSubscriber implements EventSubscriberInterface
{
    private UserPasswordHasherInterface $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function onBeforeEntityPersistedEvent(BeforeEntityPersistedEvent $event)
    {
        // ...
        $user = $event->getEntityInstance();
        if (!$user instanceof User) {
            return;
        }

        if (!empty($user->getPlainPassword())) {
            //sinon on encode le mot de passe
            $newPwd = $this->encoder->hashPassword($user, $user->getPlainPassword());
            $user->setPassword($newPwd);
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
