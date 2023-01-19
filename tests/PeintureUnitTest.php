<?php

namespace App\Tests;

use DateTime;
use App\Entity\User;
use App\Entity\Peinture;
use App\Entity\Categorie;
use App\Entity\Commentaire;
use PHPUnit\Framework\TestCase;

class PeintureUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $peinture = new Peinture();
        $datetime = new DateTime();
        $categorie = new Categorie();
        $user = new User();

        $peinture->setNom('nom')
                 ->setLargeur(20.20)
                 ->setHauteur(20.20)
                 ->setEnVente(true)
                 ->setDateRealisation($datetime)
                 ->setCreatedAt($datetime)
                 ->setDescription('description')
                 ->setPortfolio(true)
                 ->setSlug('slug')
                 ->setFile('file')
                 ->addCategorie($categorie)
                 ->setPrix(20.20)
                 ->setUser($user);

        $this->assertTrue($peinture->getNom() === 'nom');
        $this->assertTrue($peinture->getLargeur() == 20.20);
        $this->assertTrue($peinture->getHauteur() == 20.20);
        $this->assertTrue($peinture->getEnVente() === true);
        $this->assertTrue($peinture->getDateRealisation() === $datetime);
        $this->assertTrue($peinture->getCreatedAt() === $datetime);
        $this->assertTrue($peinture->getDescription() === 'description');
        $this->assertTrue($peinture->getPortfolio() === true);
        $this->assertTrue($peinture->getSlug() === 'slug');
        $this->assertTrue($peinture->getFile() === 'file');
        $this->assertTrue($peinture->getPrix() == 20.20);
        $this->assertContains($categorie, $peinture->getCategorie());
        $this->assertTrue($peinture->getUser() === $user );
    }

    public function testIsFalse()
    {
        $peinture = new Peinture();
        $datetime = new DateTime();
        $categorie = new Categorie();
        $user = new User();

        $peinture->setNom('nom')
            ->setLargeur('20.20')
            ->setHauteur('20.20')
            ->setEnVente(true)
            ->setDateRealisation($datetime)
            ->setCreatedAt($datetime)
            ->setDescription('description')
            ->setPortfolio(true)
            ->setSlug('Slug')
            ->setFile('file')
            ->addCategorie($categorie)
            ->setPrix(20.20)
            ->setUser($user);

        $this->assertFalse($peinture->getNom() === 'false');
        $this->assertFalse($peinture->getLargeur() === 20.20);
        $this->assertFalse($peinture->getHauteur() === 2020);
        $this->assertFalse($peinture->getEnVente() === false);
        $this->assertFalse($peinture->getDateRealisation() === new Datetime);
        $this->assertFalse($peinture->getCreatedAt() === new Datetime);
        $this->assertFalse($peinture->getDescription() === 'false');
        $this->assertFalse($peinture->getPortfolio() === false);
        $this->assertFalse($peinture->getSlug() === 'false');
        $this->assertFalse($peinture->getFile() === 'false');
        $this->assertFalse($peinture->getPrix() === 20.20);
        $this->assertNotContains(new Categorie(), $peinture->getCategorie());
        $this->assertFalse($peinture->getUser() === new User);
    }
    
    public function testIsEmpty()
    {
        $peinture = new Peinture();

        $this->assertEmpty($peinture->getNom());
        $this->assertEmpty($peinture->getLargeur());
        $this->assertEmpty($peinture->getHauteur());
        $this->assertEmpty($peinture->getEnVente());
        $this->assertEmpty($peinture->getDateRealisation());
        $this->assertEmpty($peinture->getCreatedAt());
        $this->assertEmpty($peinture->getDescription());
        $this->assertEmpty($peinture->getPortfolio());
        $this->assertEmpty($peinture->getSlug());
        $this->assertEmpty($peinture->getFile());
        $this->assertEmpty($peinture->getPrix());
        $this->assertEmpty($peinture->getCategorie());
        $this->assertEmpty($peinture->getUser());
        $this->assertEmpty($peinture->getId());
    }

    public function testAddGetRemoveCommentaire()
    {
        $peinture = new Peinture();
        $commentaire = new Commentaire();

        $this->assertEmpty($peinture->getCommentaires());

        $peinture->addCommentaire($commentaire);
        $this->assertContains($commentaire, $peinture->getCommentaires());

        $peinture->removeCommentaire($commentaire);
        $this->assertEmpty($peinture->getCommentaires());
    }

    public function testAddGetRemoveCategorie()
    {
        $peinture = new Peinture();
        $categorie = new Categorie();

        $this->assertEmpty($peinture->getCategorie());

        $peinture->addCategorie($categorie);
        $this->assertContains($categorie, $peinture->getCategorie());

        $peinture->removeCategorie($categorie);
        $this->assertEmpty($peinture->getCategorie());
    }
}