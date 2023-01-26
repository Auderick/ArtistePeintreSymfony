<?php

namespace App\EventSubscriber;

use DateTime;
use App\Entity\User;
use App\Entity\Blogpost;
use App\Entity\Peinture;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    private $slugger;
    private $security;

    public function __construct(
        SluggerInterface $slugger,
        Security $security,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher
    ) {
        $this->slugger = $slugger;
        $this->security = $security;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setDateAndUser'],
        ];
    }

    public function setDateAndUser(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (($entity instanceof Blogpost)) {
            $now = new DateTime('now');
            $entity->setCreatedAt($now);

            $user = $this->security->getUser();
            $entity->setUser($user);
        }
        if (($entity instanceof Peinture)) {
            $now = new DateTime('now');
            $entity->setCreatedAt($now);

            $user = $this->security->getUser();
            $entity->setUser($user);
        }
        return;
    }
}
