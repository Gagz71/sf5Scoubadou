<?php

namespace App\EventSubscriber;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class UserUpdateSubscriber implements EventSubscriberInterface
{
    private UserPasswordHasherInterface $encoder;

    public function __construct(UserPasswordHasherInterface $encoder) {
        $this->encoder = $encoder;
    }

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

        if(!empty($user -> getPlainPassword()))
        {
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
