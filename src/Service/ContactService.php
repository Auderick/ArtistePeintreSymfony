<?php

namespace App\Service;

use DateTime;
use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;

class ContactService
{
    private $manager;



    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function persistContact(Contact $contact): void
    {
        $contact->setIsSend(false)
                ->setCreatedAt(new DateTime('now'));

        $this->manager->persist($contact);
        $this->manager->flush();
    }

    public function isSend(Contact $contact): void
    {
        $contact->setIsSend(true);

        $this->manager->persist($contact);
        $this->manager->flush();
    }
}
