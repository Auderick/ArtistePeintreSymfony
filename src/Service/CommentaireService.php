<?php

namespace App\Service;

use DateTime;
use App\Entity\Blogpost;
use App\Entity\Peinture;
use App\Entity\Commentaire;
use Doctrine\ORM\EntityManagerInterface;

class CommentaireService
{
    private $manager;
    private $flash;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function persistCommentaire(Commentaire $commentaire, Blogpost $blogpost = null, Peinture $peinture = null): void
    {
        $commentaire->setIsPublished(false)
                    ->setBlogpost($blogpost)
                    ->setPeinture($peinture)
                    ->setCreatedAt(new DateTime('now'));

        $this->manager->persist($commentaire);
        $this->manager->flush();
    }
}
