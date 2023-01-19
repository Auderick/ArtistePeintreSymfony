<?php

namespace App\Tests;

use DateTime;
use App\Entity\Blogpost;
use App\Entity\Peinture;
use App\Entity\Commentaire;
use PHPUnit\Framework\TestCase;

class CommentaireUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $commentaire = new Commentaire();
        $datetime = new DateTime();
        $blogpost = new Blogpost();
        $peinture = new Peinture();

        $commentaire->setAuteur('auteur')
                    ->setEmail('email@test.com')
                    ->setCreatedAt($datetime)
                    ->setContenu('contenu')
                    ->setBlogpost($blogpost)
                    ->setPeinture($peinture);

        $this->assertTrue($commentaire->getAuteur() === 'auteur');
        $this->assertTrue($commentaire->getEmail() === 'email@test.com');
        $this->assertTrue($commentaire->getCreatedAt() === $datetime);
        $this->assertTrue($commentaire->getContenu() === 'contenu');
        $this->assertTrue($commentaire->getBlogpost() === $blogpost);
        $this->assertTrue($commentaire->getpeinture() === $peinture);
    }

    public function testIsFalse()
    {
        $commentaire = new Commentaire();
        $datetime = new DateTime();
        $blogpost = new Blogpost();
        $peinture = new Peinture();

        $commentaire->setAuteur('auteur')
                    ->setEmail('email@test.com')
                    ->setCreatedAt($datetime)
                    ->setContenu('contenu')
                    ->setBlogpost($blogpost)
                    ->setPeinture($peinture);

        $this->assertFalse($commentaire->getAuteur() === 'false');
        $this->assertFalse($commentaire->getEmail() === 'false@test.com');
        $this->assertFalse($commentaire->getCreatedAt() === new datetime);
        $this->assertFalse($commentaire->getContenu() === 'false');
        $this->assertFalse($commentaire->getBlogpost() === new blogpost);
        $this->assertFalse($commentaire->getpeinture() === new peinture);
    }

    public function testIsEmpty()
    {
        $commentaire = new Commentaire();

        $this->assertEmpty($commentaire->getAuteur());
        $this->assertEmpty($commentaire->getEmail());
        $this->assertEmpty($commentaire->getCreatedAt());
        $this->assertEmpty($commentaire->getContenu());
        $this->assertEmpty($commentaire->getBlogpost());
        $this->assertEmpty($commentaire->getpeinture());
        $this->assertEmpty($commentaire->getId());
    }


}